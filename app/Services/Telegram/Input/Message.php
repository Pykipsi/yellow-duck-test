<?php

declare(strict_types=1);

namespace App\Services\Telegram\Input;

use App\Traits\ReformatDateTrait;

class Message
{
    use ReformatDateTrait;

    private User $botUser;
    private Chat $chat;

    private string $date;
    private string $text;

    public function __construct(User $botUser, Chat $chat, string $date, string $text)
    {
        $this->botUser = $botUser;
        $this->chat = $chat;
        $this->text = $text;
        $this->date = $this->dateFromTimestamp($date);
    }

    public function getBotUser(): User
    {
        return $this->botUser;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
