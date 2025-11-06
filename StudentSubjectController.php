<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class StudentSubjectController extends Controller
{
    public function showSubjects()
    {
        $subjects = Subject::all();
        $selected = auth()->user()->subjects->pluck('id')->toArray();

        return view('student.select-subjects', compact('subjects', 'selected'));
    }

    public function selectSubjects(Request $request)
    {
        $user = auth()->user();
        $user->subjects()->sync($request->subjects);

        return redirect()->route('student.dashboard')->with('success', 'Subjects updated successfully!');
    }
}
