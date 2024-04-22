<?php

declare(strict_types=1);

namespace App\Http\Requests\Bot;

use Illuminate\Foundation\Http\FormRequest;

class SetWebhookRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
        ];
    }
}
