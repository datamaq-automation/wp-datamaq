<?php
namespace DataMaq\Domain\Lead;

class LeadEntity {
	private string $name;
	private string $email;
	private string $company;
	private string $message;
	private string $channel;
	private string $phone;
	private string $firstName;
	private string $lastName;

	public function __construct( string $name, string $email, string $company, string $message, string $channel, string $phone = '', string $firstName = '', string $lastName = '' ) {
		$this->name      = $name;
		$this->email     = $email;
		$this->company   = $company;
		$this->message   = $message;
		$this->channel   = $channel;
		$this->phone     = $phone;
		$this->firstName = $firstName;
		$this->lastName  = $lastName;
	}

	public function toArray(): array {
		return array(
			'name'       => $this->name,
			'first_name' => $this->firstName,
			'last_name'  => $this->lastName,
			'email'      => $this->email,
			'company'    => $this->company,
			'message'    => $this->message,
			'channel'    => $this->channel,
			'phone'      => $this->phone,
		);
	}

	public function getName(): string {
		return $this->name; }
	public function getFirstName(): string {
		return $this->firstName; }
	public function getLastName(): string {
		return $this->lastName; }
	public function getEmail(): string {
		return $this->email; }
	public function getPhone(): string {
		return $this->phone; }
}
