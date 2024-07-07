<?php

use App\Http\Controllers\GoogleController;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\McqController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UploadfilesController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\CoordinatorController;
use App\Models\Category;
use App\Models\McqResponse;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/frontpage/index');
    // return view('welcome');
});
// Route::get('/dashboard', function () {
//     echo 'dashboard';
// });
Route::get('/dashboard1', function () {
    $userfullname='Dinesh Dangol';
    $userimagesource='AR64.png';
    return view('dashboard', compact('userfullname','userimagesource'));
});
Route::get('/table', function () {
    $userfullname='Dinesh Dangol';
    $userimagesource='AR64.png';
    return view('table', compact('userfullname','userimagesource'));
});
class Student {
    public $name;
    public $semester;
    public $roll;

    // Constructor to initialize properties
    public function __construct($name, $semester, $roll) {
        $this->name = $name;
        $this->semester = $semester;
        $this->roll = $roll;
    }
}

Route::post('/setanswer', function (Request $request) {
    // $formData = $request->all();
    $validatedData = $request->validate([
        'qid' => 'required',
        'answer' => 'required',
    ]);
    $qid = $request['qid'];
    $answer = $request['answer'];
    // $qid = $formData['qid'];
    //     $answer = $formData['answer'];
    // echo 'hello'.$qid.$answer;
    // die();
    $q = \App\Models\Mcq::find($qid);
    $q->answer = $answer;
    $q->save();
    return response()->json(['message' => 'Data received successfully', 'qid' => $qid, 'answer' => $answer]);
    // return redirect('mcqs');
    // echo $q;
});
// Create an array of student objects
Route::get('/dashboard', function () {
    $json_students = '[
        {"name":"John Doe","semester":2,"roll":101},
        {"name":"Jane Smith","semester":3,"roll":102},
        {"name":"Dinesh Smith","semester":3,"roll":103},
        {"name":"Alice Johnson","semester":1,"roll":101}
    ]';
    // Decode the JSON data
    $students = json_decode($json_students);
    
    $q1 = \App\Models\Mcq::find(1);
    $totalQuestions = \App\Models\Mcq::count();
    $top5Questions = \App\Models\Mcq::where('id','>',0)->limit(5)->get();
    $totalCategories = \App\Models\MCQ::where('id','>',30)->count();
    $totalCategories = \App\Models\MCQ::distinct('category')->count();
    
    $mcqs = \App\Models\MCQ::where('id','>',0)->get();
    
    // $totalUsers = \App\Models\User::count();
    // return view('dashboard', compact('mcqs', 'students', 'totalQuestions', 'totalCategories', 'totalUsers', 'top5Questions'));
    return view('dashboard', compact('mcqs'));
});
Route::get('/datatable', function () {
    // $students = [
    //     new Student("John Doe", 2, 101),
    //     new Student("Jane Smith", 3, 102),
    //     new Student("Alice Johnson", 1, 103)
    // ];
    $json_students = '[
        {"name":"John Doe","semester":2,"roll":101},
        {"name":"Jane Smith","semester":3,"roll":102},
        {"name":"Dinesh Smith","semester":3,"roll":103},
        {"name":"Alice Johnson","semester":1,"roll":101}
    ]';
    // Decode the JSON data
    $students = json_decode($json_students);
    
    
    return view('datatable', compact('students'));
});

Route::get('/jsgrid', function () {
    return view('jsgrid');
});

Route::get('/chart', function () {
    return view('chart  ');
});

// Route::get('/mcq', function () {
//     $mcqs = Mcq::all();
//     // print_r($mcqs);
//     return view('mcq', compact('mcqs'));
// });

Route::resource('mcqs', McqController::class);

Route::get('/Evaluator/index', function () {
    return view('Evaluator.index');
});

Route::get('/Supervisor/index', function () {
    return view('Supervisor.index');
});
Route::get('/Coordinator/index', function () {
    return view('Coordinator.index');
});


Route::get('/dashboard/create', [App\Http\Controllers\DashboardController::class, 'create'])->name('dashboard.create');
Route::get('/teacherdashboard/create', [App\Http\Controllers\teacherDashboardController::class, 'create'])->name('teacherdashboard.create');

Route::get('/evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');

Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');

Route::get('uploadfiles/create', [UploadfilesController::class, 'showUploadForm'])->name('uploadfiles.create');
Route::post('uploadfiles/create', [UploadfilesController::class, 'handleFileUpload'])->name('uploadfiles.store');

Route::get('/assignsupervisor', [SupervisorController::class, 'create'])->name('assignsupervisor.create');
Route::post('/assignsupervisor', [SupervisorController::class, 'assign'])->name('assignsupervisor.assign');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/frontpage/index', function () {
    return view('frontpage.index');
});


Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
Route::get('/uploadfiles', [UploadfilesController::class, 'index'])->name('uploadfiles.index1');
Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
Route::resource('projects', ProjectController::class);
Route::get('/{categoryName}/mcqs/', [McqController::class, 'indexCategory']);

