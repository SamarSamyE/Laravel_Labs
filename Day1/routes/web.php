<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' =>['auth']],function(){
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.login');

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    $existingUser = User::where('email', $githubUser->getEmail())->first();
if ($existingUser) {
    // The user already exists in the database, log them in
    Auth::login($existingUser);
    // auth()->login($existingUser);
}
else{
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'password' => bcrypt('default_password'),
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);
}
    return redirect('/posts');
    // dd($user);
})->name('github.callback');





Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/login/google/callback', function () {
    $gmailUser = Socialite::driver('google')->user();
    $existingUser = User::where('email', $gmailUser->getEmail())->first();
if ($existingUser) {
    // The user already exists in the database, log them in
    Auth::login($existingUser);
    // auth()->login($existingUser);
}
else{
    $user = User::updateOrCreate([
        'google_id' => $gmailUser->id,
    ], [
        'name' => $gmailUser->name,
        'email' => $gmailUser->email,
        'password' => bcrypt('default_password'),
        'google_token' => $gmailUser->token,
        'google_refresh_token' => $gmailUser->refreshToken,
    ]);

    Auth::login($user);
}
    return redirect('/posts');
    // dd($user);
})->name('google.callback');
