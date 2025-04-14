{{-- filepath: /home/nick2099/code/laravel-projects/finance-02-work/resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.email_sent.title') }}</title>
</head>
<body>
    <header>
        @include('layouts.navigation')
    </header>
    <h1>{{ __('messages.email_sent.title') }}</h1>
    <p>{{ __('messages.email_sent.message') }}</p>
</body>
</html>

