@extends('admin.layout')
@section('title', 'All Posts | Admin')

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
                                <a href="javascript:void(0)">Posts</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Posts</li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->

                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">Posts</div>
                    </div>


                    <!-- Posts -->
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0">
                            <thead>
                            <tr>
                                <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Title</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Featured Image</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Author</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Category</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Published</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Updated</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                            </tr>
                            </thead>
                            <!-- show posts -->
                            @unless (count($userPosts) == 0)

                            @foreach ($userPosts as $upost)
                            <tbody>
                            <tr>
                                <td class="py-3">{{ $upost->id }}</td>
                                <td class="py-3">{{ $upost->title }}</td>
                                <td class="py-3">
                                    @if ($upost->featured_image)
                                        <img src="{{ asset('storage/' . $upost->featured_image) }}" alt="{{ $upost->title }}" class="img-fluid" style="max-width: 50px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td class="align-middle py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="position-relative mr-2">
                                            <span class="indicator indicator-lg indicator-bordered-reverse indicator-top-left indicator-success rounded-circle"></span>
                                            {{-- get the avatar image of author if exists  --}}
                                            {{-- @if ($post->author->avatar)
                                                <img class="avatar rounded-circle" src="{{ asset('storage/' . $post->author->avatar) }}" alt="{{ $post->author->name }}">
                                            @else  
                                                {{-- get the first letter of the post author --}}
                                                {{-- <span class="avatar-placeholder mr-md-2">{{ strtoupper($post->author->name[0]) }}</span>
                                            @endif  --}}
                                            <!--img class="avatar rounded-circle" src="#" alt="John Doe"-->
                                            {{-- get the fist letter of the post author --}}
                                            <span class="avatar-placeholder mr-md-2">{{ strtoupper($upost->author[0]) }}</span>
                                        </div>
                                        {{ $upost->author }}
                                    </div>
                                </td>
                                <td class="py-3">{{ $upost->category }}</td>
                                <td class="py-3">{{ $upost->created_at->format('F j, Y h:i A') }}</td>
                                <td class="py-3">{{ $upost->updated_at->format('F j, Y h:i A') }}</td>
                                <td class="py-3">
                                    <div class="position-relative">
                                        <a class="link-dark d-inline-block" href="/admin/posts/{{ $upost->id }}/edit" title="edit post">
                                            <i class="gd-pencil icon-text text-primary"></i>
                                        </a>
                                        &nbsp;&nbsp; 
                                        <form action="/admin/posts/{{ $upost->id }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger delete-btn" title="delete post">
                                                <i class="gd-trash icon-text"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- End Post -->
                            </tbody>
                            @endforeach

                            @else
                                <p>No blog posts found.</p>
                            @endunless
                        </table>
                        
                        {{-- use pagination here --}}
                        {{ $userPosts->links() }}

                        {{-- <div class="card-footer d-block d-md-flex align-items-center d-print-none">
                            <div class="d-flex mb-2 mb-md-0">
                                Showing {{ ($posts->firstItem() ?? 0) }} to {{ ($posts->lastItem() ?? 0) }} of {{ $posts->total() }} Entries
                            </div>
                            <nav class="d-flex ml-md-auto d-print-none" aria-label="Pagination">
                                <ul class="pagination justify-content-end font-weight-semi-bold mb-0"> --}}
                                    {{-- Previous Page Link --}}
                                    {{-- <li class="page-item {{ $posts->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $posts->previousPageUrl() ?? '#' }}" aria-label="Previous">
                                            <i class="gd-angle-left icon-text icon-text-xs d-inline-block"></i>
                                        </a>
                                    </li> --}}
                                    {{-- Pagination Elements --}}
                                    {{-- @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                        <li class="page-item d-none d-md-block {{ $posts->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach --}}
                                    {{-- Next Page Link --}}
                                    {{-- <li class="page-item {{ !$posts->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $posts->nextPageUrl() ?? '#' }}" aria-label="Next">
                                            <i class="gd-angle-right icon-text icon-text-xs d-inline-block"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div> --}}
                    </div>
                    <!-- End Posts -->
                </div>
            </div>


        </div>


@endsection

@section('scripts')
    @include('admin.partials._footerscripts')
    <script>
    // confirm delete post with jquery
    $(document).ready(function() {
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            if (confirm('Are you sure you want to delete this post?')) {
                form.submit();
            }
        });
    });
</script>
@endsection
