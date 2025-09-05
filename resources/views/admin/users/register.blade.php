@extends('admin.layout')
@section('title', 'Create New User | Admin')

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
                        <a href="#">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">New User</li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Create New User</div>
            </div>


            <!-- Form -->
            <div>
                <form action="/admin/users" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="Full Name" required>

                        @error('name')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Email" required>

                        @error('email')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="user_avatar">User Avatar <small class="text-danger">(Max size: 1MB)</small></label>
                        <input type="file" class="form-control" id="user_avatar" name="user_avatar" accept="image/*">

                        {{-- preview selected image --}}
                        <div id="image-preview" class="mt-2"></div>

                         @error('user_avatar')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                   <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}" required>

                         @error('password')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"  value="{{ old('password_confirmation') }}" required>

                         @error('password_confirmation')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                   

                    <button type="submit" class="btn btn-primary float-right">Register</button>
                </form>
            </div>
            <!-- End Form -->
        </div>
    </div> 


</div>

@endsection

@section('scripts')
    @include('admin.partials._footerscripts')
    <script>
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
