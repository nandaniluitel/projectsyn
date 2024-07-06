<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadfilesController extends Controller
{
    //
    public function index()
    {
        $mcqs = Mcq::all();
        return view('mcqs.index', compact('mcqs'));
    }
    public function indexCategory($cname){
        $category = Category::where('title', 'like', $cname)->first();
        if ($category){
            $mcqs = Mcq::where('category', $category->id)->get();
            return view('mcqs.index', compact('mcqs'));
        }else{
            abort(404);
        }
    }

    public function showUploadForm()
    {
        return view('uploadfiles.create');
    }
    public function handleFileUpload(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'reportType' => 'required|string',
            'reportFile' => 'required|file|mimes:pdf,doc,docx', // Adjust mime types as needed
            'slideType' => 'nullable|string',
            'slideFile' => 'nullable|file|mimes:ppt,pptx',

            'groupId' => 'nullable|exists:project_groups,id',
            'supervisor_id' => 'nullable|exists:supervisors,id',

        ]);

        // Handle the report file upload
        $reportPath = $request->file('reportFile')->store('reports', 'public');

        // Handle the optional slide file upload
        $slidePath = $request->hasFile('slideFile') ? $request->file('slideFile')->store('slides', 'public') : null;

        // Save to the projects table
        Project::create([
            'groupId' => $request->input('groupId'),
            'report_file' => $reportPath,
            'slides_file' => $slidePath,
            'supervisor_id' => $request->input('supervisor_id'),
        ]);

        // Redirect or respond as needed
        return redirect()->back()->with('success', 'Files uploaded successfully.');
        
    }
}
