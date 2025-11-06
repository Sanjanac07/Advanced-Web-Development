<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyMaterial;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    // Show upload form (for staff)
    public function create()
    {
        return view('staff.materials.create');
    }

    // Handle upload
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('file')->store('materials', 'public');

        StudyMaterial::create([
            'title' => $request->title,
            'file_path' => $path,
        ]);

        return redirect()->route('staff.materials.index')->with('success', 'File uploaded successfully!');
    }

    // List all materials (for staff)
    public function index()
    {
        $materials = StudyMaterial::all();
        return view('staff.materials.index', compact('materials'));
    }

    // List all materials (for students)
    public function studentIndex()
    {
        $materials = StudyMaterial::all();
        return view('student.materials.index', compact('materials'));
    }
}
