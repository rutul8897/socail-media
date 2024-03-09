<div>
    {{-- <div class="container-fluid py-4"> --}}
        {{-- <div class="card"> --}}
           {{--  <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div> --}}
            <div class="card-body pt-4 p-3">
                <form method="POST" role="form text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">Full Name</label>
                                <div class="@error('name')border border-danger rounded-3 @enderror">
                                    <input wire:model="name" class="form-control" type="text" placeholder="Name"
                                        id="user-name">
                                </div>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">Email</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input wire:model="email" class="form-control" type="email"
                                        placeholder="@example.com" id="user-email">
                                </div>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="form-control-label">Phone</label>
                                <div class="@error('phone')border border-danger rounded-3 @enderror">
                                    <input wire:model="phone" class="form-control" type="tel"
                                        placeholder="40770888444" id="phone">
                                </div>
                                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location" class="form-control-label">Location</label>
                                <div class="@error('location') border border-danger rounded-3 @enderror">
                                    <input wire:model="location" class="form-control" type="text"
                                        placeholder="Location" id="name">
                                </div>
                                @error('location') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <div class="@error('about')border border-danger rounded-3 @enderror">
                            <textarea wire:model="about" class="form-control" id="about" rows="3"
                                placeholder="Say something about yourself"></textarea>
                        </div>
                        @error('about') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button  wire:click.prevent="cancel()" wire:loading.attr="disabled" type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Cancel</button>
                        <button  wire:click.prevent="storeUser()" wire:loading.attr="disabled" type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 mx-2">Save Changes</button>
                    </div>
                    {{-- <span wire:loading>Saving...</span> --}}

                </form>
                <div wire:loading wire:target="storeUser">
                    <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-gray-500"></div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    {{-- </div> --}}
</div>