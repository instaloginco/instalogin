@extends('layouts/app')

@section('first_section')
    <div class="container is-max-desktop">
        <div class="card" style="border-top: none;">
            <div class="card-content">
                <div class="content">
                    <h2>List of emails that belong to you</h2>
                    <hr />

                    @if (!count($emails))
                        <a style="display: block; margin-bottom: 1em"
                           class="is-size-5"
                           target="_blank" href="https://chrome.google.com/webstore/detail/instalogin/mchgflohnhdlaonaejeomkjhninepofc">
                            <img style="margin: 0 5px -8px 0" src="{{ mix('img/chrome_32x32.png') }}" />
                            Get Chrome Extension
                        </a>

                        <a class="is-size-5"
                           target="_blank" href="https://addons.mozilla.org/firefox/addon/instalogin/">
                            <img style="margin: 0 5px -9px 0" width="34px" src="{{ mix('img/firefox.png') }}" />
                            Get Firefox Extension
                        </a>

                        <br />
                        <div class="notification mt-5">Just click <strong>"Fill It"</strong> in the extension to generate an email address!</div>
                    @endif

                    @foreach ($emails as $email)
                        <a href="mailto:{{ $email->email }}">{{ $email->email }}</a>

                        &nbsp; <a href="{{ route('profiles.delete_email_address', $email) }}"
                                  onclick="return confirm('Are you sure? All the emails that belong to this address will be removed as well.')"
                                  class="is-size-7 has-text-danger">delete</a>
                        <br />
                    @endforeach

                    <div class="mt-5">
                        {{ $emails->links() }}
                    </div>

                    <div class="has-text-info is-size-6 mt-5">* you get 5 unique emails an hour</div>
                </div>
            </div>
        </div>
    </div>
@endsection
