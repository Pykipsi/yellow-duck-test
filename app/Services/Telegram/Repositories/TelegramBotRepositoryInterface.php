<?php

declare(strict_types=1);

namespace App\Services\Telegram\Repositories;

use App\Models\Telegram\BotUser;
use App\Services\Telegram\Input\User;

interface TelegramBotRepositoryInterface
{
    public function addNewBotUser(User $user): BotUser;

    public function findBotUser(int $id): ?BotUser;
}
