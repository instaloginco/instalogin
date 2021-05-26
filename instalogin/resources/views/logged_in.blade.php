@extends('layouts/app')

@section('first_section')
    <div class="container is-max-desktop">
        <div class="card" style="border-top: none;">
            <div class="card-content">
                <div class="content">
                    <div class="notification is-light is-info" style="font-size: 0.85em">
                        * <strong>You are on a trial period</strong>. Share this link:
                        <a href="{{ Request::root() }}?ref={{ Auth::user()->username }}">{{ Request::root() }}?ref={{ Auth::user()->username }}</a>
                        - get <strong>3 months free</strong> if anyone buys a membership through it!
                    </div>
                    <h2>Your mailbox</h2>
                    <hr/>

                    @if (!count($emails))
                        <div class="notification">No emails so far.</div>
                    @endif

                    @foreach ($emails as $email)
                        <div class="box" style="padding: 0; margin: 0.5em 0 0.5em">
                            <div id="email_{{ $email->id }}" class="email_subject" style="opacity: 0.8; cursor: pointer; padding: 1em 0 0 1em">
                                <h5 class="has-text-link is-inline-block">{{ $email->subject }}</h5>
                                &nbsp;
                                <span class="is-pulled-right" style="font-size: 0.8em; margin: 2px 15px 0 0"><i>{{ $email->date->diffForHumans() }}</i></span>
                            </div>
                            <div class="email_text" style="display: none; padding: 0 2em 1.25em 2em">
                                <small class="is-block pb-3">
                                    <span class="has-text-grey">to:</span> {{ $email->recipient }}<br />
                                    <span class="has-text-grey">from:</span> {{ $email->sender }}<br />
                                    <span class="has-text-grey">date:</span> <span class="date">{{$email->date}} UTC</span>
                                </small>

                                <div class="mb-4">
{{--                                    <iframe sandbox="allow-popups" width="100%" height="200em"--}}
{{--                                            src="{{ route('profiles.show_email', $email) }}"></iframe>--}}
                                    {!! Purifier::clean($email->body) !!}
                                </div>

                                <a href="{{ route('profiles.show_email', $email) }}"
                                   class="button is-small">Show full email</a>

                                <a href="{{ route('profiles.delete_email', $email) }}"
                                   onclick="return confirm('Are you sure?')"
                                   class="button is-danger is-small">Delete this email</a>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-5">
                        {{ $emails->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let readEmails = localStorage.getItem('readEmails');
        if (readEmails === null) readEmails = {};
        else readEmails = JSON.parse(readEmails);

        document.querySelectorAll('.date').forEach(function (el) {
            let dt = new Date(el.innerHTML);
            el.innerHTML = dt.toLocaleString([],
                {year: '2-digit', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit'});
        });

        document.querySelectorAll('.email_subject').forEach(function (el) {
            let elId = el.id.replace('email_', '');

            if (!(elId in readEmails)) {
                el.getElementsByTagName('h5')[0].classList.add("has-text-danger");
            }

            el.addEventListener('click', function(e) {
                let sib = el.nextElementSibling;

                readEmails[elId] = 1;
                localStorage.setItem('readEmails', JSON.stringify(readEmails));
                el.getElementsByTagName('h5')[0].classList.remove("has-text-danger");

                document.querySelectorAll('.email_subject').forEach(function (sel) {
                    sel.style.opacity = sib.style.display === 'none' ? '0.3' : '0.8';
                    if (el !== sel) sel.nextElementSibling.style.display = "none";
                });

                el.style.opacity = sib.style.display === 'none' ? '1' : '0.8';
                el.nextElementSibling.style.display = sib.style.display === 'none' ? "block" : "none";
            }, false);
        });

    </script>
@endsection
