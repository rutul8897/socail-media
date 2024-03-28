<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use DB;

class Dashboard extends Component
{
    public function render()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalTodaysUsers = User::where('role', 'user')->where('created_at', now())->count();
        $totalPosts = Post::count();
        $monWiseUsers = User::select(DB::raw('DATE_FORMAT(created_at, "%Y %M") as month'), DB::raw('COUNT(*) as total_users'))->groupBy('month')
        ->orderBy('month', 'asc')->pluck('total_users', 'month')->toArray();
        $monWisePosts = Post::select(DB::raw('DATE_FORMAT(created_at, "%Y %M") as month'), DB::raw('COUNT(*) as total_posts'))->groupBy('month')
        ->orderBy('month', 'asc')->pluck('total_posts', 'month')->toArray();
        return view('livewire.dashboard', ['totalUsers' => $totalUsers, 'totalPosts' => $totalPosts, 'totalTodaysUsers' => $totalTodaysUsers, 'monWiseUsers' => $monWiseUsers, 'monWisePosts' => $monWisePosts]);
    }
}
