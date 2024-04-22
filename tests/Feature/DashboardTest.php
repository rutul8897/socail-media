<?php

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

// it('renders the dashboard component with correct data', function () {
//     // // Create some dummy data for users and posts
//     // $usersCount = 10;
//     // $postsCount = 5;
//     // User::factory($usersCount)->create();
//     // Post::factory($postsCount)->create();

//     // Mock the data that should be returned by the queries in the render method
//     $totalUsers = User::where('role', 'user')->count();
//     $totalTodaysUsers = User::where('role', 'user')->whereDate('created_at', today())->count();
//     $totalPosts = Post::count();
//     $monWiseUsers = User::select(DB::raw('DATE_FORMAT(created_at, "%Y %M") as month'), DB::raw('COUNT(*) as total_users'))
//         ->groupBy('month')->orderBy('month', 'asc')->pluck('total_users', 'month')->toArray();
//     $monWisePosts = Post::select(DB::raw('DATE_FORMAT(created_at, "%Y %M") as month'), DB::raw('COUNT(*) as total_posts'))
//         ->groupBy('month')->orderBy('month', 'asc')->pluck('total_posts', 'month')->toArray();

//     // Call the render method of the Livewire component
//     $response = Livewire::test('dashboard')
//         ->assertSee('Total Users: ' . $totalUsers)
//         ->assertSee('Total Posts: ' . $totalPosts)
//         ->assertSee('Today\'s Users: ' . $totalTodaysUsers)
//         ->assertSee('Users per Month')
//         ->assertSee('Posts per Month');

//     // Assert that the correct data is passed to the view
//     $response->assertViewData('totalUsers', $totalUsers);
//     $response->assertViewData('totalPosts', $totalPosts);
//     $response->assertViewData('totalTodaysUsers', $totalTodaysUsers);
//     $response->assertViewData('monWiseUsers', $monWiseUsers);
//     $response->assertViewData('monWisePosts', $monWisePosts);
// });
