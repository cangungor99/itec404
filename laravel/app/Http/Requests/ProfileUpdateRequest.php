<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()->userID;

        return [
            'std_no'  => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'std_no')
                    ->ignore($userId, 'userID'),
            ],
            'email'   => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($userId, 'userID'),
            ],
            'name'    => ['required','string','max:255'],
            'surname' => ['required','string','max:255'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
