@extends('admin.layout')
@section('title', 'Edit Post: '. $post->title . '| Admin')

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
                        <a href="/admin/posts/show">Posts</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Edit: {{ $post->title }}</div>
            </div>


            <!-- Form -->
            <div>
                <form action="/admin/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" value="{{ $post->title }}" id="title" name="title" placeholder="Post Title" required>

                        @error('title')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control" value="{{ $post->tags }}" id="tags" name="tags" placeholder="Post Tags (comma separated)" required>

                         @error('tags')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">---Select Category---</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ $post->category == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                         @error('category')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="featured_image">Featured Image <small class="text-danger">(Max size: 1MB)</small></label>
                        <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*" />

                        {{-- preview selected image --}}
                        <div id="image-preview" class="mt-2">
                            {{-- display featured image if exits in db --}}
                            @if ($post->featured_image)
                                <img src="{{asset('storage/' .$post->featured_image) }}" alt="Image Preview" class="img-fluid" style="max-width: 200px;">
                            @endif
                        </div>

                         @error('featured_image')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="8" required>{{ $post->content }}</textarea>

                         @error('content')
                            <p class="text-danger mt-1 small">{{ $message }}</p>
                        @enderror

                    </div>
                   

                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </form>
            </div>
            <!-- End Form -->
        </div>
    </div> 


</div>

@endsection

@section('scripts')
    @include('admin.partials._footerscripts')
    
    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof CKEDITOR !== 'undefined') {
                    CKEDITOR.replace('content');
                }
            });
            // Preview selected image with jquery
            $(document).ready(function() {
                $('#featured_image').change(function(event) {
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