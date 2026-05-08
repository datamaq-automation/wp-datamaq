<?php
/**
 * Plugin Name: DataMaq OpenClaw Admin
 * Description: Adds a protected wp-admin widget that proxies chat requests to OpenClaw through the WordPress backend.
 * Version: 0.1.0
 * Author: DataMaq
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DM_OPENCLAW_REST_NAMESPACE', 'openclaw/v1' );

function dm_openclaw_capability() {
	return apply_filters( 'dm_openclaw_capability', 'manage_options' );
}

function dm_openclaw_gateway_url() {
	if ( defined( 'OPENCLAW_GATEWAY_URL' ) && OPENCLAW_GATEWAY_URL ) {
		return OPENCLAW_GATEWAY_URL;
	}

	$env = getenv( 'OPENCLAW_GATEWAY_URL' );
	if ( $env ) {
		return $env;
	}

	return 'ws://100.92.114.110:18789';
}

function dm_openclaw_gateway_token() {
	if ( defined( 'OPENCLAW_GATEWAY_TOKEN' ) && OPENCLAW_GATEWAY_TOKEN ) {
		return OPENCLAW_GATEWAY_TOKEN;
	}

	$env = getenv( 'OPENCLAW_GATEWAY_TOKEN' );
	if ( $env ) {
		return $env;
	}

	return '';
}

function dm_openclaw_redact_url( $url ) {
	$parts = wp_parse_url( $url );
	if ( empty( $parts['scheme'] ) || empty( $parts['host'] ) ) {
		return '(invalid URL)';
	}

	$port = empty( $parts['port'] ) ? '' : ':' . intval( $parts['port'] );
	$path = empty( $parts['path'] ) ? '' : $parts['path'];
	return $parts['scheme'] . '://' . $parts['host'] . $port . $path;
}

function dm_openclaw_rest_permission( WP_REST_Request $request ) {
	$nonce = $request->get_header( 'x_wp_nonce' );

	if ( ! $nonce || ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
		return new WP_Error( 'dm_openclaw_bad_nonce', 'Nonce invalido.', array( 'status' => 403 ) );
	}

	if ( ! current_user_can( dm_openclaw_capability() ) ) {
		return new WP_Error( 'dm_openclaw_forbidden', 'No tenes permisos para usar OpenClaw.', array( 'status' => 403 ) );
	}

	return true;
}

add_action( 'rest_api_init', 'dm_openclaw_register_rest_routes' );
function dm_openclaw_register_rest_routes() {
	register_rest_route(
		DM_OPENCLAW_REST_NAMESPACE,
		'/status',
		array(
			'methods'             => 'GET',
			'callback'            => 'dm_openclaw_rest_status',
			'permission_callback' => 'dm_openclaw_rest_permission',
		)
	);

	register_rest_route(
		DM_OPENCLAW_REST_NAMESPACE,
		'/chat',
		array(
			'methods'             => 'POST',
			'callback'            => 'dm_openclaw_rest_chat',
			'permission_callback' => 'dm_openclaw_rest_permission',
			'args'                => array(
				'message' => array(
					'required'          => true,
					'sanitize_callback' => 'sanitize_textarea_field',
				),
			),
		)
	);
}

function dm_openclaw_rest_status() {
	$url   = dm_openclaw_gateway_url();
	$parts = wp_parse_url( $url );
	$tcp   = array(
		'checked' => false,
		'ok'      => false,
	);

	if ( ! empty( $parts['host'] ) ) {
		$scheme = empty( $parts['scheme'] ) ? 'ws' : $parts['scheme'];
		$port   = empty( $parts['port'] ) ? dm_openclaw_default_port( $scheme ) : intval( $parts['port'] );
		$tcp    = dm_openclaw_tcp_check( $parts['host'], $port, in_array( $scheme, array( 'wss', 'https' ), true ) );
	}

	return rest_ensure_response(
		array(
			'configured' => (bool) dm_openclaw_gateway_token(),
			'gateway'    => dm_openclaw_redact_url( $url ),
			'tcp'        => $tcp,
		)
	);
}

function dm_openclaw_rest_chat( WP_REST_Request $request ) {
	$rate = dm_openclaw_rate_limit_check();
	if ( is_wp_error( $rate ) ) {
		return $rate;
	}

	$message = trim( (string) $request->get_param( 'message' ) );
	if ( '' === $message ) {
		return new WP_Error( 'dm_openclaw_empty_message', 'El mensaje esta vacio.', array( 'status' => 400 ) );
	}

	if ( strlen( $message ) > 4000 ) {
		return new WP_Error( 'dm_openclaw_message_too_long', 'El mensaje supera el limite de 4000 caracteres.', array( 'status' => 400 ) );
	}

	$token = dm_openclaw_gateway_token();
	if ( ! $token ) {
		return new WP_Error( 'dm_openclaw_missing_token', 'OPENCLAW_GATEWAY_TOKEN no esta configurado en el backend.', array( 'status' => 500 ) );
	}

	$response = dm_openclaw_send_message( $message, $token );
	if ( is_wp_error( $response ) ) {
		return $response;
	}

	return rest_ensure_response( $response );
}

function dm_openclaw_rate_limit_check() {
	$user_id = get_current_user_id();
	$key     = 'dm_openclaw_rate_' . $user_id;
	$hits    = (int) get_transient( $key );

	if ( $hits >= 10 ) {
		return new WP_Error( 'dm_openclaw_rate_limited', 'Demasiadas consultas. Espera un minuto y volve a intentar.', array( 'status' => 429 ) );
	}

	set_transient( $key, $hits + 1, MINUTE_IN_SECONDS );
	return true;
}

function dm_openclaw_send_message( $message, $token ) {
	$url    = dm_openclaw_gateway_url();
	$parts  = wp_parse_url( $url );
	$scheme = empty( $parts['scheme'] ) ? 'ws' : strtolower( $parts['scheme'] );

	$payload = apply_filters(
		'dm_openclaw_payload',
		array(
			'type'    => 'chat',
			'message' => $message,
			'source'  => 'wordpress-admin',
			'site'    => home_url(),
			'user'    => wp_get_current_user()->user_login,
		),
		$message
	);

	if ( in_array( $scheme, array( 'http', 'https' ), true ) ) {
		return dm_openclaw_http_request( $url, $token, $payload );
	}

	if ( in_array( $scheme, array( 'ws', 'wss' ), true ) ) {
		return dm_openclaw_websocket_request( $url, $token, $payload );
	}

	return new WP_Error( 'dm_openclaw_bad_scheme', 'OPENCLAW_GATEWAY_URL debe usar ws, wss, http o https.', array( 'status' => 500 ) );
}

function dm_openclaw_http_request( $url, $token, $payload ) {
	$result = wp_remote_post(
		$url,
		array(
			'timeout' => 45,
			'headers' => array(
				'Authorization' => 'Bearer ' . $token,
				'Content-Type'  => 'application/json',
			),
			'body'    => wp_json_encode( $payload ),
		)
	);

	if ( is_wp_error( $result ) ) {
		return new WP_Error( 'dm_openclaw_http_error', $result->get_error_message(), array( 'status' => 502 ) );
	}

	$code = wp_remote_retrieve_response_code( $result );
	$body = wp_remote_retrieve_body( $result );
	if ( $code < 200 || $code >= 300 ) {
		return new WP_Error( 'dm_openclaw_http_status', 'OpenClaw respondio HTTP ' . $code . '.', array( 'status' => 502 ) );
	}

	return dm_openclaw_normalize_response( $body );
}

function dm_openclaw_websocket_request( $url, $token, $payload ) {
	$parts = wp_parse_url( $url );
	if ( empty( $parts['host'] ) ) {
		return new WP_Error( 'dm_openclaw_bad_url', 'OPENCLAW_GATEWAY_URL no es valida.', array( 'status' => 500 ) );
	}

	$scheme = empty( $parts['scheme'] ) ? 'ws' : strtolower( $parts['scheme'] );
	$secure = 'wss' === $scheme;
	$host   = $parts['host'];
	$port   = empty( $parts['port'] ) ? dm_openclaw_default_port( $scheme ) : intval( $parts['port'] );
	$path   = empty( $parts['path'] ) ? '/' : $parts['path'];
	if ( ! empty( $parts['query'] ) ) {
		$path .= '?' . $parts['query'];
	}

	$target = ( $secure ? 'ssl://' : 'tcp://' ) . $host . ':' . $port;
	$errno  = 0;
	$errstr = '';
	$socket = @stream_socket_client( $target, $errno, $errstr, 10 );
	if ( ! $socket ) {
		return new WP_Error( 'dm_openclaw_tcp_error', 'No se pudo conectar a OpenClaw por Tailscale.', array( 'status' => 502 ) );
	}

	stream_set_timeout( $socket, 45 );
	$key      = base64_encode( wp_generate_password( 16, false, false ) );
	$headers  = "GET {$path} HTTP/1.1\r\n";
	$headers .= "Host: {$host}:{$port}\r\n";
	$headers .= "Upgrade: websocket\r\n";
	$headers .= "Connection: Upgrade\r\n";
	$headers .= "Sec-WebSocket-Key: {$key}\r\n";
	$headers .= "Sec-WebSocket-Version: 13\r\n";
	$headers .= "Authorization: Bearer {$token}\r\n\r\n";

	fwrite( $socket, $headers );
	$response_headers = '';
	while ( ! feof( $socket ) ) {
		$line              = fgets( $socket, 4096 );
		$response_headers .= $line;
		if ( "\r\n" === $line || "\n" === $line ) {
			break;
		}
	}

	if ( false === strpos( $response_headers, ' 101 ' ) ) {
		fclose( $socket );
		return new WP_Error( 'dm_openclaw_ws_handshake', 'OpenClaw no acepto el WebSocket.', array( 'status' => 502 ) );
	}

	fwrite( $socket, dm_openclaw_ws_encode( wp_json_encode( $payload ) ) );
	$body = dm_openclaw_ws_read_text( $socket );
	fclose( $socket );

	if ( is_wp_error( $body ) ) {
		return $body;
	}

	return dm_openclaw_normalize_response( $body );
}

function dm_openclaw_default_port( $scheme ) {
	return in_array( $scheme, array( 'wss', 'https' ), true ) ? 443 : 80;
}

function dm_openclaw_tcp_check( $host, $port, $secure ) {
	$errno  = 0;
	$errstr = '';
	$target = ( $secure ? 'ssl://' : 'tcp://' ) . $host . ':' . $port;
	$socket = @stream_socket_client( $target, $errno, $errstr, 3 );
	if ( $socket ) {
		fclose( $socket );
		return array(
			'checked' => true,
			'ok'      => true,
		);
	}

	return array(
		'checked' => true,
		'ok'      => false,
	);
}

function dm_openclaw_ws_encode( $payload ) {
	$length = strlen( $payload );
	$header = chr( 129 );
	$mask   = wp_generate_password( 4, false, false );

	if ( $length <= 125 ) {
		$header .= chr( 128 | $length );
	} elseif ( $length <= 65535 ) {
		$header .= chr( 128 | 126 ) . pack( 'n', $length );
	} else {
		$header .= chr( 128 | 127 ) . pack( 'NN', 0, $length );
	}

	$encoded = '';
	for ( $i = 0; $i < $length; $i++ ) {
		$encoded .= $payload[ $i ] ^ $mask[ $i % 4 ];
	}

	return $header . $mask . $encoded;
}

function dm_openclaw_ws_read_text( $socket ) {
	$header = fread( $socket, 2 );
	if ( strlen( $header ) < 2 ) {
		return new WP_Error( 'dm_openclaw_ws_empty', 'OpenClaw no envio respuesta.', array( 'status' => 502 ) );
	}

	$bytes  = unpack( 'Cfirst/Csecond', $header );
	$opcode = $bytes['first'] & 15;
	$length = $bytes['second'] & 127;

	if ( 126 === $length ) {
		$extended = fread( $socket, 2 );
		$length   = current( unpack( 'n', $extended ) );
	} elseif ( 127 === $length ) {
		$extended = fread( $socket, 8 );
		$parts    = unpack( 'Nhigh/Nlow', $extended );
		$length   = $parts['low'];
	}

	$payload = '';
	while ( strlen( $payload ) < $length && ! feof( $socket ) ) {
		$payload .= fread( $socket, $length - strlen( $payload ) );
	}

	if ( 8 === $opcode ) {
		return new WP_Error( 'dm_openclaw_ws_closed', 'OpenClaw cerro la conexion WebSocket.', array( 'status' => 502 ) );
	}

	if ( 1 !== $opcode ) {
		return new WP_Error( 'dm_openclaw_ws_opcode', 'OpenClaw envio un frame WebSocket no textual.', array( 'status' => 502 ) );
	}

	return $payload;
}

function dm_openclaw_normalize_response( $body ) {
	$json = json_decode( $body, true );
	if ( is_array( $json ) ) {
		foreach ( array( 'reply', 'response', 'message', 'content', 'text', 'output' ) as $key ) {
			if ( isset( $json[ $key ] ) && is_string( $json[ $key ] ) ) {
				return array( 'reply' => $json[ $key ] );
			}
		}

		return array( 'reply' => wp_json_encode( $json ) );
	}

	return array( 'reply' => (string) $body );
}

add_action( 'wp_dashboard_setup', 'dm_openclaw_dashboard_widget' );
function dm_openclaw_dashboard_widget() {
	if ( current_user_can( dm_openclaw_capability() ) ) {
		wp_add_dashboard_widget( 'dm_openclaw_dashboard', 'OpenClaw', 'dm_openclaw_dashboard_render' );
	}
}

function dm_openclaw_dashboard_render() {
	echo '<div id="dm-openclaw-widget">';
	echo '<textarea id="dm-openclaw-message" rows="5" class="widefat" placeholder="Escribile a OpenClaw desde wp-admin"></textarea>';
	echo '<p><button type="button" class="button button-primary" id="dm-openclaw-send">Enviar</button> <span id="dm-openclaw-status"></span></p>';
	echo '<pre id="dm-openclaw-reply" style="white-space:pre-wrap;max-height:260px;overflow:auto;background:#f6f7f7;border:1px solid #dcdcde;padding:12px;"></pre>';
	echo '</div>';
}

add_action( 'admin_enqueue_scripts', 'dm_openclaw_admin_assets' );
function dm_openclaw_admin_assets( $hook ) {
	if ( 'index.php' !== $hook || ! current_user_can( dm_openclaw_capability() ) ) {
		return;
	}

	wp_register_script( 'dm-openclaw-admin', false, array( 'wp-api-fetch' ), '0.1.0', true );
	wp_enqueue_script( 'dm-openclaw-admin' );
	wp_add_inline_script( 'dm-openclaw-admin', dm_openclaw_admin_js() );
}

function dm_openclaw_admin_js() {
	return <<<'JS'
(function () {
  const button = document.getElementById('dm-openclaw-send');
  const textarea = document.getElementById('dm-openclaw-message');
  const status = document.getElementById('dm-openclaw-status');
  const reply = document.getElementById('dm-openclaw-reply');

  if (!button || !textarea || !status || !reply || !window.wp || !window.wp.apiFetch) return;

  window.wp.apiFetch({ path: '/openclaw/v1/status' }).then(function (response) {
    const tcp = response && response.tcp && response.tcp.ok ? 'TCP OK' : 'TCP no disponible';
    const token = response && response.configured ? 'token configurado' : 'falta token';
    status.textContent = tcp + ' · ' + token;
  }).catch(function () {
    status.textContent = 'No se pudo leer el estado de OpenClaw.';
  });

  function setBusy(isBusy) {
    button.disabled = isBusy;
    status.textContent = isBusy ? 'Consultando...' : '';
  }

  button.addEventListener('click', function () {
    const message = textarea.value.trim();
    if (!message) {
      status.textContent = 'Escribi un mensaje.';
      return;
    }

    setBusy(true);
    reply.textContent = '';

    window.wp.apiFetch({
      path: '/openclaw/v1/chat',
      method: 'POST',
      data: { message: message }
    }).then(function (response) {
      reply.textContent = response && response.reply ? response.reply : JSON.stringify(response, null, 2);
    }).catch(function (error) {
      reply.textContent = error && error.message ? error.message : 'Error consultando OpenClaw.';
    }).finally(function () {
      setBusy(false);
    });
  });
})();
JS;
}
