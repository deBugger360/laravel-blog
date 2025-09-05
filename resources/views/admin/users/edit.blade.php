@extends('admin.layout')
@section('title', 'Edit User | Admin')

@section('header')
    @include('admin.partials._header')
@endsection


@section('content')
    
<div class="py-4 px-3 px-md-4">
    <div class="card mb-3 mb-md-4">

        <div class="card-body">
            <!-- Breadcrumb -->
            <nav class="d-none d-md-block" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin/users/show">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Edit User: {{ $user->name }}</div>
            </div>


            <!-- Form -->
            <div>
                <form action="/admin/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name" placeholder="Full Name" required>

                        @error('name')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="Email" required>

                        @error('email')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="user_avatar">User Avatar <small class="text-danger">(Max size: 1MB)</small></label>
                        <input type="file" class="form-control" id="user_avatar" name="user_avatar" accept="image/*">

                        {{-- preview selected image --}}
                        @if ($user->user_avatar)
                            <img src="{{ asset('storage/' . $user->user_avatar) }}" alt="{{ $user->name }}" class="img-fluid" style="max-width: 100px;">
                        @endif
                        <div id="image-preview" class="mt-2"></div>

                         @error('user_avatar')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </form>
                {{-- link to update user password --}}
                <div class="form-group">
                    <a href="/admin/users/{{ $user->id }}/change-password" class="btn btn-link">Change Password</a>
                </div>
            </div>
            <!-- End Form -->
        </div>
    </div> 


</div>

@endsection

@section('scripts')
    @include('admin.partials._footerscripts')
    <script>
        // Preview selected image with jquery
        $(document).ready(function() {
            $('#user_avatar').change(function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').html(`<img src="${e.target.result}" alt="Image Preview" class="img-fluid" style="max-width: 200px;">`);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection