<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mcq;
use Illuminate\Http\Request;

class ProjectController extends Controller
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

    public function create()
    {
        return view('projects.create');
    }
    public function store(Request $request)
    {
        // echo $request['question'];
        // Validate the incoming request data
        $validatedData = $request->validate([
            'question' => 'required',
            // 'option1' => 'required',
            // 'option2' => 'required',
            // 'option3' => 'required',
            // 'option4' => 'required',
            // 'correct_answer' => 'required',
        ]);
        echo $validatedData['question'];
    }
}
