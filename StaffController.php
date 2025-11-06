<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentProfile;

class StaffController extends Controller
{
    // ✅ Show all students
    public function index()
    {
        $students = User::where('role', 'student')->with('studentProfile')->get();
        return view('manage_students.index', compact('students'));
    }

    // ✅ Show edit form
    public function edit($id)
    {
        $student = User::where('role', 'student')->with('studentProfile')->findOrFail($id);
        return view('manage_students.edit', compact('student'));
    }

    // ✅ Update student info
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer',
            'contact' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
        ]);

        $student = User::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $student->studentProfile()->updateOrCreate(
            ['user_id' => $student->id],
            [
                'dob' => $request->dob,
                'age' => $request->age,
                'contact' => $request->contact,
                'address' => $request->address,
                'gender' => $request->gender,
            ]
        );

        return redirect()->route('staff.students.index')->with('success', 'Student details updated successfully.');
    }
}
