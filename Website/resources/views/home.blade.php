<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <!-- Add any necessary stylesheets or scripts here -->
</head>
<body>
    <h1>Create User</h1>

    <form action="{{ url('/user/create-account') }}" method="POST">
        @csrf
        <div>
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
        </div>
        <div>
            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" required>
        </div>
        <div>
            <label for="last_education">Last Education:</label>
            <input type="text" id="last_education" name="last_education">
        </div>
        <div>
            <button type="submit">Create Account</button>
        </div>
    </form>
</body>
</html>
