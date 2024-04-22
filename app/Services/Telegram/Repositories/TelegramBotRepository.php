<?php

declare(strict_types=1);

namespace App\Services\Telegram\Repositories;

use App\Models\Telegram\BotUser;
use App\Services\Telegram\Input\User;

class TelegramBotRepository implements TelegramBotRepositoryInterface
{
    private BotUser $botUser;

    public function __construct(BotUser $botUser)
    {
        $this->botUser = $botUser;
    }

    public function addNewBotUser(User $user): BotUser
    {
        $newBotUser = new BotUser([
            'id' => $user->getId(),
            'first_name' => $user->getFirstName(),
            'user_name' => $user->getNickName(),
        ]);

        $newBotUser->save();

        return $newBotUser;
    }

    public function findBotUser(int $id): ?BotUser
    {
        return $this->botUser->query()->find($id);
    }
}
