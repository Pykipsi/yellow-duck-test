<?php

declare(strict_types=1);

namespace App\Services\Trello\Internal;

use App\Services\Trello\Input\{Action, Model};
use App\Services\Telegram\Internal\TelegramBotServiceInterface;
use App\Services\Trello\Enums\BoardStatusEnum;

class TrelloService implements TrelloServiceInterface
{
    public function __construct(private readonly TelegramBotServiceInterface $botService)
    {
    }

    public function notifyIfTaskCompletion(Action $action, Model $model): bool
    {
        if ($action->getCodeStatusBefore() == BoardStatusEnum::IN_PROGRESS->value && $action->getCodeStatusAfter(
            ) == BoardStatusEnum::DONE->value) {
            $message = 'На дошцi ' . $model->getName() . ', задача ' . $action->getName(
                ) . ', була перенесена з статусу ' . $action->getStatusBefore() . ' до ' . $action->getStatusAfter() .
                '. Посилання на дошку: ' . $model->getUrl();

            return $this->botService->sendMessage(config('services.telegram.group_id'), $message);
        }

        return false;
    }
}
