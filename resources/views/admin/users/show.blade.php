@extends('admin.layout')
@section('title', 'All Users | Admin')

@section('header')
    @include('admin.partials._header')
@endsection


@section('content')

{{-- show alert message --}}
@include('admin.partials._flash')

        <div class="py-4 px-3 px-md-4">
            <div class="card mb-3 mb-md-4">

                <div class="card-body">
                    <!-- Breadcrumb -->
                    <nav class="d-none d-md-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">Users</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Users</li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->

                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">Users</div>
                    </div>
                    @if (empty($users) || $users->isEmpty())
                        <div class="alert alert-info" role="alert">
                            No users found. <a href="/admin/register" class="alert-link">Create a new user</a>.
                        </div>
                    @else
                    <!-- Users -->
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0">
                            <thead>
                            <tr>
                                <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Name</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Email</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Published</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Updated</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                            </tr>
                            </thead>
                            <!-- show users -->
                            @foreach ($users as $user)
                            <tbody>
                                <tr>
                                    <td class="py-3">{{ $user->id }}</td>
                                    <td class="align-middle py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="position-relative mr-2">
                                                {{-- <span class="indicator indicator-lg indicator-bordered-reverse indicator-top-left indicator-success rounded-circle"></span> --}}
                                                {{-- get the avatar image of user if exists --}}
                                                @if ($user->user_avatar)
                                                    <img class="avatar rounded-circle" src="{{ asset('storage/' . $user->user_avatar) }}" alt="{{ $user->name }}">
                                                @else
                                                    {{-- get the first letter of the user name --}}
                                                    <span class="avatar-placeholder mr-md-2">{{ strtoupper($user->name[0]) }}</span>
                                                @endif
                                            </div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td class="py-3">{{ $user->email }}</td>
                                    <td class="py-3">{{ $user->created_at->format('F j, Y h:i A') }}</td>
                                    <td class="py-3">{{ $user->updated_at->format('F j, Y h:i A') }}</td>
                                    <td class="py-3">
                                        <div class="position-relative">
                                            <a class="link-dark d-inline-block" href="/admin/users/{{ $user->id }}/edit" title="edit user">
                                                <i class="gd-pencil icon-text text-primary"></i>
                                            </a>
                                            &nbsp;&nbsp; 
                                            <form action="/admin/users/{{ $user->id }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger delete-btn" title="delete user">
                                                    <i class="gd-trash icon-text"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <!-- End users -->
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                        
                        {{-- use pagination here --}}

                        <div class="card-footer d-block d-md-flex align-items-center d-print-none">
                            <div class="d-flex mb-2 mb-md-0">
                                Showing {{ ($users->firstItem() ?? 0) }} to {{ ($users->lastItem() ?? 0) }} of {{ $users->total() }} Entries
                            </div>
                            <nav class="d-flex ml-md-auto d-print-none" aria-label="Pagination">
                                <ul class="pagination justify-content-end font-weight-semi-bold mb-0">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $users->previousPageUrl() ?? '#' }}" aria-label="Previous">
                                            <i class="gd-angle-left icon-text icon-text-xs d-inline-block"></i>
                                        </a>
                                    </li>
                                    {{-- Pagination Elements --}}
                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                        <li class="page-item d-none d-md-block {{ $users->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $users->nextPageUrl() ?? '#' }}" aria-label="Next">
                                            <i class="gd-angle-right icon-text icon-text-xs d-inline-block"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- End Users -->
                </div>
            </div>


        </div>


    @endsection

    @section('scripts')
    @include('admin.partials._footerscripts')
    <script>
    // confirm delete user with jquery
    $(document).ready(function() {
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            if (confirm('Are you sure you want to delete this user?')) {
                form.submit();
            }
        });
    });
</script>
@endsection
