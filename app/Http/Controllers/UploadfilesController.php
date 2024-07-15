<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectGroup;
use App\Models\Supervisor;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class UploadfilesController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('uploadfiles.index1', compact('projects'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user) {
            $student = $user->student;
            if ($student) {
                $projectGroupIds = $student->projectGroups()->pluck('project_group_id')->toArray();
                $projectTitles = ProjectGroup::whereIn('id', $projectGroupIds)->pluck('title', 'id');
                $supervisors = Supervisor::with('teacher.user')->get();
                return view('uploadfiles.create', compact('projectTitles', 'supervisors'));
            } else {
                dd('Student not found for the authenticated user.');
            }
        } else {
            dd('User not authenticated.');
        }
    }

    public function viewAcceptedProjects()
    {
        $reports = Project::where('status', 'accepted')->get();
        return view('Supervisor.reports', compact('reports'));
    }

    public function coordinatorView()
    {
        $projects = Project::where('status', 'accepted')->get();
        $group = ProjectGroup::first();
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
        $supervisors = Supervisor::with('teacher.user')->get();
        $projectGroups = ProjectGroup::all();
        return view('uploadfiles.create', compact('projectGroups', 'supervisors'));
    }

    public function view()
    {
        return view('uploadfiles.view');
    }

    public function handleFileUpload(Request $request)
    {
        $rules = [
            'projectTitle' => 'required|exists:project_groups,id',
            'reportType' => 'required|string',
            'reportFile' => 'required|file|mimes:pdf,doc,docx',
            'slideType' => 'nullable|string',
            'slideFile' => 'nullable|file|mimes:ppt,pptx,pdf,doc,docx',
        ];

        if ($request->input('reportType') !== 'proposal') {
            $rules['supervisor_id'] = 'required|exists:supervisors,id';
        } else {
            $rules['supervisor_id'] = 'nullable|exists:supervisors,id';
        }

        $request->validate($rules);

        $reportPath = $request->file('reportFile')->store('reports', 'public');
        $slidePath = $request->hasFile('slideFile') ? $request->file('slideFile')->store('slides', 'public') : null;

        $status = $request->input('reportType') === 'proposal' ? 'accepted' : 'pending';

        Project::create([
            'groupId' => $request->input('projectTitle'),
            'report_type' => $request->input('reportType'),
            'report_file' => $reportPath,
            'slides_file' => $slidePath,
            'supervisor_id' => $request->input('supervisor_id'),
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Report registered successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $report = Project::findOrFail($id);

        if ($report->report_type === 'proposal') {
            return redirect()->back()->with('error', 'Proposal status cannot be changed.');
        }

        $report->status = $request->input('status');
        $report->save();

        return redirect()->back()->with('success', 'Report status updated successfully.');
    }
}
