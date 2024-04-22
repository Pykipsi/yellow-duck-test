<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Services\Telegram\Input\{Chat, Message, User};
use App\Services\Telegram\Internal\TelegramBotServiceInterface;


class TelegramController extends Controller
{
    public function __construct(private TelegramBotServiceInterface $telegramBotService)
    {
    }

    public function getAction(Request $request)
    {
        if ($request->json('message')) {
            $message = $request->json('message');

            $user = new User(
                (bool)$message['from']['is_bot'],
                (int)$message['from']['id'],
                (string)$message['from']['first_name']
            );

            if ($message['from']['username']) {
                $user->setNickName($message['from']['username']);
            }

            $this->telegramBotService->processMessage(
                new Message(
                    $user,
                    new Chat(
                        (string)$message['chat']['id'],
                        (string)$message['chat']['type']
                    ),
                    $message['date'],
                    $message['text'],
                )
            );
        } else {
            Log::error('Wrong telegram action: ', ['request' => $request->all()]);
        }
    }
}
