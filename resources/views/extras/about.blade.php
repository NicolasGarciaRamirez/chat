@extends('template.template')

@section('content')
    <div class="about">
        <div class="d-flex flex-column justify-content-start font-weight-bold">
            <div class="d-flex flex-column c-head p-5">
                <div>
                    <h1 class="font-weight-bold text-white">
                        About us... you... and the passion
                        that we call music!
                    </h1>
                </div>
                <div class="column content d-lg-none d-md-none my-5">
                    <span>
                        Noisesharks® is a social platform and content hub where <span class="c-fifth">musicians</span> & <span class="c-fifth">music content creators</span> share their content and get financially supported by each other or by their fans.
                    </span>
                </div>
                <div class=" content-secondary content my-4">
                    <span>
                        Noisesharks® is a social platform and content hub <br>
                        where <span class="c-fifth">musicians</span> & <span class="c-fifth">music content creators</span> share their content <br>
                        and get financially supported by each other or by their fans.
                    </span>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    {{--                <img src="/images/help-head.svg" class="position-absolute" style="z-index: -1;">--}}
                    <img src="/images/icons/sharks.svg" class="sharks">
                </div>
            </div>
            <div class="d-flex flex-column justify-content-start  pl-5 py-5 pr-3">
                <img src="/images/about/arte-noisesharks.svg" class="art position-absolute" width="1rem">
                <h1 class="font-weight-bold text-white font-5xl title position-relative"><span>Who Is Noisesharks® For?</span></h1>
                <div class="position-relative"><span class="c-fifth">-</span> Bands & Artists that want to get supported directly by their fans and get discovered by more.</div>
                <div class="my-2 position-relative"><span class="c-fifth">-</span>  Music industry YouTubers.</div>
                <div class="position-relative"><span class="c-fifth">-</span> Online music teachers that are looking to create a channeland get funded by their students.</div>
                <div class="my-2 position-relative"><span class="c-fifth">-</span> Creators of production tips and tricks.</div>
                <div class="position-relative"><span class="c-fifth">-</span> Home musicians that jam to an audience.</div>
                <div class="my-2 position-relative"><span class="c-fifth">-</span> Music industry podcast channels.</div>
            </div>
            <div class="d-flex flex-column justify-content-start  pl-5 py-5 pr-3">
                <img src="/images/about/arte-dope.svg" class="art position-absolute" width="1rem">
                <h1 class="font-weight-bold text-white font-5xl title position-relative"><span>Dope Features!</span></h1>
                <div class="position-relative"><span class="c-fifth">-</span> You DON’T need to rely on followers on Noisesharks, our “Stream Filters” allows your posts and content to be seen by users with that specific interest!</div>
                <div class="my-2 position-relative"><span class="c-fifth">-</span>  We use an Up-vote/Down-vote system in posts which will force the best content to be viewed by more users.</div>
                <div><span class="c-fifth">-</span> You can switch between paymant plans on the fly as a Contributor.</div>
            </div>
            <div class="d-flex flex-column justify-content-start  pl-5 py-5 pr-3">
                <img src="/images/about/arte-creative.svg" class="art position-absolute" width="1rem">
                <h1 class="font-weight-bold text-white font-5xl title position-relative"><span>Creative Ways To Use Noisesharks</span></h1>
                <div class="position-relative"><span class="c-fifth">-</span> Stream a live jam to your fans, interact with them and take song requests! Posting pre-recorded jam videos also works!</div>
                <div class="my-2 position-relative"><span class="c-fifth">-</span> Post or live stream music classes or production tips videos. You can then teach fans and new-comers and get them to support you financially.</div>
                <div class="position-relative"><span class="c-fifth">-</span> Online music teachers that are looking to create a channeland get funded by their students.</div>
                <div class="my-2"><span class="c-fifth">-</span> Lock about 20% of your content from the public making it exclusive to your supporters. Share about 80% of your content to the public to create awareness.</div>
                <div><span class="c-fifth">-</span>   Create a $1 tier to encourage people to support you and provide some minimal exclusive value to those low-tier supporters!</div>
                <div class="my-2"><span class="c-fifth">-</span> Advertise your merch on your channel!</div>
                <div class="my-2"><span class="c-fifth">-</span> Create your own podcast, lock some episodes, or segments of your episodes making them available only for your supporters!</div>

            </div>
            <div class="d-flex flex-column justify-content-start  pl-5 py-5 pr-3">
                <img src="/images/about/arte-goal.svg" class="art position-absolute" width="1rem">
                <h1 class="font-weight-bold text-white font-5xl title position-relative"><span>Our Goal!</span></h1>
                <div class=" position-relative"><span class="c-fifth">-</span>Providing financial freedom for musicians & music content creators through
                    their passion.</div>

            </div>
            <div class="d-flex flex-column justify-content-start  pl-5 py-5 pr-3">
                <img src="/images/about/arte-mission.svg" class="art position-absolute" width="1rem">
                <h1 class="font-weight-bold text-white font-5xl title position-relative"><span>Our Mission!</span></h1>
                <div class="position-relative"><span class="c-fifth">-</span> Crafting a platform that celebrates musicians, music content creators,  and the wholemusic industry in a single place!</div>
            </div>
        </div>
    </div>
@endsection
