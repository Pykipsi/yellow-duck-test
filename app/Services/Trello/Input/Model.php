<?php

declare(strict_types=1);

namespace App\Services\Trello\Input;

class Model
{
    private string $id;
    private string $name;
    private string $url;

    public function __construct(string $id, string $name, string $url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
