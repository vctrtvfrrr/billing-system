<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChargeStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array|\Illuminate\Contracts\Validation\ValidationRule|string>
     */
    public function rules(): array
    {
        return [
            'debtId'     => ['required', 'integer'],
            'paidAt'     => ['required', 'date'],
            'paidAmount' => ['required', 'numeric'],
            'paidBy'     => ['required', 'string'],
        ];
    }
}
