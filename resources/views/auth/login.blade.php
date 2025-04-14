{{-- filepath: /home/nick2099/code/laravel-projects/finance-02-work/resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login.login') }}</title>
</head>
<body>
    <header>
        @include('layouts.navigation')
    </header>
    <h1>{{ __('messages.login.title') }}</h1>
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div>
            <label for="email">{{ __('messages.login.email') }}:</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">{{ __('messages.login.password') }}:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">{{ __('messages.general.submit') }}</button>
    </form>

    <div>
        <a href="{{ route('password-recovery') }}">{{ __('messages.login.forgot_password') }}</a>
    </div>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div  class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

</body>
</html>

