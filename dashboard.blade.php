<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <h2>Welcome, {{ auth()->user()->name }}</h2>
    <p>You are logged in as a <strong>Staff</strong>.</p>
 <br><br>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
        <br><br>
    <a href="{{ route('staff.students.index') }}">Manage Students</a>

    </form>
</body>
</html>
