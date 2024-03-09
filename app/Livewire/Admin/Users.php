<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Mail\WelcomeUser;
use Mail;
use Hash;

class Users extends Component
{
    public $user, $name, $userId, $email, $phone, $location, $about, $addUserSection = false, $editUserSection = false;

    /**
     * List of add/edit form rules
    */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns|unique:users,email,' .$this->userId,
            'phone' => 'required',
        ];
    }

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->location = '';
        $this->about = '';
    }

    public function render()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('livewire.admin.users', [
            'users' => $users
        ]);
    }

    /**
     * Open Add User form
     * @return void
     */
    public function addUser()
    {
        $this->resetFields();
        $this->addUserSection = true;
        $this->editUserSection = false;
    }

    /**
      * store the user inputted post data in the posts table
      * @return void
    */
    public function storeUser()
    {
        $this->validate();
        try {
            $email = $this->email;
            $password = 'Test@123';
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($password),
                'phone' => $this->phone,
                'location' => $this->location,
                'about' => $this->about,
            ]);
            Mail::to($this->email)->send(new WelcomeUser($email, $password));
            session()->flash('success', 'User Created Successfully!!');
            $this->resetFields();
            $this->addUserSection = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    /**
     * show existing user data in edit user form
     * @param mixed $id
     * @return void
     */
    public function editUser($id)
    {
        try {
            $user = User::findOrFail($id);
            if (!$user) {
                session()->flash('error', 'User not found');
            } else {
                $this->name = $user->name;
                $this->email = $user->email;
                $this->phone = $user->phone;
                $this->location = $user->location;
                $this->about = $user->about;
                $this->userId = $user->id;

                $this->editUserSection = true;
                $this->addUserSection = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }


    /**
     * update the user data
     * @return void
     */
    public function updateUser()
    {
        $this->validate();
        try {
            User::whereId($this->userId)->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'location' => $this->location,
                'about' => $this->about,
            ]);
            session()->flash('success', 'User Updated Successfully!!');
            $this->resetFields();
            $this->editUserSection = false;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }

    /**
     * delete specific user data from the userss table
     * @param mixed $id
     * @return void
     */
    public function deleteUser($id)
    {
        try {
            User::find($id)->delete();
            session()->flash('success', "User Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }

    public function cancel()
    {
        try {
            $this->editUserSection = false;
            $this->addUserSection = false;
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
