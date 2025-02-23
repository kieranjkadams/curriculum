<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvitationRequest extends FormRequest
{
/**
 * Get the validation rules that apply to the request.
 *
 * @return array
 */
public function rules()
{
    return [
        'email' => 'required|email|unique:invitations'
    ];
}

/**
 * Custom error messages.
 *
 * @return array
 */
public function messages()
{
    return [
        'email.unique' => 'Invitation with this email address already requested.'
    ];
}

}
