<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h2>Student List</h2>
    <a href="{{ route('staff.students.create') }}">➕ Add New Student</a><br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>

        @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
            </tr>
        @endforeach
    </table>

    <br>
    <a href="{{ route('staff.dashboard') }}">Back to Dashboard</a>
</body>
</html>
