@extends('blog.layout')

@section('title', 'Contact - Scribe & Share')

@section('content')
<!-- # site-content -->

<div class="row entry-wrap">
    <div class="column lg-12">

        <article class="entry">

            <header class="entry__header entry__header--narrow">

                <h1 class="entry__title">
                    Say Hello.
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
                    Get in touch with us! We'd love to hear from you, whether it's to share your thoughts on our work, suggest a topic for a future article, or just to say hello. You can reach us via the email below or through the contact form below. We look forward to hearing from you.</p> 

                    <p>
                   Interested in collaborating on a project or article? Let's discuss how we can work together to create something amazing. Whether you're a fellow writer, a business, or just someone with a great idea, we're open to exploring new opportunities. Reach out to us via the contact form below or the email provided, and let's start a conversation!
                    </p>

                    <div class="row block-large-1-2 block-tab-whole entry__blocks">
                        {{-- <div class="column">
                            <h4>Where to Find Us</h4>
                            <p>
                            1600 Amphitheatre Parkway<br>
                            Mountain View, CA<br>
                            94043 US
                            </p>
                        </div> --}}

                        <div class="column">
                            <h4>Contact Info</h4>
                            <p>
                            Email: scribeandshare@gmail.com <br>
                            Phone: (+234) 807 173 0096
                            </p> 
                        </div>
                    </div>

                    <h4>Feel Free to Say Hi.</h4>

                    <form name="cForm" id="cForm" class="entry__form" method="post" action="" autocomplete="off">
                        <fieldset class="row">

                            <div class="column lg-6 tab-12 form-field">
                                <input name="cName" id="cName" class="u-fullwidth" placeholder="Your Name" value="" type="text" required>
                            </div>

                            <div class="column lg-6 tab-12 form-field">
                                <input name="cEmail" id="cEmail" class="u-fullwidth" placeholder="Your Email" value="" type="text" required>
                            </div>

                            <div class="column lg-12 form-field">
                                <input name="cWebsite" id="cWebsite" class="u-fullwidth" placeholder="Website" value="" type="text" required>
                            </div>

                            <div class="column lg-12 message form-field">
                                <textarea name="cMessage" id="cMessage" class="u-fullwidth" placeholder="Your Message" required></textarea>
                            </div>
 
                            <div class="column lg-12">
                                <input name="submit" id="submit" id="contact-form-btn" class="btn btn--primary btn-wide btn--large u-fullwidth" value="Send Message" type="submit">
                            </div>

                        </fieldset>
                    </form> <!-- end form -->

            </div> <!-- end content-primary -->

        </article> <!-- end entry -->

    </div>
</div> <!-- end entry-wrap --

@endsection