Route::middleware('student')->group(function () {
    Route::get('/student-dashboard', 'StudentController@index')->name('student.dashboard');
});



Route::middleware('coordinator')->group(function () {
    Route::get('/assign-roles', [CoordinatorController::class, 'showAssignRolesForm'])->name('coordinator.assignRolesForm');
    Route::post('/assign-roles', [CoordinatorController::class, 'assignRoles'])->name('coordinator.assignRoles');
});

// Route::middleware('supervisor')->group(function () {
//     Route::get('/supervisor-dashboard', 'SupervisorController@index')->name('supervisor.dashboard');
// });

// Route::middleware('evaluator')->group(function () {
//     Route::get('/evaluator-dashboard', 'EvaluatorController@index')->name('evaluator.dashboard');
// });

Route::get('/notice', function () {
    return view('notice');
});

Route::get('/quiz', function () {
    $categories = Category::all();
    if ($categories){
        return view('quiz.dashboard', compact('categories'));
    }else{
        abort(404);
    }
    // return view('quiz.dashboard');
});

Route::get('/quiz/{category}', function ($cname) {
    $category = Category::where('title', 'like', $cname)->first();
    if ($category){
        // Get all mcq_ids that the user has answered correctly
        $mcq_id_correct = McqResponse::where('user_id', Auth::id())
            ->where('correct', 1)
            ->pluck('mcq_id')
            ->toArray();

        // Find an MCQ in the given category that the user has not answered correctly
        $mcq = Mcq::where('category', $category->id)
            ->whereNotIn('id', $mcq_id_correct)
            ->first();
        if($mcq)
            return view('quiz.index', compact('mcq'));
    }else{
        abort(404);
    }
    return view('quiz.index');
});

Route::post('/answerQuizCheck1', function (Request $request) {
    $choice = $request['choice'];
    $qid = $request['qid'];
    $q = Mcq::find($qid);
    $score = (int)$q->answer==(int)$choice?1:0;
    $nextq = Mcq::where('id','>',$q->id)->first();
    return response()->json(['message' => 'Data received successfully', 'score' => $score, 'nextq' => $nextq]);
});

Route::post('/answerQuizCheck2', function (Request $request) {
    // Validate the incoming request
    $request->validate([
        'choice' => 'required|integer',
        'qid' => 'required|integer|exists:mcqs,id',
        'user_id' => 'required|integer|exists:users,id',
    ]);

    $choice = $request['choice'];
    $qid = $request['qid'];
    $userId = $request['user_id'];

    // Find the question
    $q = Mcq::find($qid);

    // Calculate the score
    $score = ((int)$q->answer === (int)$choice) ? 1 : 0;

    // Save the response to the mcq_responses table
    McqResponse::create([
        'user_id' => $userId,
        'mcq_id' => $qid,
        'selected_option' => $choice,
        'correct' => $score,
    ]);

    // Get the next question
    $nextq = Mcq::where('id', '>', $q->id)->first();

    // Return response
    return response()->json([
        'message' => 'Data received successfully',
        'score' => $score,
        'nextq' => $nextq
    ]);
});

Route::post('/answerQuizCheck', function (Request $request) {
    // Validate the incoming request
    $request->validate([
        'choice' => 'required|integer',
        'qid' => 'required|integer|exists:mcqs,id',
    ]);

    $choice = $request['choice'];
    $qid = $request['qid'];

    // Find the question
    $q = Mcq::find($qid);

    // Calculate the score
    $score = ((int)$q->answer === (int)$choice) ? 1 : 0;

    // Check if the user is authenticated
    if (Auth::check()) {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Save the response to the mcq_responses table
        McqResponse::create([
            'user_id' => $userId,
            'mcq_id' => $qid,
            'selected_option' => $choice,
            'correct' => $score,
        ]);
    }

    // Get the next question
    $nextq = Mcq::where('id', '>', $q->id)->first();

    // Return response
    return response()->json([
        'message' => 'Data received successfully',
        'score' => $score,
        'nextq' => $nextq
    ]);
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', function(){
    return redirect('/quiz');
})->name('home');
Route::get('/readme', function(){
    $tutorial = \App\Models\Tutorial::find(1);
    $tutorials = \App\Models\Tutorial::all();
    $tutorials = \App\Models\Tutorial::where('status',1)->get();;
    return view('readme',compact('tutorial','tutorials'));
})->name('readme');

Route::get('/readme/{categoryid}', function($cid){
    //$tutorial = \App\Models\Tutorial::find(1);
    //$tutorials = \App\Models\Tutorial::all();
    $tutorials = \App\Models\Tutorial::where('categoryid',$cid)->get();;
    return view('readme',compact('tutorials'));
})->name('readme');

Route::get('/login/google', [GoogleController::class, 'redirect']);
Route::get('/login/google/callback', [GoogleController::class, 'login']);
