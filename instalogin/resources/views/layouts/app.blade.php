<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>instalogin</title>
    <meta name="description" content="instantly become a verified user on any site. protect your privacy.">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.png') }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
</head>
<body>
@yield('js_code')

@section('nav')
<nav class="navbar container is-max-desktop" role="navigation" aria-label="main navigation">
    <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </a>

    <div id="navMenu" class="navbar-menu">
        <div class="navbar-brand">
            <a href="/" style="margin-bottom: -22px">
                <img src="{{ asset('img/logo.png') }}" style="width: 58px;" alt="" />
            </a> &nbsp;
            <a class="navbar-item" href="https://discord.gg/9uaap4YxkZ" target="_blank">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAI00lEQVR4XuWbeWzUxxXHP7M+uGwHDHY4bcDEQICWGKeJBLlEjippU2guBShgO61aVQUF7FT9J3L+qhQfEf6nEsLLEUwUEoU2TaOm0CoHpGrNkTYQg3OAuQ9zxEcwPnaqt+N11utd/47ddR38JITknXnvzXeO931v5qeIs5Rt05meDu7RijkKZvogV8E4IA1I7TbfDDRpaPRAvYZjSnPEl8RHJSvVxXi6qGKtXGutXvGywKdYBjwEzI3SxmFgt0ez4/lCDiildJT6enWPGQBV23VaRzu/8EGhgtmxdDKgS0OdB7xJyWxcs0I1xcJG1ABUbtLpPg9rgTXA6Fg4ZUPHNaDK42PDuufUFRvtIzZxDUBpqfakZrNaa14GxkbjRBR9GzW80HqSraWlyudGjysAKjfpGVqxRSsWujEa6z5Ks68rgVUvrFZfOtXtGICyav20UmwKOsGd2oxX+yaleG59gXrDiQHbAMiSHzWFMqVY58TAQLfVmsrWU5TY3RK2ACjdqZNTWtgCPDvQA3JjT8GO5hQKSp9W7Vb9LQGQwY9qYZeCR62UDabfNbzbmsJSKxD6BUCWfUoW278rMx86Af6VcJKf9bcd+gWgrFpXDPY9b7Xq5EwoKVLrI7WLCED3af+6lYHvyO9PFReqN8P5GhYAifM+DwcHYahzi3eTz0NeOJ7QBwA/w5vCh4OF5LgdcZ/zQLOv+RT3hp4HfQAo8+oCBd5YGR5MepSmYH2RknDeI70A6E5s6v+P3D7eeDV2DCP3d8vV1YChXgCUe/VLwIux9CJ1FIwfBwkeOHrcnubcqaAUnG+Er6VUEkPRmpdKilRpHwAkn29vpyEWKW36aLhjNszIgpSRZiD1J6D2U3sjWTAHZk03wF1vg88b4FAdNPbMmz09EVpd7dJk/7ZI+aHtWQEVXl2soSwa1beOhXvyIXsi3GiHT47CJ3XQ8g2k3wITMiFtFAwfBsOTzf8ibe3QdsP8a26Fs5fgyjUD3rxcyLvdtD11Dj7YDxcao/ES0BQXF6mKHgCkjFW+mSNuKzlJibAwzzgqS/e/x2DfIcieALnTYFImjBjuzGkB48xFqD8OJ85A/ly4cx5obVbD3oPQ0eFMZ1Drz9YXMFfKa/4VUFmt832KWrfqnngYpk4ysy7LXGZudg4MS3arsXc/0Xv0K7jaBHd9H0YMg5Pn4I2/RqHfQ37xanXAD0C5V1cCz7tRJ/t0+Y/NbFy6ChMyzCqIh8jsy/bIGAPJSfDaX+Cs+5rxK8WFal0AADmeXFVvlyyGnKx4DNda5/HT8NZu63YRWnxaXKi+p6Rurzq54EbNuDGwaombnrHrs/1tuHDZnb5kyFQV1foJrQibKFipfex+mDXNqlV8f5cQ+fY/3NlQmidVuVcL8REC5EhGjoBfPhO//e7EmY07Tfh0Kkrzoqrw6hqN/xbHkcyfDYvvdtQlbo3f/zccOOJCvaJGlXl1rYJ8p92feRQm3+q0V3zan78ENe+40l0rW0AY+lQn3SW+/3rZ4Fj+Ab//8Bp80+ZkFH4efFwAkDM03UlXCXsS/uyIsDihxMIThBzNva3/Xoc/h7ovISkJ5s8yBMuOvPM+HLOZbAXpuywASOk4yY6RQJv7fwCSsFjJFyfhT3/v3WpRnmFz4eRf/zEUN1h+stgkVVYi9Hv3x1at+vze7gqAFY+DJD5WsmUXXJZrzCBJTIBfPWuYXLC0d4As486u3n8fOxpWL7WyBFe+hs1vWbcLaeEHwNEW8HhgzQpISOjfWEcnVL0avs2yHxnKHCznLsGOCAfZ2pUgwPUnQpPFXiiAFpD4t4CjQ9DujPTnUMFPTXocLJL+bt7V113JNH+zwt6Bu/3PDlNlOQSdhkEpVDx2n72lJgxNmFqwjEkDASA0YRLAZAlLxhcst02Fxx+wZ++9vSCHqAOpdUyE+jvEQg03tcCb7307KEljlzwIEzPDuyiZ3R/3wPUb5ndZJU8+AlJWsyP7D8MHTpJ6IUJOqfAPF8Eci1AW7KyEvxNnobMTsifBSIvCiMTyhjOQmAhTJ5pwaFckDEo4tCuGCjtMhgLFD7tGBrLd6Qvw+rv2LfqTIafp8MolpiDRa5Y7DdGRBGkgRAqlEoVCQ6lUkDc5yGv96bA4XO7VtgsiEsPDLePT5+FaM8yZYe/EdgtU3VemJBaOIUoI3LDNtmZTEOkGwHZJ7L47TYEynAgIHx+CWTkwJ8eaK9h11eczNcEjX5jCaCR67JANflsSc1oUXXgH3D0/vPtyiP1tr7kLEO4vJfLJ462JTKg2mU2JCg1nTW4g/OORRabgGk4kHZa02LYEF0XdlMVzpsDDCyPve6nafrTfACH7dWIGjM+AtBRIHWn2r5AcuZkQ1ihUuKUVmlpB0lsZvICQmQ6LFsC0yeGHJufBnn+aixcH0rssLh3dXIzIXpQlKVlbpHAlAEhsb73uwD3MxcnShyJzBgFHlrwkUI7T4NCLEXEtmqsxubWZPR1mTjdJUjBvF2YmDM2NPHCXuWwJSFcXXLxi0l7ZFo4HbhSFvxrrPgyjvhwVintLKowbDaPTzNWYwwSlZ8CSeMkdozBKuReUKCOUORqJeDkqSruvx49hnrPfjNL/9biMeEg/kBAAhvwTGQHh5S06x+PzP5KSrzpuBrH/SCow2orN+imt2XkzjB5w9kwuMOgh/VCy5zzI4lU3N0eDYuUoaloaWOn6qawfhKH8WDowi0P6uXwPCEP5g4ng/dwdHaoH4TtiqScXRXoUHelMcvWaR3hCQhdbB8t74gH9aKrXlshilTJvC21clMUlLjQqTUnzKbbZ/UYo1AtXKyBYye9r9JjENtYq5f94cqA+nLyqNVWdw9kQ/O7XDcRRAxAw6q8n3ODnWlHk9sGl1QDk01mlqe6CjYGnrlZ9rH6PGQABQ1Jeq9hKHj6WAw8C86ycsPhdKtZ78FCzfhUHB+3H05EGUeXVGR2ae4HbtYeZaHJRjEOHfD6vaELTiKJe+ZCaxGdJig/XFKpLUQLYb/f/AdnOSTrgWj19AAAAAElFTkSuQmCC"
                     style="width: 24px;" alt="" /> &nbsp; Join us at Discord!
            </a>
        </div>

        <div class="navbar-end">
            @auth
                <a href="{{ route('profiles.logged_in') }}" class="@if(Request::is('logged_in')) is-active @endif navbar-item">
                    Your mailbox
                </a>
                <a href="{{ route('profiles.list_of_emails') }}" class="@if(Request::is('list_of_emails')) is-active @endif navbar-item">
                    Your emails
                </a>
            @endauth
            <div class="navbar-item">
                <div class="buttons">
                    @auth
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        <a class="button" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    @endauth
                    @guest
                        <a class="button is-light"
                           target="_blank" href="https://chrome.google.com/webstore/detail/instalogin/mchgflohnhdlaonaejeomkjhninepofc">
                            <img style="margin-right: 5px;" width="25px" src="{{ mix('img/chrome_32x32.png') }}" />
                            Get Chrome Extension
                        </a>
                        <a class="button is-light"
                           target="_blank" href="https://addons.mozilla.org/firefox/addon/instalogin/">
                            <img style="margin-right: 5px;" width="25px" src="{{ mix('img/firefox.png') }}" alt=""/>
                            Get Firefox Extension
                        </a>
                        <a href="{{ route('register') }}" class="button is-danger">
                            Sign Up
                        </a>
                        <a href="{{ route('login') }}" class="button">
                            Log in
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>
@show

@yield('first_section')

<footer class="container is-max-desktop has-text-right" style="margin-top: 0.5em; margin-bottom: 0.5em; font-size: 0.8em;">
    © {{ now()->year }} <a href="/" class="has-text-grey">instalogin</a>&nbsp; <a class="has-text-grey" href="mailto:x@instalogin.co">contact</a>
</footer>

<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
