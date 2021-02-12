<?php

namespace App\Http\Requests;

use App\Enums\PageStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'name' => "required|string|min:2|max:60|unique:pages,name,$this->id,id",
            'content' => 'required|string',
            'status' => ['required', 'string', Rule::in(PageStatus::getValues())],
            'description' => 'required|string|max:255',
        ];
    }

}
