<?php

class Contact {
    private ?int $id = null;
    private string $name;
    private string $email;
    private string $phoneNumber;

    public function __toString(): string
    {
        return sprintf(
            "Contact #%s : %s (%s) - Tél : %s",
            $this->id ?? 'Nouveau',
            $this->name,
            $this->email,
            $this->phoneNumber
        );
    }

    // --- ID ---
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    // --- NAME ---
    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    // --- EMAIL ---
    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    // --- PHONE NUMBER ---
    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }
}