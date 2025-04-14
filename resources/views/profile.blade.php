<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <header>
        @include('layouts.navigation')
    </header>
    <h1>Profile</h1>
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Created At:</strong> {{ $user->created_at->format('d.m.Y H:i:s') }}</p>
    <p><strong>Updated At:</strong> {{ $user->updated_at->format('d.m.Y H:i:s') }}</p>
    
    {{-- Display user details --}}
    <h2>User Details</h2>
    @if ($user->details)
        <p><strong>ID:</strong> {{ $user->details->id }}</p>
        <p><strong>Main User:</strong> {{ $user->details->main_user ? 'Yes' : 'No' }}</p>
        <p><strong>Main User No:</strong> {{ $user->details->main_user_no ?? 'Not Set' }}</p>
        <p><strong>Custom Groups:</strong> {{ $user->details->custom_groups ? 'Yes' : 'No' }}</p>
        <p><strong>Custom Groups ID:</strong> {{ $user->details->custom_groups_id ?? 'Not Set' }}</p>
        <p><strong>Level:</strong> {{ $user->details->level }}</p>
        <p><strong>Admin Level:</strong> {{ $user->details->admin_level }}</p>
        <p><strong>Timezone:</strong> {{ $user->details->timezone ?? 'Not Set' }}</p>
        <p><strong>Language:</strong> {{ $user->details->language ?? 'Not Set' }}</p>
    @else
        <p>No additional details available.</p>
    @endif
</body>
</html>