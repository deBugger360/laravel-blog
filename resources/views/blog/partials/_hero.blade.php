<div class="hero">
    <div class="hero__slider swiper-container">
        <div class="swiper-wrapper">
            @foreach($latestPosts as $post)
                <article class="hero__slide swiper-slide">
                    <div class="hero__entry-image" style="background-image: url('{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('theme/images/thumbs/featured/featured-01_2000.jpg') }}');"></div>
                    <div class="hero__entry-text">
                        <div class="hero__entry-text-inner">
                            <div class="hero__entry-meta">
                                <span class="cat-links">
                                    <a href="/content?category={{ $post->category }}">{{ $post->category }}</a>
                                </span>
                            </div>
                            <h2 class="hero__entry-title">
                                <a href="/posts/{{ $post->id }}">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <p class="hero__entry-desc">
                                {{ html_entity_decode(strip_tags($post->excerpt)) }}
                            </p>
                            <a class="hero__more-link" href="/posts/{{ $post->id }}">Read More</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div> <!-- swiper-wrapper -->
        <div class="swiper-pagination"></div>
    </div> <!-- end hero slider -->

    <a href="#bricks" class="hero__scroll-down smoothscroll">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
        </svg>
        <span>Scroll</span>
    </a>
</div> <!-- end hero -->