<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            case 'POST':
            {
                return [
                    'title' => 'required|string|min:3|max:255',
                    'text' => 'required|string|min:3',
                    'image'  => 'max:2048|mimes:jpeg,bmp,png,jpg,gif',
                ];
            }
            case 'PUT':
                {
                    return [
                        'title' => 'required|string|min:3|max:255',
                        'text' => 'required|string|min:3',
                        'image'  => 'max:2048|mimes:jpeg,bmp,png,jpg,gif',
                    ];
                }
                break;
            default:
                break;
        }
    }
}
