<?php

namespace DataMaq\Domain\Chat;

/**
 * Servicio de Dominio para el Chatbot.
 * Aquí reside la lógica de "qué" responder, independiente de la tecnología.
 */
class ChatbotService {

	/**
	 * Devuelve un array de reglas estáticas (Intención => Respuesta).
	 *
	 * @return array<string, string>
	 */
	public function getStaticRules(): array {
		return array(
			'hola|buen(as|os) (dias|tardes|noches)' => '¡Hola! Soy el asistente virtual de DataMaq. ¿En qué puedo ayudarte?',
			'cursos|estudiar|aprender'               => 'Ofrecemos cursos especializados en WordPress, PHP y Arquitectura de Software. ¿Te gustaría ver el catálogo?',
			'precio|costo|cuanto sale'               => 'Nuestros precios son competitivos y varían según el curso. ¿De qué curso te gustaría saber el precio?',
			'contacto|hablar con alguien|humano'    => 'Puedes contactarnos directamente al mail info@datamaq.com.ar o esperar a que un operador se conecte.',
		);
	}

	/**
	 * Mensaje por defecto cuando no se entiende la intención.
	 */
	public function getFallbackMessage(): string {
		return 'Lo siento, todavía estoy aprendiendo. Por ahora puedo ayudarte con información sobre cursos, precios y contacto.';
	}
}
