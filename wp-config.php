<?php
/**
 * The base configuration for WordPress
 */

define( 'DB_NAME', 'datamaq_local' );
define( 'DB_USER', 'datamaq_user' );
define( 'DB_PASSWORD', 'datamaq_pass' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

define( 'AUTH_KEY',          '7Q1<}?EqiAyO[qBfN@I#Z$$z?&@Z*1rz+ MlHjYaFG/rta(+?+,_lO[0kUit.$/u' );
define( 'SECURE_AUTH_KEY',   'Hq)+c/k&+s?)&^$QU*;Z`-JPV6yI:kKnSTv~dFm&_{;-Ky<RSjRM:W7Wmf5vqqV,' );
define( 'LOGGED_IN_KEY',     '!}6PB3[s&SW~`Ti{T=H5UAv@<IS-X[=9,1EO4oQtb=#&e&:DysQbFZcls.lW-6u6' );
define( 'NONCE_KEY',         'eRBjN>(&Z^nuhUU~7sqBe*:hW9Nn0Piy{N=;pU(b.EVQ//.A-k3^`fE/K6<JY,2' );
define( 'AUTH_SALT',         'W,Md?OGKHVlA|`^$TGz.*r*`5[M#H72wSN_BOcrt[b!VfELV,Y$$d+F hK3?LH_2' );
define( 'SECURE_AUTH_SALT',  '7b453u?H696n=cs(464hG_CBeV:jP)@[D%FIroyXXf_9~!_>i+Ni~-:hP!CgFntg' );
define( 'LOGGED_IN_SALT',    'rE%5*DmWRt)~mJ]j];3MQ;P4zaFlvtutVh34M5;{Il,NxfNX1,=`vzBX !w%Nik[' );
define( 'NONCE_SALT',        '&WB7sjZ$sU<2;)j!&Hm?W6x<EWY|q[=VMoRs4{]:D[VGvuLwS/f[mY,-@GkB/Gd!' );
define( 'WP_CACHE_KEY_SALT', 'af562d9d8899dbbeeacf6d2a0de5b027cf32cf9293cb514b181d54fedffaee0b' );

$table_prefix = 'wp_';

define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'WP_CACHE', true );
define( 'DISABLE_WP_CRON', true );
if ( ! defined( 'WPCACHEHOME' ) ) {
}

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

define( 'FS_METHOD', 'direct' );

define( 'WP_HOME', 'https://datamaq.local' );
define( 'WP_SITEURL', 'https://datamaq.local' );
define( 'FORCE_SSL_ADMIN', true );

/** Fix para bucles de redirección en entornos con proxy SSL */
if (
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
    (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on')
) {
    $_SERVER['HTTPS'] = 'on';
}

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
