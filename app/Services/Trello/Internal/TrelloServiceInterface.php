<?php

declare(strict_types=1);

namespace App\Services\Trello\Internal;

use App\Services\Trello\Input\{Action, Model};

interface TrelloServiceInterface
{
    public function notifyIfTaskCompletion(Action $action, Model $model): bool;
}
