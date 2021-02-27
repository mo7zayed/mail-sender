<?php

namespace App\Http\Requests\Mails;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'emails' => [
                'required',
                'array',
                'min:1'
            ],
            'emails.*.email' => [
                'required',
                'max:255',
                'email',
            ],
            'emails.*.subject' => [
                'required',
                'max:255',
            ],
            'emails.*.body' => [
                'required',
                'max:5000',
            ],
            'emails.*.attachments.*.name' => [
                'required',
                'max:255',
            ],
            'emails.*.attachments.*.base64' => [
                'required',
                'string'
            ],
        ];
    }
}
