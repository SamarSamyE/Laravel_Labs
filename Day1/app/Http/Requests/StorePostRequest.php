<?php

namespace App\Http\Requests;
use App\Rules\MaxPosts;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class StorePostRequest extends FormRequest
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
        return [
            'post_creator' => ['exists:users,id', new MaxPosts],
            'title' => ['required','min:3', 'regex:/^[a-zA-Z.\s]+$/',Rule::unique('posts')->ignore($this->id)],
            'description'=>['required','min:10', 'regex:/^[a-zA-Z.\s]+$/'],
            'image' =>['max:2048', 'mimes:jpeg,png,jpg'],
         ];
    }

    public function messages(): array
{
    return [
        'title.required' => 'A title is required',
        'description.required' => 'A description is required',
        'title.min' => 'A title is must be at least 3 characters ,and accept characters only',
        'description.min' => 'A description is is must be at least 10 characters ,and accept characters only',
    ];
}
}
