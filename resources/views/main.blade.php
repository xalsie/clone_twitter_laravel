<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            ::-webkit-scrollbar {
                width: 5px;
            }
            ::-webkit-scrollbar-thumb {
                background-color: dimgrey;
                border-radius: 10px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background-color: grey;
            }
            ::-webkit-scrollbar-track {
                background-color: lightgrey;
                border-radius: 10px;
                box-shadow: inset 7px 10px 12px #f0f0f0;
            }
        </style>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="dark:bg-gray-900">
        <?php
            include_once(app_path().'/includes/functions.php');
        ?>

        <div class="">
            @include('layouts.header')

            <div class="flex">
                @include('layouts.sidebar')

                <div class="max-w-7xl mx-auto p-6 lg:p-8 mt-16" style="width: 625px;">
                    @if($view == 'tweet.comments')
                        @include($view, [ 'tweet' => $tweet, 'comments' => $comments ])
                    @elseif($view == 'tweet.retweet')
                        @include($view, [ 'tweet' => $tweet ])
                    @elseif($view == 'user.profile')
                        @include($view, [ 'profile' => $profile, 'tweets' => $tweets ])
                    @elseif($view == 'user.followers')
                        @include($view, [ 'profile' => $profile, 'followers' => $followers ])
                    @elseif($view == 'user.followed')
                        @include($view, [ 'profile' => $profile, 'followed' => $followed ])
                    @elseif($view == 'profile.edit')
                        @include($view, [ 'user' => $user ])
                    @else
                        @include($view, [ 'tweets' => $tweets ])
                    @endif
                </div>

                @include('layouts.rightbar', [ 'rightbar' => $rightbar ])
            </div>
        </div>
    </body>

    @auth
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script type="module"> // the change is here
        Echo.private(`App.Models.User.{{ auth()->user()->id }}`)
            .notification((notification) => {
                console.log('Private RealTimeMessage: ' + notification);
                console.log(notification);

                Toastify({
                    text: notification.message,
                    duration: 3000,
                    destination: notification.url,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    onClick: function(){} // Callback after click
                }).showToast();
            });
    </script>
    @endauth
</html>
