<div class="main-content">
    @if(session()->has('success'))
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
             {{ session()->get('success') }}
        </span>
    </div>
    @endif
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                        @if($addUserSection)
                            <h5 class="mb-0">Create User</h5>
                        @elseif($editUserSection)
                            <h5 class="mb-0">Update User</h5>
                        @else
                            <h5 class="mb-0">All Users</h5>
                        @endif
                        </div>
                        @if(!$addUserSection && !$editUserSection)
                        <a wire:click="addUser()" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if($addUserSection)
                        @include('livewire.admin.users.create')
                    @elseif($editUserSection)
                        @include('livewire.admin.users.edit')
                    @else
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <div>
                                            <img src="{{ $user->photo }}" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a wire:click="editUser({{$user->id}})" class="mx-3" data-bs-toggle="tooltip"
                                            data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span wire:click="deleteUser({{$user->id}})" wire:confirm="Are you sure you want to delete this user?">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 flex justify-end">
                        {{$users->links()}}
                    </div>
                    @endif

                </div>
            </div>
        </div>
</div>
