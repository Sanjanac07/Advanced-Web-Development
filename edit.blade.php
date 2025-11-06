<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h2>Edit Student Details</h2>

    <form action="{{ route('staff.students.update', $student->id) }}" method="POST">
        @csrf

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ $student->name }}" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ $student->email }}" required><br><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="dob" value="{{ $student->studentProfile->dob ?? '' }}"><br><br>

        <label>Age:</label><br>
        <input type="number" name="age" value="{{ $student->studentProfile->age ?? '' }}"><br><br>

        <label>Contact:</label><br>
        <input type="text" name="contact" value="{{ $student->studentProfile->contact ?? '' }}"><br><br>

        <label>Address:</label><br>
        <textarea name="address">{{ $student->studentProfile->address ?? '' }}</textarea><br><br>

        <label>Gender:</label><br>
        <select name="gender">
            <option value="">Select</option>
            <option value="Male" {{ ($student->studentProfile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ ($student->studentProfile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
        </select><br><br>

        <button type="submit">Update Student</button>
    </form>

    <br>
    <a href="{{ route('staff.students.index') }}">← Back to Student List</a>
</body>
</html>
