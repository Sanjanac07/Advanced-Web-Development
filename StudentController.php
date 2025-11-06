<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show all students (for staff)
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('staff.students.index', compact('students'));
    }

    public function create()
{
    return view('staff.students.create');
}

// Handle student creation form submission
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'student', // Always student
    ]);

    return redirect()->route('staff.students.index')->with('success', 'Student added successfully!');
}

// Add inside your existing StudentController
public function dashboard()
{
    $student = auth()->user()->load('studentProfile', 'marks');
    return view('student.dashboard', compact('student'));
}

}
