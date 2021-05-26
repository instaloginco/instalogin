@extends('layouts/app')

@section('first_section')
    <div class="container is-max-desktop">
        <div class="card has-text-centered" style="border-top: none;">
            <div class="card-content">
                <div class="content">
                    <h1 style="font-size: 60px">instalogin</h1>
                    <p class="subtitle" style="font-size: 2.2em; margin-bottom: 3rem;">
                        instantly become a verified user on any site
                    </p>

                    <iframe style="width: 100%; max-width: 550px; height: 300px"
                            src="https://www.youtube.com/embed/aPwEEDuL7f4"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>

                    <hr/>
                    <br/>
                    <div class="columns" style="font-size: 1.2em">
                        <div class="column is-half">
                            <div class="box" style="max-width: 330px; margin: 0 auto">
                                Protect your privacy by getting a <strong>new email for every website</strong>.
                            </div>
                        </div>
                        <div class="column is-half">
                            <div class="box" style="max-width: 400px; margin: 0 auto">
                                Just click <strong>Fill It</strong>, and we'll do the rest <br/>
                                <small>(even automatically click a verification link)</small>. <br/>
                                <strong>Yeah, it's that good.</strong>
                            </div>
                        </div>
                    </div>
                    <div class="columns" style="font-size: 1.2em">
                        <div class="column is-half">
                            <div class="box" style="max-width: 400px; margin: 0 auto">
                                Invite a friend. If they buy a membership,
                                you'll get <strong>3 months free immediately</strong>.
                            </div>
                        </div>
                        <div class="column is-half">
                            <div class="box" style="max-width: 400px; margin: 0 auto">
                                <small>First month free. No credit card required.</small> <br/>
                                <strong>$3 / month</strong> afterwards. <br/>
                            </div>
                        </div>
                    </div>
                    <div class="columns" style="font-size: 0.8em; line-height: 2.1em;">
                        <div class="column">
                            <br />
                            <div class="box">
                                <span style="font-size: 1.5em;">Wow, that's great, but how safe is it?</span>
                                &nbsp;
                                <button style="margin-top: -1px" id="show_safe_text"
                                        class="is-small button">More info</button>

                                <div id="safe_text" style="display: none; margin-top: 15px;">
                                    The extension doesn't require any special permissions. Also, all of the code
                                    for the extension is available to see (just right click and "Inspect").

                                    <br />
                                    When you click "Fill It", it sends a requests to the server to get
                                    a random email, a username, and a password. And then, it fills up the form if
                                    it finds one (if it doesn't, you can just copy the email yourself and use it).
                                    Only an email is stored in our database. <br />

                                    You don't need to use provided username or password. You can fill those yourself to
                                    anything you want. <br />

                                    Emails theoretically can be read by us.
                                    Don't use this service for anything super important.
                                    <br />

                                    We built this for ourselves first.
                                    We use this extensively: when we don't want to reveal our real email,
                                    when we just want to check some service fast
                                    (and get verified automatically without needing to go to the mailbox),
                                    or when we want to create some verified throwaway
                                    account (e.g. on reddit). <br />
                                    Have questions, feedback etc.? <br />
                                    <a href="https://discord.gg/9uaap4YxkZ" target="_blank">Join forum and ask</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>

                    <h2 id="amazing_text">It's as good as it sounds.</h2>
                    <i>- person who created this</i>
                    <script>
                        let texts = [
                            "It's as good as it sounds.",
                            "It's truly amazing.",
                            "I can't believe I survived without this before.",
                            "It's the best extension I've ever used.",
                            "It's like seeing the Iphone for the first time."
                        ];
                        let tid = 1;
                        setInterval(function () {
                            document.getElementById('amazing_text').innerHTML = texts[tid];
                            tid += 1;
                            if (tid === texts.length) tid = 0;
                        }, 2000);

                        document.getElementById('show_safe_text').addEventListener("click", () => {
                            let el = document.getElementById('safe_text');
                            el.style.display = el.style.display === 'block' ? "none" : "block";
                        });
                    </script>


                    <hr/>

                    <a class="button is-large is-light mr-5 mb-2"
                       target="_blank" href="https://chrome.google.com/webstore/detail/instalogin/mchgflohnhdlaonaejeomkjhninepofc">
                        <img style="margin-right: 5px" src="{{ mix('img/chrome_32x32.png') }}" />
                        Get Chrome Extension
                    </a>

                    <a class="button is-large is-light mr-5 mb-2"
                       target="_blank" href="https://addons.mozilla.org/firefox/addon/instalogin/">
                        <img style="margin-right: 5px" width="25px" src="{{ mix('img/firefox.png') }}" />
                        Get Firefox Extension
                    </a>

                    <br />

                    <a href="/register" class="button is-danger is-large mb-2">
                        <strong>Sign Up</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
