# Project Notes

## Password Validation Rules
- Minimum 10 characters
- At least one uppercase and one lowercase letter
- At least one number
- At least one symbol

## Navigation Setup
- Guests see links to `Login` and `Register`.
- Authenticated users see links to `Dashboard`, `Profile`, and `Logout`.

## Registration Page
- Located at `/register`.
- Validates user input and creates a new user.
- Redirects to the dashboard after successful registration.
- User Nikica Dadic has password Test1234!!

## Updated Routes
- All routes now use hyphens (`-`) instead of underscores (`_`) for better readability and SEO compliance.

## Logout Link
- The logout button has been replaced with a link that triggers the logout form submission using JavaScript.

## Debugging Tips
- Use `dd()` to debug variables.
- Check validation errors with `$errors->all()`.
- Ensure database connection is properly configured in `.env`.

## Future Improvements
- Add email verification for new users.
- Improve UI with Tailwind CSS.
- Add tests for registration and login functionality.