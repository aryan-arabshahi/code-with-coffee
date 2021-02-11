<?php

namespace App\Http\Requests;

use App\Enums\ArticleStatus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'name' => "required|string|min:2|max:60|unique:articles,name,$this->id,id",
            'category_id' => 'required|integer|exists:categories,id',
            'content' => 'required|string',
            'status' => ['required', 'string', Rule::in(ArticleStatus::getValues())],
            'description' => 'required|string|max:255',
            'image' => $this->getImageRules(),
        ];
    }

    /**
     * Get the image rules based on the route
     */
    private function getImageRules(): array
    {
        $image_rules = [
            'image',
            'mimes:jpg,png',
        ];
        array_unshift(
            $image_rules,
            ($this->route()->getName() === 'articles.create') ?
                'required'
            :
                'nullable'
        );
        return $image_rules;
    }

}
