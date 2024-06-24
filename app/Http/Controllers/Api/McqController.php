<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mcq;
use Illuminate\Http\Request;

class McqController extends Controller
{
    public function index(Request $request)
    {
        $mcqs = Mcq::all();
        return response()->json($mcqs);
    }
    public function show($id)
    {
        $mcq = Mcq::find($id);
        if (!$mcq) {
            return response()->json(['message' => 'MCQ not found'], 404);
        }
        return response()->json($mcq);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|integer',
            'sn' => 'required|integer',
            'question' => 'required|string',
            'option1' => 'nullable|string',
            'option2' => 'nullable|string',
            'option3' => 'nullable|string',
            'option4' => 'nullable|string',
            'answer' => 'nullable|string',
        ]);

        $mcq = Mcq::create($request->all());

        return response()->json($mcq, 201);
    }
}
