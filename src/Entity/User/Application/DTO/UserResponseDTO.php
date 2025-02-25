<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Application\DTO;

class UserResponseDTO
{
    private string $id;
    private string $name;
    private string $email;
    private string $createdAt;

    public function __construct(string $id, string $name, string $email, string $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }

    final public function toJson(): string
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdAt' => $this->createdAt
        ]);
    }
}
