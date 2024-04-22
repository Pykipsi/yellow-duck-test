<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Trello\Internal\{TrelloService, TrelloServiceInterface};
use App\Services\Telegram\Internal\{TelegramBotService, TelegramBotServiceInterface};
use App\Services\Telegram\Repositories\{TelegramBotRepository, TelegramBotRepositoryInterface};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TelegramBotServiceInterface::class, TelegramBotService::class);
        $this->app->bind(TelegramBotRepositoryInterface::class, TelegramBotRepository::class);
        $this->app->bind(TrelloServiceInterface::class, TrelloService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
