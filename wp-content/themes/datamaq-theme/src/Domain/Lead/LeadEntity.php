<?php
namespace DataMaq\Domain\Lead;

class LeadEntity {
    private string $name;
    private string $email;
    private string $company;
    private string $message;
    private string $channel;
    private string $phone;

    public function __construct(string $name, string $email, string $company, string $message, string $channel, string $phone = '') {
        $this->name = $name;
        $this->email = $email;
        $this->company = $company;
        $this->message = $message;
        $this->channel = $channel;
        $this->phone = $phone;
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'company' => $this->company,
            'message' => $this->message,
            'channel' => $this->channel,
            'phone' => $this->phone,
        ];
    }

    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getPhone(): string { return $this->phone; }
}
