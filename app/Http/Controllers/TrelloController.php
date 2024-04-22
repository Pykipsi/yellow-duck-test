<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Trello\Input\{Model, Action};
use App\Services\Trello\Enums\TrelloActionEnum;
use App\Services\Trello\Internal\TrelloServiceInterface;

class TrelloController extends Controller
{
    public function __construct(private readonly TrelloServiceInterface $trelloService)
    {
    }

    public function getAction(Request $request): void
    {
        if ($request->json('action') && $request->json('model')) {
            $model = $request->json('model');
            $action = $request->json('action');

            if (
                $model['id'] == config('services.trello.board_id') &&
                $action['display']['translationKey'] == TrelloActionEnum::MOVE_CARD->value
            ) {
                $this->trelloService->notifyIfTaskCompletion(
                    new Action(
                        (string)$action['data']['card']['name'],
                        (string)$action['data']['listBefore']['name'],
                        (string)$action['data']['listAfter']['name'],
                        (string)$action['data']['listBefore']['id'],
                        (string)$action['data']['listAfter']['id']
                    ),
                    new Model((string)$model['id'], (string)$model['name'], (string)$model['url'])
                );
            }
        }
    }

    /*public function getCards()
    {
        $client = new Client();
        $response = $client->request('GET', config('services.trello.api_url') . '/1' . '/boards/' . config('services.trello.board_id') . '/cards?', [
            'query' =>[
                'key' => config('services.trello.api_key'),
                'token' => config('services.trello.token')
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $cards = json_decode($response->getBody()->getContents(), true);

            foreach ($cards as $card) {
                if ($card['idList'] == BoardStatusEnum::IN_PROGRESS->value)
                {

                }
            }
        }
    }*/
}
