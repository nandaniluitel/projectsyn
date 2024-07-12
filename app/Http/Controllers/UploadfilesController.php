<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadfilesController extends Controller
{
    // Existing methods...

    public function index()
    {
        $projects = Project::all();
        return view('uploadfiles.index1', compact('projects'));
    }

    public function indexCategory($cname)
    {
        $category = Category::where('title', 'like', $cname)->first();
        if ($category) {
            $mcqs = Mcq::where('category', $category->id)->get();
            return view('mcqs.index', compact('mcqs'));
        } else {
            abort(404);
        }
    }

    public function showUploadForm()
    {
        return view('uploadfiles.create');
    }

    public function view()
    {
        return view('uploadfiles.view');
    }

    public function handleFileUpload(Request $request)
{
    // Define base validation rules
    $rules = [
        'reportType' => 'required|string',  // Adjust as needed
        'reportFile' => 'required|file|mimes:pdf,doc,docx', // Adjust mime types as needed
        'slideType' => 'nullable|string',
        'slideFile' => 'nullable|file|mimes:ppt,pptx,pdf,doc,docx',
        'groupId' => 'nullable|exists:project_groups,id',

    ];

    // Add conditional rule for supervisor_id based on reportType
    if ($request->input('reportType') !== 'proposal') {
        $rules['supervisor_id'] = 'required|exists:supervisors,id';
    } else {
        $rules['supervisor_id'] = 'nullable|exists:supervisors,id';
    }

 

    // Validate the incoming request data
    $request->validate($rules);

    // Handle the report file upload
    $reportPath = $request->file('reportFile')->store('reports', 'public');

    // Handle the optional slide file upload
    $slidePath = $request->hasFile('slideFile') ? $request->file('slideFile')->store('slides', 'public') : null;

  
    // Save to the projects table
    Project::create([
        'groupId' => $request->input('groupId'),
        'report_type' => $request->input('reportType'), // Retrieve report type from form input
        'report_file' => $reportPath,
        'slides_file' => $slidePath,
        'supervisor_id' => $request->input('supervisor_id'),
    ]);

    // Redirect or respond as needed
    return redirect()->back()->with('success', 'Project registered successfully.');
}


}