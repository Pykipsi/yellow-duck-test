<?php

declare(strict_types=1);

namespace App\Services\Trello\Enums;

enum TrelloActionEnum: string
{
    case MOVE_CARD = 'action_move_card_from_list_to_list';
}
