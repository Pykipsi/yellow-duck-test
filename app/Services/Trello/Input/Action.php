<?php

declare(strict_types=1);

namespace App\Services\Trello\Input;

class Action
{
    private string $name;
    private string $statusBefore;
    private string $statusAfter;
    private string $codeStatusBefore;
    private string $codeStatusAfter;

    public function __construct(
        string $name,
        string $statusBefore,
        string $statusAfter,
        string $codeStatusBefore,
        string $codeStatusAfter
    ) {
        $this->name = $name;
        $this->statusBefore = $statusBefore;
        $this->statusAfter = $statusAfter;
        $this->codeStatusBefore = $codeStatusBefore;
        $this->codeStatusAfter = $codeStatusAfter;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatusBefore(): string
    {
        return $this->statusBefore;
    }

    public function getStatusAfter(): string
    {
        return $this->statusAfter;
    }

    public function getCodeStatusBefore(): string
    {
        return $this->codeStatusBefore;
    }

    public function getCodeStatusAfter(): string
    {
        return $this->codeStatusAfter;
    }
}
