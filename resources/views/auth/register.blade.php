<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <header>
        @include('layouts.navigation')
    </header>
    <h1>{{ __('messages.register.title') }}</h1>
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div>
            <label for="name">{{ __('messages.register.name') }}:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label for="email">{{ __('messages.register.email') }}:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">{{ __('messages.register.password') }}:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">{{ __('messages.register.confirm_password') }}:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div>
            <label for="timezone">{{ __('messages.general.timezone') }}:</label>
            <select id="timezone" name="timezone">
                @foreach (timezone_identifiers_list() as $timezone)
                    <option value="{{ $timezone }}" {{ old('timezone') === $timezone ? 'selected' : '' }}>
                        {{ $timezone }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="language">Language:</label>
            <select id="language" name="language">
                <option value="en" {{ old('language') === 'en' ? 'selected' : '' }}>English</option>
                <option value="hr" {{ old('language') === 'hr' ? 'selected' : '' }}>Croatian</option>
                <option value="de" {{ old('language') === 'de' ? 'selected' : '' }}>German</option>
                <option value="fr" {{ old('language') === 'fr' ? 'selected' : '' }}>French</option>
                <option value="es" {{ old('language') === 'es' ? 'selected' : '' }}>Spanish</option>
            </select>
        </div>
        <button type="submit">{{ __('messages.register.register') }}</button>
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

    {{-- Display registration error --}}
    @if ($errors->has('registration'))
        <div>
            <p>{{ $errors->first('registration') }}</p>
        </div>
    @endif
</body>
</html>

