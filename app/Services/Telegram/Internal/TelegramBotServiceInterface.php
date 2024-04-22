<?php

declare(strict_types=1);

namespace App\Services\Telegram\Internal;

use App\Services\Telegram\Input\Message;

interface TelegramBotServiceInterface
{
    public function processMessage(Message $message);

    public function sendMessage(string $chatId, string $text): bool;
}
