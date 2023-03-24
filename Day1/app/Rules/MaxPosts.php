<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
class MaxPosts implements ValidationRule
{
    public function validate(string  $attribute,mixed $value, Closure $fail): void
    {
        // $user = auth()->user();
        $postsCount = Post::where('user_id', $value)->count();
        if ($postsCount >= 3){
             $fail('You have exceeded the maximum number of allowed posts.');
        };
    }
    public function message()
    {
        return 'You have exceeded the maximum number of allowed posts.';
    }
}
