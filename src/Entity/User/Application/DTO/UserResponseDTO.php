<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Application\DTO;

use DateTime;

class UserResponseDTO
{
    private string $id;
    private string $name;
    private string $email;
    private ?DateTime $createdAt;
    private bool $result;
    private string $message;

    public function __construct(bool $result = false, string $message = '', string $id = '', string $name = '', string $email = '', ?DateTime $createdAt = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = $createdAt;
        $this->result = $result;
        $this->message = $message;
    }

    final public function result(): bool
    {
        return $this->result;
    }

    final public function message(): string
    {
        return $this->message;
    }

    final public function toJson(): string
    {
        return json_encode([
            'result' => $this->result,
            'message' => $this->message,
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->createdAt
        ]);
    }
}
