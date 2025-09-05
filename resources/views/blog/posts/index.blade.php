@extends('blog.layout')

@section('title', 'Scribe & Share')

@section('header')
    @include('blog.partials._header')
@endsection

@section('hero')
    @include('blog.partials._hero', ['latestPosts' => $latestPosts]) 
@endsection
    
@section('content')

@if (empty($posts) || $posts->isEmpty())
    <h2 class="text-center ">No blog posts found.</h2>
@else
<div id="bricks" class="bricks">
      {{-- flash message --}}
    @include('admin.partials._flash')


    <div class="masonry">

        <div class="bricks-wrapper" data-animate-block>

            <div class="grid-sizer"></div> 
                @foreach ($posts as $post)
                    <article class="brick entry" data-animate-el>

                        <div class="entry__thumb">
                            <a href="/posts/{{ $post->id }}" class="thumb-link">
                                {{-- <img src="theme/images/thumbs/masonry/statue-600.jpg" 
                                    srcset="theme/images/thumbs/masonry/statue-600.jpg 1x, theme/images/thumbs/masonry/statue-1200.jpg 2x" alt=""> --}}
                                @if ($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid">
                                @else
                                <img
                                srcset="{{ asset('theme/images/thumbs/blog/aaron-burden-y02jEX_B0O0-unsplash-400w.webp') }} 400w, {{ asset('theme/images/thumbs/blog/aaron-burden-y02jEX_B0O0-unsplash-600w.webp') }} 600w, {{ asset('theme/images/thumbs/blog/aaron-burden-y02jEX_B0O0-unsplash-800w.webp') }} 800w, {{ asset('theme/images/thumbs/blog/aaron-burden-y02jEX_B0O0-unsplash-1000w.webp') }} 1000w, {{ asset('theme/images/thumbs/blog/aaron-burden-y02jEX_B0O0-unsplash-1200w.webp') }} 1200w, {{ asset('theme/images/thumbs/blog/aaron-burden-y02jEX_B0O0-unsplash-1600w.webp') }} 1600w, {{ asset('theme/images/thumbs/blog/aaron-burden-y02jEX_B0O0-unsplash-2000w.webp') }} 2000w"
                                sizes="(max-width: 400px) 400px, (max-width: 600px) 600px, (max-width: 800px) 800px, (max-width: 1000px) 1000px, (max-width: 1200px) 1200px, (max-width: 1600px) 1600px, (min-width: 1601px) 2000px"
                                src="{{ asset('theme/images/thumbs/blog/aaron-burden-y02jEX_B0O0-unsplash.jpg') }}"
                                alt="featured_image"
                                width="4592"
                                height="3448"
                                loading="lazy"
                                />
                                @endif
                            </a>
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
                                {{ html_entity_decode(strip_tags($post->excerpt)) }} 
                                </p>
                            </div>
                            <a class="entry__more-link" href="/posts/{{ $post->id }}">Read More</a>
                        </div> <!-- end entry__text -->
                    
                    </article> <!-- end article -->
                @endforeach
            @endif

        </div> <!-- end bricks-wrapper -->

    </div> <!-- end masonry-->


    <!-- pagination -->
   @include('blog.partials._homepagination')  
 
</div> <!-- end bricks -->

@endsection