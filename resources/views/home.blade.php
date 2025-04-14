<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
        <header>
            @include('layouts.navigation')
        </header>
        <div>
            <h1>Homepage</h1>

            @unless (Auth::check())
                <h2>Welcome, Guest!</h2>
                <p>Please sign in to access more features.</p>
            @else
                <h2>Welcome, {{ Auth::user()->name }}!</h2>
                <p>You are signed in as {{ Auth::user()->name }}.</p>
            @endunless
        </div>
    </body>
</html>
