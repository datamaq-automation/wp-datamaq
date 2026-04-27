<?php
namespace DataMaq\Domain\Content;

/**
 * Domain Model for a single Service Card.
 */
class ServiceItem {
    private string $title;
    private string $description;
    private string $subtitle;
    private array $items;
    private string $note;
    private string $ctaLabel;
    private string $iconClass;

    public function __construct(
        string $title,
        string $description,
        string $subtitle,
        array $items,
        string $note,
        string $ctaLabel,
        string $iconClass = 'bi-check2-circle'
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->subtitle = $subtitle;
        $this->items = $items;
        $this->note = $note;
        $this->ctaLabel = $ctaLabel;
        $this->iconClass = $iconClass;
    }

    public function getTitle(): string { return $this->title; }
    public function getDescription(): string { return $this->description; }
    public function getSubtitle(): string { return $this->subtitle; }
    public function getItems(): array { return $this->items; }
    public function getNote(): string { return $this->note; }
    public function getCtaLabel(): string { return $this->ctaLabel; }
    public function getIconClass(): string { return $this->iconClass; }
}
