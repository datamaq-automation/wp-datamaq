<?php
/**
 * Interfaz para el motor del chatbot.
 *
 * @package DataMaq\Domain\Chat
 */

namespace DataMaq\Domain\Chat;

/**
 * Interface BotEngine
 *
 * Define el contrato para el procesamiento de conversaciones.
 */
interface BotEngine {
	/**
	 * Escucha y procesa la petición entrante.
	 */
	public function listen(): void;

	/**
	 * Define las reglas básicas de respuesta.
	 */
	public function setupRules(): void;
}
