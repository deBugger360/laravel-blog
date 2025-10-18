<?php

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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

            

// Static Pages
Route::view('/about', 'blog.about');
Route::view('/contact', 'blog.contact');

// Route to display the home page with all blog posts
Route::get('/', [PostController::class, 'index']);


// Route to display a specific blog post by title (slug)
Route::get('/posts/{slug}', [PostController::class, 'show']);


// display blog post by search, category, tags, or author
Route::get('/content',  [PostController::class, 'filtered']); 


Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [UserController::class, 'profile']);
    Route::get('/admin/posts/create', [PostController::class, 'create']);
    Route::post('/admin/posts/store', [PostController::class, 'store']);
    Route::get('/admin/posts/manage', [PostController::class, 'manage']);
    Route::get('/admin/posts/{id}/edit', [PostController::class, 'edit'])->middleware('can:update,post');
    Route::put('/admin/posts/{id}', [PostController::class, 'update'])->middleware('can:update,post');
    Route::delete('/admin/posts/{id}', [PostController::class, 'destroy'])->middleware('can:delete,post');
});



// route to show all blog posts in admin using pagination
Route::get('/admin/posts/manage', [PostController::class, 'manage'])->middleware('auth');


// Store blog post
Route::post('/admin/posts/store', [PostController::class, 'store'])->middleware('auth');


// Show post edit form
Route::get('/admin/posts/{id}/edit', [PostController::class, 'edit'])->middleware('auth');


// Update the post edit form
Route::put('/admin/posts/{id}', [PostController::class, 'update'])->middleware('auth');


// Delete blog post
Route::delete('/admin/posts/{id}', [PostController::class, 'destroy'])->middleware('auth');



/* 
Admin Routes 
Handle the admin dashboard, user management, and blog post management.
*/

// route to dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// route to create a new blog post
Route::get('/admin/posts/create', function () {
    return view('admin.posts.create');
})->middleware('auth');


//profile page
Route::get('/admin/users/profile', function () {
    return view('admin.users.profile');
})->middleware('auth');

//show user registration form
Route::get('/admin/users/register', [UserController::class, 'create'])->middleware('auth');


//create new users
Route::post('/admin/users', [UserController::class, 'store'])->middleware('auth');

// show admin users with pagination
Route::get('/admin/users/show', function () {
    $users = User::latest()->paginate(10);
    return view('admin.users.show', compact('users'));
})->middleware('auth'); 


// Show user edit form
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit']);


// Logout user
Route::post('/admin/logout', [UserController::class, 'logout'])->middleware('auth');


// show login form
Route::get('/admin/login', function () {
    return view('admin.users.login');
})->name('login')->middleware('guest');

// login user
Route::post('/admin/authenticate', [UserController::class, 'authenticate']);


// Update the user edit form
Route::put('/admin/users/{id}', [UserController::class, 'update'])->middleware('auth');

// edit user password
Route::get('/admin/users/{id}/change-password', function ($id) {
    $user = User::findOrFail($id);
    return view('admin.users.change-password', compact('user'));
})->middleware('auth');

// update user password
Route::put('/admin/users/{id}/update-password', [UserController::class, 'updatePassword'])->middleware('auth');

// delete user
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->middleware('auth');


/* Manage Categories */
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
});