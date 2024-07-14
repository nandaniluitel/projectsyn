<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectGroup;
use App\Models\Supervisor;


class UploadfilesController extends Controller
{
    // Existing methods...

    public function index()
    {
        $projects = Project::all();
        return view('uploadfiles.index1', compact('projects'));
    }

    public function viewAcceptedProjects()
    {
        // Fetch only projects with status 'accept'
        $reports = Project::where('status', 'accept')->get();
        return view('Supervisor.reports', compact('reports'));
    }
    public function coordinatorView()
    {
        $projects = Project::where('status', 'accept')->get();
        $group = ProjectGroup::first(); // Fetch the first group as an example; adjust as per your logic

        return view('coordinator.accepted-projects', compact('projects', 'group'));
    }

    public function viewProposalReports()
    {
        $proposalReports = Project::where('report_type', 'proposal')->get();
        return view('coordinator.proposal-reports', compact('proposalReports'));
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
        // Fetch all supervisors with their names
        $supervisors = Supervisor::with('teacher.user')->get(); // Adjust relationship path as per your actual structure
        $projectGroups = ProjectGroup::all(); // Fetch all project groups
        return view('uploadfiles.create', compact('projectGroups', 'supervisors'));
    }

    public function view()
    {
        return view('uploadfiles.view');
    }

    public function handleFileUpload(Request $request)
    {
        // Define base validation rules
        $rules = [
            'projectTitle' => 'required|exists:project_groups,id', // Validate project title
            'reportType' => 'required|string',  // Adjust as needed
            'reportFile' => 'required|file|mimes:pdf,doc,docx', // Adjust mime types as needed
            'slideType' => 'nullable|string',
            'slideFile' => 'nullable|file|mimes:ppt,pptx,pdf,doc,docx',
            
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
            'groupId' => $request->input('projectTitle'),
            'report_type' => $request->input('reportType'), // Retrieve report type from form input
            'report_file' => $reportPath,
            'slides_file' => $slidePath,
            'supervisor_id' => $request->input('supervisor_id'),
            'status' => 'pending', // default status
        ]);

        // Redirect or respond as needed
        return redirect()->back()->with('success', 'Report registered successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $report = Project::findOrFail($id);
        $report->status = $request->input('status');
        $report->save();

        return redirect()->back()->with('success', 'Report status updated successfully.');
    }
}
