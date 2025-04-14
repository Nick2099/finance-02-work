{{-- filepath: /home/nick2099/code/laravel-projects/finance-02-work/resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.password_recovery.title') }}</title>
</head>
<body>
    <header>
        @include('layouts.navigation')
    </header>
    <h1>{{ __('messages.reset_password.title') }}</h1>
    <form method="POST" action="{{ route('login.reset-password') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label for="password">{{ __('messages.reset_password.password') }}:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">{{ __('messages.reset_password.confirm_password') }}:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">{{ __('messages.reset_password.reset_password') }}</button>
    </form>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>

