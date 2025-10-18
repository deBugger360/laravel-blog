@extends('blog.layout')

@section('title', $post->title . ' - Scribe & Share')

@section('content')


<div class="row entry-wrap">
    <div class="column lg-12">

        <article class="entry format-standard">

            <header class="entry__header">

                <h1 class="entry__title">
                    {{ $post->title }}
                </h1>

                <div class="entry__meta">
                    <div class="entry__meta-author">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.8475 19.25H17.1525C18.2944 19.25 19.174 18.2681 18.6408 17.2584C17.8563 15.7731 16.068 14 12 14C7.93201 14 6.14367 15.7731 5.35924 17.2584C4.82597 18.2681 5.70558 19.25 6.8475 19.25Z"></path>
                        </svg>
                        <a href="/content?author={{ $post->author }}">{{ $post->author }}</a> 
                    </div>
                    <div class="entry__meta-date">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="7.25" stroke="currentColor" stroke-width="1.5"></circle>
                            <path stroke="currentColor" stroke-width="1.5" d="M12 8V12L14 14"></path>
                        </svg>
                       <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('F j, Y') }}</time>
                    </div>
                    <div class="entry__meta-cat">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 17.25V9.75C19.25 8.64543 18.3546 7.75 17.25 7.75H4.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H17.25C18.3546 19.25 19.25 18.3546 19.25 17.25Z"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5 7.5L12.5685 5.7923C12.2181 5.14977 11.5446 4.75 10.8127 4.75H6.75C5.64543 4.75 4.75 5.64543 4.75 6.75V11"></path>
                        </svg>
                            
                        <span class="cat-links">
                            <a href="/content?category={{ $post->category }}">{{ $post->category }}</a>
                            {{-- <a href="#0">Design</a> --}}
                        </span>
                    </div>
                </div>
            </header>

                <div class="entry__media">
                    <figure class="featured-image">
                        @if ($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid">
                        @else
                        <img src="{{ asset('theme/images/thumbs/about/about-1200.jpg') }}" 
                            srcset="{{ asset('theme/images/thumbs/about/about-2400.jpg') }} 2400w, 
                                    {{ asset('theme/images/thumbs/about/about-1200.jpg') }} 1200w, 
                                    {{ asset('theme/images/thumbs/about/about-600.jpg') }} 600w" sizes="(max-width: 2400px) 100vw, 2400px" alt="">
                        @endif
                    </figure>
                </div>

            <div class="content-primary">

                <div class="entry__content">
                    <div>
                        {!! $post->content !!}
                    </div>

                    {{-- <figure class="alignwide">
                        <img src="{{ asset('theme/images/sample-1200.jpg') }}" 
                            srcset="{{ asset('theme/images/sample-2400.jpg') }} 2400w, 
                                    {{ asset('theme/images/sample-1200.jpg') }} 1200w, 
                                    {{ asset('theme/images/sample-600.jpg') }} 600w" sizes="(max-width: 2400px) 100vw, 2400px" alt="">
                    </figure> --}}

                    <p class="entry__tags">
                        <strong>Tags:</strong>
    
                        <span class="entry__tag-list">
                            @foreach(explode(',', $post->tags) as $tag)
                                <a href="/content?tag={{ $tag }}">{{ $tag }}</a>
                            @endforeach
                        </span>
        
                    </p>

                    <div class="entry__author-box">
                        <figure class="entry__author-avatar">
                            <img alt="{{ $post->author }}" src="{{ $post->user->user_avatar ? asset('storage/' . $post->user->user_avatar) : asset('theme/images/avatars/user-06.jpg') }}" class="avatar">
                        </figure>
                        <div class="entry__author-info">
                            <h5 class="entry__author-name">
                                <a href="/content?author={{ $post->author }}" rel="author">
                                    {{ $post->author }}
                                </a>
                            </h5>
                            {{-- include genric copy about authors --}}
                            <p>
                           Scribe & Share is a community of writers and creatives who share their thoughts, stories, and poems with the world. Our authors are passionate about exploring life's adventures and sharing their insights with you. Whether you're looking for inspiration, entertainment, or just a good read, our authors have something for everyone. Join us on this journey of words and wonder, and discover the magic of storytelling.
                            </p>
                        </div>
                    </div>

                </div> <!-- end entry-content -->

                
                {{-- view title of previous and next post in pagination below --}}

               <div class="post-nav">
                <div class="post-nav__prev">
                    @if($prevPost)
                        <a href="{{ url('/posts/' . $prevPost->id) }}" rel="prev">
                            <span>Prev</span>
                            {{ $prevPost->title }}
                        </a>
                    @endif
                </div>
                <div class="post-nav__next">
                    @if($nextPost)
                        <a href="{{ url('/posts/' . $nextPost->id) }}" rel="next">
                            <span>Next</span>
                            {{ $nextPost->title }}
                        </a>
                    @endif
                </div>
            </div>

            </div> <!-- end content-primary -->

            </article> <!-- end entry -->

            {{-- @include('blog.partials._comments') --}}

        </div>
    </div> <!-- end entry-wrap -->

@endsection