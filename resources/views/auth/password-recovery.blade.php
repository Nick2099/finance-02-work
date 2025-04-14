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
    <h1>{{ __('messages.password_recovery.title') }}</h1>
    <form method="POST" action="{{ route('login.send-recovery-email') }}">
        @csrf
        <div>
            <label for="email">{{ __('messages.password_recovery.email') }}:</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <button type="submit">{{ __('messages.password_recovery.send_recovery_link') }}</button>
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

