<?php
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/login/google/callback', function () {
    $user = Socialite::driver('google')->user();
    
    // Check if the user with this Google ID exists in your database
    $existingUser = User::where('google_id', $user->id)->first();
    
    if ($existingUser) {
        // Log in the existing user
        Auth::login($existingUser);
    } else {
        // Create a new user and save their Google ID
        $newUser = new User();
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->google_id = $user->id; // Asigna el ID de Google
        $newUser->save();
        
        // Log in the newly created user
        Auth::login($newUser);
    }
    
    return redirect()->route('dashboard');
});


Route::get('/login/apple', function () {
    return Socialite::driver('apple')->redirect();
});

Route::get('/login/apple/callback', function () {
    $user = Socialite::driver('apple')->user();
    // Handle the authenticated user here
});
