<?php

namespace App\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EstateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role_id === Role::AGENT;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'GET':
            case 'DELETE':
                return[];
            case 'POST': {
                return [
                    'name' => 'required|min:5',
                    'description' => 'required|min:30',
                    'category_id' => [
                        'required',
                        Rule::exists('categories', 'id')
                    ],
                    'picture' => 'required|image|mimes:jpg,jpeg,png',
                    'address' => 'required|min:10',
                    'city' => 'required|min:5',
                    'country' => 'required|min:5',
                    'price' => 'required|min:6',
                    'bathrooms' => 'required|min:1|max:10',
                    'bedrooms' => 'required|min:1|max:10',
                ];
            }
            case 'PUT': {
                return [
                    'name' => 'required|min:5',
                    'description' => 'required|min:30',
                    'category_id' => [
                        'required',
                        Rule::exists('categories', 'id')
                    ],
                    'picture' => 'sometimes|image|mimes:jpg,jpeg,png',
                    'address' => 'required|min:10',
                    'city' => 'required|min:5',
                    'country' => 'required|min:5',
                    'price' => 'required|min:6',
                    'bathrooms' => 'required|min:1|max:10',
                    'bedrooms' => 'required|min:1|max:10',
                ];
            }
        }
    }
}
