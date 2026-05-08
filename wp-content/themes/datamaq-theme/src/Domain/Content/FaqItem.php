<?php
namespace DataMaq\Domain\Content;

/**
 * Domain Model for a single FAQ item.
 */
class FaqItem {
	private string $question;
	private string $answer;
	private bool $isOpen;

	public function __construct( string $question, string $answer, bool $isOpen = false ) {
		$this->question = $question;
		$this->answer   = $answer;
		$this->isOpen   = $isOpen;
	}

	public function getQuestion(): string {
		return $this->question; }
	public function getAnswer(): string {
		return $this->answer; }
	public function isOpen(): bool {
		return $this->isOpen; }
}
