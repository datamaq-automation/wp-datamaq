<?php
namespace DataMaq\Domain\Content;

/**
 * Domain Model for the FAQ Section.
 */
class FaqSection {
    private string $eyebrow;
    private string $title;
    private array $items;

    /**
     * @param string $eyebrow
     * @param string $title
     * @param FaqItem[] $items
     */
    public function __construct(string $eyebrow, string $title, array $items) {
        $this->eyebrow = $eyebrow;
        $this->title = $title;
        $this->items = $items;
    }

    public function getEyebrow(): string { return $this->eyebrow; }
    public function getTitle(): string { return $this->title; }
    public function getItems(): array { return $this->items; }
}
