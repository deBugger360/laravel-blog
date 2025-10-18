<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $postCount = BlogPost::count();
    $userCount = User::count();
    $categoryCount = Category::distinct('name')->count('name');
    $recentPosts = BlogPost::latest()->take(5)->get();
    $recentUsers = User::latest()->take(5)->get();

    // Example for chart data: posts per month
    $postsPerMonth = BlogPost::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')->orderBy('month')->get();

    return view('admin.dashboard', compact(
        'postCount', 'userCount', 'categoryCount', 'recentPosts', 'recentUsers', 'postsPerMonth'
    ));
} 
}
