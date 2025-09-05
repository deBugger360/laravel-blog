@extends('admin.layout')

@section('title', 'Profile | Admin')

@section('header')
    @include('admin.partials._header')
@endsection

@section('content')
    <div class="py-4 px-3 px-md-4">
            <div class="card mb-3 mb-md-4">

                <div class="card-body">
                    <h2>My Profile</h2>
                    <p>Name: {{ auth()->user()->name }}</p>
                    <p>Email: {{ auth()->user()->email }}</p>
                    <p>Role: {{ auth()->user()->role }}</p>
                    <a href="/admin/posts/manage" class="btn btn-primary">Manage My Posts</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.partials._footerscripts')
@endsection