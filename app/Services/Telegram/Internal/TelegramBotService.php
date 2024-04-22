<?php

declare(strict_types=1);

namespace App\Services\Telegram\Internal;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Services\Telegram\Input\Message;
use App\Services\Telegram\Enums\BotCommandEnum;
use App\Services\Telegram\Repositories\TelegramBotRepositoryInterface;

class TelegramBotService implements TelegramBotServiceInterface
{
    public function __construct(private readonly TelegramBotRepositoryInterface $botRepository)
    {
    }

    /**
     * @throws GuzzleException
     */
    public function processMessage(Message $message): bool
    {
        if (!BotCommandEnum::tryFrom($message->getText())) {
            $this->sendMessage(
                $message->getChat()->getId(),
                $message->getBotUser()->getFirstName() . ', вибач, я не розумiю.'
            );

            return false;
        } else {
            $command = BotCommandEnum::from($message->getText());

            if ($command == BotCommandEnum::START) {
                if (empty($this->botRepository->findBotUser($message->getBotUser()->getId()))) {
                    $this->addNewBotUser($message);
                } else {
                    $this->sendMessage(
                        $message->getChat()->getId(),
                        $message->getBotUser()->getFirstName() . ', ми вже знайомi.'
                    );
                }
            }

            return true;
        }
    }

    /**
     * @throws GuzzleException
     */
    public function sendMessage(string $chatId, string $text): bool
    {
        $client = new Client();

        $response = $client->post(
            config('services.telegram.webhook_url') . '/bot' . config('services.telegram.bot_token') . '/sendMessage',
            [
                'form_params' => ['chat_id' => $chatId, 'text' => $text]
            ]
        );

        if ($response->getStatusCode() == 200) {
            return true;
        }

        return false;
    }

    /**
     * @throws GuzzleException
     */
    private function addNewBotUser(Message $message): void
    {
        if (!$message->getBotUser()->isBot()) {
            $this->botRepository->addNewBotUser($message->getBotUser());

            $this->welcomeNewUser($message);
        }
    }

    /**
     * @throws GuzzleException
     */
    private function welcomeNewUser(Message $message): void
    {
        $this->sendMessage($message->getChat()->getId(), 'Привiт, ' . $message->getBotUser()->getFirstName());
    }

    /*
    public function check()
    {
        $replyMarkup = json_encode(array(
            'keyboard' => array(
                array(
                    array(
                        'text' => 'Тестовая кнопка 1',
                        'url' => 'YOUR BUTTON URL',
                    )
                )
            ),
            'one_time_keyboard' => TRUE,
            'resize_keyboard' => TRUE,
        ));

        $chatId = config('services.telegram.group_id');
        $text = 'test';


        $client = new Client();

        Log::log('debug', 'sendMessage: chat_id=' . $chatId . ', text=' . $text);

        $response = $client->post(
            config('services.telegram.webhook_url') . '/bot' . config('services.telegram.bot_token') . '/sendMessage',
            [
                'form_params' => ['chat_id' => $chatId, 'text' => $text, 'parse_mode' => 'html', 'reply_markup' => $replyMarkup]
            ]
        );
    }*/
}
