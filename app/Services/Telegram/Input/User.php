<?php

declare(strict_types=1);

namespace App\Services\Telegram\Input;

class User
{
    private bool $isBot;
    private int $id;
    private string $firstName;
    private string $nickName = '';

    public function __construct(bool $isBot, int $id, string $firstName)
    {
        $this->isBot = $isBot;
        $this->id = $id;
        $this->firstName = $firstName;
    }

    public function isBot(): bool
    {
        return $this->isBot;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getNickName(): string
    {
        return $this->nickName;
    }

    public function setNickName(string $nickName): void
    {
        $this->nickName = $nickName;
    }
}
