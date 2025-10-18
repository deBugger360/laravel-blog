@extends('blog.layout')

@section('title', 'Filtered Posts - Scribe & Share')

@section('content')


    <!-- pageheader -->
    <div class="s-pageheader">
        <div class="row">
            <div class="column large-12">
                <h1 class="page-title">
                    <span class="page-title__small-type">
                        @php
                            $filter = '';
                            $value = '';
                            if(request('search')) {
                                $filter = 'Search';
                                $value = request('search');
                            } elseif(request('category')) {
                                $filter = 'Category';
                                $value = request('category');
                            } elseif(request('author')) {
                                $filter = 'Author';
                                $value = request('author');
                            } elseif(request('tag')) {
                                $filter = 'Tag';
                                $value = request('tag');
                            }
                        @endphp
                        @if($filter)
                            {{ $filter }}: {{ $value }}
                            @if(count($posts) == 0)
                                - Post Not Found
                            @endif
                        @else
                            All Posts
                        @endif
                    </span>
                   @if(count($posts) > 0)
                         {{ $value }}
                   @endif
                </h1>
            </div>
        </div>
    </div> <!-- end s-pageheader-->

    <!--  masonry -->
    <div id="bricks" class="bricks">

        <div class="masonry">

            <div class="bricks-wrapper" data-animate-block>

                <div class="grid-sizer"></div>

                @unless (count($posts) == 0)
                    @foreach ($posts as $post)
                        <article class="brick entry" data-animate-el>
                            <div class="entry__thumb">
                                <a href="/posts/{{ $post->id }}" class="thumb-link">
                                    @if ($post->featured_image)
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid">
                                    @else
                                        <img src="{{ asset('theme/images/thumbs/blog/aaron-burden-y02jEX_B0O0-unsplash.webp') }}" alt="default image" class="img-fluid">
                                    @endif
                            </div> <!-- end entry__thumb -->

                            <div class="entry__text">
                                <div class="entry__header">
                                    <div class="entry__meta">
                                        <span class="cat-links">
                                            <a href="/content?category={{ $post->category }}">{{ $post->category }}</a>
                                        </span>
                                        <span class="byline">
                                            By:
                                            <a href="/content?author={{ $post->author }}">{{ $post->author }}</a>
                                        </span>
                                    </div>
                                    <h1 class="entry__title"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h1>
                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        {{-- remove character entities and tags --}}
                                        {{ html_entity_decode(strip_tags($post->excerpt)) }}
                                    </p>
                                </div>
                                <a class="entry__more-link" href="/posts/{{ $post->id }}">Read More</a>
                            </div> <!-- end entry__text -->
                        </article> <!-- end article -->
                    @endforeach
                @else
                    <p>No blog posts found.</p>
                @endunless

            </div> <!-- end bricks-wrapper -->

        </div> <!-- end masonry-->

        {{-- @include('blog.partials._homepagination') --}}

    </div> <!-- end bricks -->

@endsection