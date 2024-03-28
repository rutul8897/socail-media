<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Auth;
use File;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $location;
    public $about;
    public $photo;

    protected $listeners = ['refresh-me' => '$refresh'];


    public function mount()
    {
        $this->fill(Auth::user());
    }

    public function updateProfile()
    {
        $photo = $this->photo;
        $path = null ;
        if (!str_contains($photo, 'user-images')) {
            $path = $photo->store('user-images', 'public');

            $temporaryFilePath = $photo->getRealPath();
                // Delete the temporary file
            if (File::exists($temporaryFilePath)) {
                File::delete($temporaryFilePath);
            }
        }

        $updateData = [
            'name' => $this->name,
            'about' => $this->about,
            'location' => $this->location,
        ];

        if ($path) {
            $updateData['photo'] = $path;
        }

        User::where('id', Auth::id())->update($updateData);

        if (!str_contains($photo, 'user-images')) {
            $this->photo =  '/storage/'. $path;
        }
        $this->dispatch('refresh-me')->self();
    }

    public function render()
    {
        $authUser = Auth::user();
        $followingUsers = $authUser->followings()->get();
        $followerUsers = $authUser->followers()->get();
        $totalFollowerUser = $followerUsers->count();
        $totalFollowingUser = $followingUsers->count();
        $totalUserPost = $authUser->posts->count();
        // $followingUsers = $followingUsers->merge($followerUsers);
        return view('livewire.portal.profile', [
            'totalFollowingUser' => $totalFollowingUser,
            'totalFollowerUser' => $totalFollowerUser,
            'totalUserPost' => $totalUserPost,
            'followingUsers' => $followingUsers,
            'user' => $authUser
        ])->layout('components.layouts.portal-app');
    }
}
