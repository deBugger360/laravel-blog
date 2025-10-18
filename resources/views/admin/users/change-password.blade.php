@extends('admin.layout')
@section('title', 'Change Password | Admin')

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
                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Change Password for: {{ $user->name }}</div>
            </div>

            <!-- Form -->
            <div>
                <form action="/admin/users/{{ $user->id }}/change-password" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" required>

                        @error('current_password')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>

                        @error('new_password')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm New Password" required>

                        @error('new_password_confirmation')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>

                    <button type="submit" class="btn btn-primary float-right">Update Password</button>
                </form>
            </div>
            <!-- End Form -->
        </div>
    </div>


</div>

@endsection

@section('scripts')
    @include('admin.partials._footerscripts')
@endsection