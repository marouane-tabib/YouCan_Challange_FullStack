<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        switch ($this->method()){
            case 'POST' :
            {
                return [
                    'image' => 'required|image|max:7024',
                    'name' => 'required|string|min:3|max:55',
                    'description' => 'required|string|min:10',
                    'category_id' => 'required|exists:categories,id',
                    'price' => 'required|numeric|min:1',
                ];
            }
            case 'PUT' :
            {
                //
            }
            case 'PATCH' :
            {
                //
            }
            default: break;
        }
        return [
            //
        ];
    }
}
