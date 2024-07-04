<?php

namespace App\Http\Controllers;

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
        return view('projects.uploadfiles');
    }
    public function handleFileUpload(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'reportType' => 'required|string',
            'reportFile' => 'required|file|mimes:pdf,doc,docx', // Adjust mime types as needed
            'slideType' => 'nullable|string',
            'slideFile' => 'nullable|file|mimes:ppt,pptx',
        ]);

        // Handle the report file upload
        if ($request->hasFile('reportFile')) {
            $reportPath = $request->file('reportFile')->store('reports', 'public');
            // Save the report path to the database or process it as needed
        }

        // Handle the optional slide file upload
        if ($request->hasFile('slideFile')) {
            $slidePath = $request->file('slideFile')->store('slides', 'public');
            // Save the slide path to the database or process it as needed
        }

        // Redirect or respond as needed
        return redirect()->route('some.route')->with('success', 'Files uploaded successfully');
    }
}
