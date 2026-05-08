<?php
namespace DataMaq\Infrastructure\Content;

use DataMaq\Domain\Content\ContentRepositoryInterface;
use DataMaq\Domain\Content\ProfileSection;
use DataMaq\Domain\Content\ServicesSection;
use DataMaq\Domain\Content\ServiceItem;
use DataMaq\Domain\Content\BrandInfo;
use DataMaq\Domain\Content\HeroSection;
use DataMaq\Domain\Content\FaqSection;
use DataMaq\Domain\Content\FaqItem;
use DataMaq\Domain\Content\FooterSection;
use DataMaq\Domain\Content\ContactSection;
use DataMaq\Domain\Content\ContactPage;
use DataMaq\Domain\Shared\Validation\ContentValidator;

class StaticContentRepository implements ContentRepositoryInterface {
	private array $data;

	public function __construct() {
		if ( function_exists( 'get_datamaq_site_data' ) ) {
			$this->data = get_datamaq_site_data();
		} else {
			$this->data = array();
		}

		// Validation - Blindage
		if ( class_exists( 'DataMaq\Domain\Shared\Validation\ContentValidator' ) ) {
			try {
				\DataMaq\Domain\Shared\Validation\ContentValidator::validate( $this->data );
			} catch ( \Throwable $e ) {
				if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
					error_log( 'DataMaq Content Validation Error: ' . $e->getMessage() );
				}
			}
		}
	}

	public function getAll(): array {
		return $this->data;
	}

	public function getSection( string $key ): ?array {
		return $this->data[ $key ] ?? null;
	}

	public function getFullContactPage(): ContactPage {
		$data = $this->data['contact'] ?? array();

		return new ContactPage(
			$data['title'] ?? 'Contacto',
			$data['introCopy'] ?? '',
			$data['support']['channels'] ?? array(),
			$data['technician'] ?? array()
		);
	}

	public function getContactSection(): ContactSection {
		$data = $this->data['contact'] ?? array();

		return new ContactSection(
			$data['title'] ?? 'Inici&aacute; una consulta t&eacute;cnica',
			$data['subtitle'] ?? '',
			$data['steps'] ?? array( 'Identidad', 'Proyecto', 'Contacto' ),
			$data['alternativeEmail'] ?? 'info@datamaq.com.ar'
		);
	}

	public function getFooterSection(): FooterSection {
		$data = $this->data['footer'] ?? array();

		return new FooterSection(
			$data['copyright'] ?? '(c) {year} DataMaq',
			$data['legal'] ?? '',
			$data['whatsapp'] ?? ''
		);
	}

	public function getHeroSection(): HeroSection {
		$data = $this->data['hero'] ?? array();

		return new HeroSection(
			$data['eyebrow'] ?? 'Captura autom&aacute;tica de datos operativos',
			$data['title'] ?? '',
			$data['subtitle'] ?? '',
			$data['ctaLabel'] ?? 'Escribime por WhatsApp',
			$data['statusInfo'] ?? '',
			$data['trustChips'] ?? array(),
			$data['image'] ?? ''
		);
	}

	public function getFaqSection(): FaqSection {
		$data  = $this->data['faq'] ?? array();
		$items = array();

		foreach ( ( $data['items'] ?? array() ) as $item ) {
			$items[] = new FaqItem(
				$item['question'] ?? '',
				$item['answer'] ?? '',
				$item['open'] ?? false
			);
		}

		return new FaqSection(
			$data['eyebrow'] ?? 'Ayuda',
			$data['title'] ?? 'Preguntas frecuentes',
			$items
		);
	}

	public function getBrandInfo(): BrandInfo {
		$data = $this->data['brand'] ?? array();

		return new BrandInfo(
			$data['name'] ?? 'DataMaq',
			$data['nav'] ?? array(),
			$data['contact_url'] ?? '/contacto',
			$data['training_url'] ?? '/courses',
			$data['products_url'] ?? '/productos',
			$data['relevamiento_url'] ?? '/product/relevamiento-tecnico-y-visita-a-planta/',
			$data['automatizacion_url'] ?? '/product/solucion-de-automatizacion-a-medida/',
			$data['whatsapp'] ?? ''
		);
	}

	public function getProfileSection(): ProfileSection {
		$data = $this->data['profile'] ?? array();

		return new ProfileSection(
			$data['name'] ?? 'Agustin Bustos',
			$data['role'] ?? 'Sobre DataMaq',
			$data['lead'] ?? '',
			$data['how_i_work'] ?? '',
			$data['photo'] ?? '',
			$data['bullets'] ?? array(),
			$data['whatsappLabel'] ?? 'Escribime directo por WhatsApp'
		);
	}

	public function getServicesSection(): ServicesSection {
		$data     = $this->data['services'] ?? array();
		$services = array();

		foreach ( ( $data['cards'] ?? array() ) as $card ) {
			$services[] = new ServiceItem(
				$card['title'] ?? '',
				$card['description'] ?? '',
				$card['subtitle'] ?? '',
				$card['items'] ?? array(),
				$card['note'] ?? '',
				$card['cta']['label'] ?? '',
				$card['icon'] ?? 'bi-check2-circle'
			);
		}

		return new ServicesSection(
			$data['eyebrow'] ?? 'Servicios',
			$data['title'] ?? '',
			$data['intro'] ?? '',
			$services
		);
	}
}
