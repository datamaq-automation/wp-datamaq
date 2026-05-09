<?php
namespace DataMaq\UI\Http\Ajax;

use DataMaq\Domain\Lead\LeadEntity;
use DataMaq\Application\Lead\SubmitLeadUseCase;
use DataMaq\Domain\Shared\Exceptions\ValidationException;
use DataMaq\Domain\Shared\Exceptions\DomainException;

class ContactController {
	public function handleRequest() {
		try {
			check_ajax_referer( 'datamaq_contact_nonce', 'security' );

			// Map frontend fields (prefix dm_) to domain entity
			$name    = sanitize_text_field( $_POST['dm_name'] ?? '' );
			$email   = sanitize_email( $_POST['dm_email'] ?? '' );
			$company = sanitize_text_field( $_POST['dm_company'] ?? '' );
			$message = sanitize_text_field( $_POST['dm_message'] ?? '' );
			$channel = sanitize_text_field( $_POST['dm_channel'] ?? 'whatsapp' );
			$phone   = sanitize_text_field( $_POST['dm_phone'] ?? '' );

			$errors = array();

			if ( empty( $name ) ) {
				$errors['dm_name'] = 'El nombre es obligatorio';
			}

			if ( empty( $email ) && empty( $phone ) ) {
				$errors['dm_contact'] = 'Indica un email o teléfono de contacto';
			}

			if ( ! empty( $errors ) ) {
				throw new ValidationException( $errors );
			}

			// Infrastructure Injection via Factory
			$useCase = dm_submit_lead_use_case();

			$lead = new LeadEntity(
				$name,
				$email,
				$phone,
				array(
					'company'     => $company,
					'description' => $message,
					'channel'     => $channel,
				)
			);

			if ( $useCase->execute( $lead ) ) {
				wp_send_json_success( array( 'message' => '¡Gracias! Tu consulta ha sido enviada con éxito.' ) );
			} else {
				throw new DomainException( 'Error al conectar con el servicio de mensajería' );
			}
		} catch ( ValidationException $e ) {
			wp_send_json_error(
				array(
					'message' => $e->getMessage(),
					'errors'  => $e->getErrors(),
					'status'  => 422,
				)
			);
		} catch ( DomainException $e ) {
			wp_send_json_error(
				array(
					'message' => $e->getMessage(),
					'status'  => 500,
				)
			);
		} catch ( \Throwable $e ) {
			wp_send_json_error(
				array(
					'message' => 'Error crítico: ' . $e->getMessage(),
					'status'  => 500,
				)
			);
		}
	}
}
