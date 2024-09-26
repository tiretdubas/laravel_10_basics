<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?? $this->title),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $request): array
    {
        return [
            'title' => ['required', 'string', 'between:3,255'],
            'slug' => ['required', 'string', 'between:3,255', Rule::unique('posts')->ignore($this->post)],
            'content' => ['required', 'string', 'min:10'],
            'thumbnail' => [Rule::requiredIf($request->isMethod('post')), 'image'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'tag_ids' => ['array', 'exists:tags,id'],
        ];
    }
}
