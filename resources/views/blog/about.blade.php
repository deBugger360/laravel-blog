@extends('blog.layout')

@section('title', 'About - Scribe & Share')

@section('content')
<!-- # site-content -->

        <div class="row entry-wrap">
            <div class="column lg-12">

                <article class="entry">

                    <header class="entry__header entry__header--narrow">

                        <h1 class="entry__title">
                            Learn More About Us.
                        </h1>

                    </header>

                    <div class="entry__media">
                        <figure class="featured-image">
                            <img src="{{ asset('theme/images/thumbs/about/about-1200.jpg') }}" 
                                srcset="{{ asset('theme/images/thumbs/about/about-2400.jpg') }} 2400w, 
                                        {{ asset('theme/images/thumbs/about/about-1200.jpg') }} 1200w, 
                                        {{ asset('theme/images/thumbs/about/about-600.jpg') }} 600w" sizes="(max-width: 2400px) 100vw, 2400px" alt="">
                        </figure>
                    </div>

                    <div class="content-primary">

                        <div class="entry__content">

                            <p class="lead">
                            Welcome to Scribe & Share, our little corner of the internet where we share our thoughts, stories, and poems with the world. We're writers and enthusiasts of all things creative. This blog is our outlet, our sanctuary, and a way of sharing our passion for words with others. Expect to find a mix of articles, poems, and musings on life, love, and everything in between. I hope you enjoy reading my work as much as I enjoy creating it.</p>

                            <p>As we navigate the ups and downs of life, we'll be sharing our reflections, insights, and experiences with you. We'll dive into topics that spark our curiosity, ignite our passion, and challenge our perspectives. From the mundane to the profound, we'll explore it all through words, rhythm, and rhyme. Our goal is to create a space where you can relax, reflect, and maybe even find a little inspiration. So grab a cup of your favorite brew, get cozy, and let's share this journey of words and wonder together.</p>

                    </div> <!-- end content-primary -->

                </article> <!-- end entry -->

            </div>
        </div> <!-- end entry-wrap -->


@endsection