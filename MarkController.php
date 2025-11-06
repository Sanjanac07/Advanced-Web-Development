<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mark;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
    // Staff: view all marks
    public function index()
    {
        $marks = Mark::with('student')->get();
        return view('staff.marks.index', compact('marks'));
    }

    // Staff: show add form
    public function create()
    {
        $students = User::where('role', 'student')->get();
        return view('staff.marks.create', compact('students'));
    }

    // Staff: store marks
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'marks' => 'required|integer|min:0|max:100',
        ]);

        Mark::create($request->only('student_id', 'subject', 'marks'));

        return redirect()->route('staff.marks.index')->with('success', 'Marks added successfully!');
    }

    // Student: view their own marks
    public function studentMarks()
    {
        $studentId = Auth::id();
        $marks = Mark::where('student_id', $studentId)->get();
        
        return view('student.marks', compact('marks')); // ADD THIS RETURN STATEMENT
    }

    // Staff: Edit marks
    public function edit($id)
    {
        $mark = Mark::with('student')->findOrFail($id);
        return view('staff.marks.edit', compact('mark'));
    }

    // Staff: Update marks
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'marks' => 'required|integer|min:0|max:100',
        ]);

        $mark = Mark::findOrFail($id);
        $mark->update($request->only('subject', 'marks'));

        return redirect()->route('staff.marks.index')->with('success', 'Marks updated successfully!');
    }
}