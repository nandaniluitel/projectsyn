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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SupervisorProfileController;
use App\Models\Category;
use App\Models\McqResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\teacherDashboardController;
use App\Http\Controllers\FeedbackController;
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
// Route::get('/dashboard1', function () {
//     $userfullname='Dinesh Dangol';
//     $userimagesource='AR64.png';
//     return view('dashboard', compact('userfullname','userimagesource'));
// });
// Route::get('/table', function () {
//     $userfullname='Dinesh Dangol';
//     $userimagesource='AR64.png';
//     return view('table', compact('userfullname','userimagesource'));
// });
// class Student {
//     public $name;
//     public $semester;
//     public $roll;

//     // Constructor to initialize properties
//     public function __construct($name, $semester, $roll) {
//         $this->name = $name;
//         $this->semester = $semester;
//         $this->roll = $roll;
//     }
// }

// Route::post('/setanswer', function (Request $request) {
//     // $formData = $request->all();
//     $validatedData = $request->validate([
//         'qid' => 'required',
//         'answer' => 'required',
//     ]);
//     $qid = $request['qid'];
//     $answer = $request['answer'];
//     // $qid = $formData['qid'];
//     //     $answer = $formData['answer'];
//     // echo 'hello'.$qid.$answer;
//     // die();
//     $q = \App\Models\Mcq::find($qid);
//     $q->answer = $answer;
//     $q->save();
//     return response()->json(['message' => 'Data received successfully', 'qid' => $qid, 'answer' => $answer]);
//     // return redirect('mcqs');
//     // echo $q;
// });
// // Create an array of student objects
// Route::get('/dashboard', function () {
//     $json_students = '[
//         {"name":"John Doe","semester":2,"roll":101},
//         {"name":"Jane Smith","semester":3,"roll":102},
//         {"name":"Dinesh Smith","semester":3,"roll":103},
//         {"name":"Alice Johnson","semester":1,"roll":101}
//     ]';
//     // Decode the JSON data
//     $students = json_decode($json_students);
    
//     $q1 = \App\Models\Mcq::find(1);
//     $totalQuestions = \App\Models\Mcq::count();
//     $top5Questions = \App\Models\Mcq::where('id','>',0)->limit(5)->get();
//     $totalCategories = \App\Models\MCQ::where('id','>',30)->count();
//     $totalCategories = \App\Models\MCQ::distinct('category')->count();
    
//     $mcqs = \App\Models\MCQ::where('id','>',0)->get();
    
//     // $totalUsers = \App\Models\User::count();
//     // return view('dashboard', compact('mcqs', 'students', 'totalQuestions', 'totalCategories', 'totalUsers', 'top5Questions'));
//     return view('dashboard', compact('mcqs'));
// });
// Route::get('/datatable', function () {
//     // $students = [
//     //     new Student("John Doe", 2, 101),
//     //     new Student("Jane Smith", 3, 102),
//     //     new Student("Alice Johnson", 1, 103)
//     // ];
//     $json_students = '[
//         {"name":"John Doe","semester":2,"roll":101},
//         {"name":"Jane Smith","semester":3,"roll":102},
//         {"name":"Dinesh Smith","semester":3,"roll":103},
//         {"name":"Alice Johnson","semester":1,"roll":101}
//     ]';
//     // Decode the JSON data
//     $students = json_decode($json_students);
    
    
//     return view('datatable', compact('students'));
// });

// Route::get('/jsgrid', function () {
//     return view('jsgrid');
// });

// Route::get('/chart', function () {
//     return view('chart  ');
// });

// Route::get('/mcq', function () {
//     $mcqs = Mcq::all();
//     // print_r($mcqs);
//     return view('mcq', compact('mcqs'));
// });

// Route::resource('mcqs', McqController::class);
// Route::get('/{categoryName}/mcqs/', [McqController::class, 'indexCategory']);













Route::get('/frontpage/index', function () {
    return view('frontpage.index');
});
// routes/web.php



Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('redirectIfAuthenticated')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('redirectIfAuthenticated');














// Define routes for reports

//ansa brought


//students
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('uploadfiles/create', [UploadfilesController::class, 'showUploadForm'])->name('uploadfiles.create');
    Route::post('uploadfiles/create', [UploadfilesController::class, 'handleFileUpload'])->name('uploadfiles.store');
    Route::get('/supervisor/profile', [SupervisorProfileController::class, 'index'])->name('supervisor.profile');
    Route::get('/upload/create', [UploadfilesController::class, 'create'])->name('upload.create');


    Route::get('/uploadfiles/create', [UploadfilesController::class, 'create'])->name('uploadfiles.create');

    Route::get('/feedback/index', [FeedbackController::class, 'index'])->name('feedback.index');
});

Route::middleware(['auth'])->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/notification/index', [NotificationsController::class, 'index'])->name('notification.index');
        Route::post('/notification', [NotificationsController::class, 'store'])->name('notification.store');
        Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');

        Route::get('/reports', [UploadfilesController::class, 'viewAcceptedProjects'])->name('reports.index');
    Route::post('/reports/{id}/update-status', [UploadfilesController::class, 'updateStatus'])->name('report.update-status');
    Route::get('/reports/{id}', [UploadfilesController::class, 'view'])->name('report.view');
    Route::post('/teacher/update-status/{id}', [UploadfilesController::class, 'updateStatus'])->name('teacher.update-status');
    // Routes for coordinators, supervisors, and evaluators
    Route::middleware(['checkTeacherRole'])->group(function () {
        Route::get('/teacherdashboard', [teacherDashboardController::class, 'create'])->name('teacherdashboard.create');
        //profile
        Route::get('/uploadfiles', [UploadfilesController::class, 'index'])->name('uploadfiles.index1');
        Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/coordinator/accepted-projects', [UploadfilesController::class, 'CoordinatorView'])->name('coordinator.accepted-projects');
    });
});
//coordinator
Route::middleware(['auth','coordinator'])->group(function () {
    Route::get('/assign-roles', [CoordinatorController::class, 'showAssignRolesForm'])->name('coordinator.assignRolesForm');
    Route::post('/assign-roles', [CoordinatorController::class, 'assignRoles'])->name('coordinator.assignRoles');

    Route::get('/assignsupervisor', [SupervisorController::class, 'create'])->name('assignsupervisor.create');
    Route::post('/assignsupervisor', [SupervisorController::class, 'assign'])->name('assignsupervisor.assign');

    Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');


    Route::get('assignroles', [CoordinatorController::class, 'showAssignRolesForm'])->name('assignroles.create');
    Route::post('assignroles', [CoordinatorController::class, 'assignRoles'])->name('assignroles.store');
    Route::get('assignroles/evaluators', [CoordinatorController::class, 'showEvaluators'])->name('assignroles.evaluators');

    Route::get('assignroles/coordinators', [CoordinatorController::class, 'showCoordinators'])->name('assignroles.coordinators');
    Route::delete('/coordinators/{id}', [App\Http\Controllers\CoordinatorController::class, 'removeCoordinator'])->name('remove.coordinator');
    Route::delete('/evaluators/{id}', [App\Http\Controllers\CoordinatorController::class, 'removeEvaluator'])->name('remove.evaluator');

    Route::view('/assignroles/index', 'assignroles.index')->name('assignroles.index');

    Route::get('/assignsupervisor/index', [SupervisorController::class, 'showAssignedGroups'])->name('assignsupervisor.index');
    Route::delete('/assignsupervisor/remove/{groupId}', [SupervisorController::class, 'removeSupervisor'])->name('assignsupervisor.remove');
    Route::get('/coordinator/proposal-reports', [UploadfilesController::class, 'viewProposalReports'])
    ->name('coordinator.proposal-reports');
    
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');

    Route::get('/evaluations/rejected', [EvaluationController::class, 'viewRejected'])->name('evaluations.rejected');
    Route::get('/evaluations/accepted', [EvaluationController::class, 'viewAccepted'])->name('evaluations.accepted');
      
    Route::get('/notification/create', [NotificationsController::class, 'create'])->name('notification.create');
    // Route::get('/notification/{notification}/edit', [NotificationsController::class, 'edit'])->name('notification.edit');
    // Route::put('/notification/{notification}', [NotificationsController::class, 'update'])->name('notification.update');
    Route::delete('/notification/{notification}', [NotificationsController::class, 'destroy'])->name('notification.destroy');


    // Route::get('/notification/index', [NotificationsController::class, 'index'])->name('notification.index');
    // Route::get('/notification/create', [NotificationsController::class, 'create'])->name('notification.create');
    // Route::post('/notification', [NotificationsController::class, 'store'])->name('notification.store');
    // Route::get('/notification/{notification}/edit', [NotificationsController::class, 'edit'])->name('notification.edit');
    // Route::put('/notification/{notification}', [NotificationsController::class, 'update'])->name('notification.update');
    // Route::delete('/notification/{notification}', [NotificationsController::class, 'destroy'])->name('notification.destroy');
    

    Route::get('/coordinator/search', [CoordinatorController::class, 'search'])->name('coordinator.search');
    


    Route::get('/Coordinator/index', function () {
        return view('Coordinator.index');
    });
});
//supervisor
Route::middleware(['auth','supervisor'])->group(function () {
    Route::get('/Supervisor/index', function () {
        return view('Supervisor.index');
    });
    Route::get('/Supervisor/assignedgroups', [SupervisorController::class, 'viewAssignedGroups'])->name('Supervisor.assignedgroups');
    Route::get('/Supervisor/assignedgroups/{groupId}/reports', 'App\Http\Controllers\SupervisorController@viewGroupReports')->name('Supervisor.assignedgroups.reports');
    Route::get('/Supervisor/assignedgroups/{groupId}/reports', [SupervisorController::class, 'viewGroupReports'])->name('Supervisor.assignedgroups.reports');
    Route::get('/supervisor/all-groups-with-reports', [SupervisorController::class, 'viewAllGroupsWithReports'])->name('Supervisor.allGroupsWithReports');
    Route::get('/supervisor/pending-files', [SupervisorController::class, 'viewPendingFiles'])->name('supervisor.pendingFiles');
    Route::put('/supervisor/accept-project/{id}', [SupervisorController::class, 'acceptProject'])->name('supervisor.acceptProject');
    Route::put('/supervisor/reject-project/{id}', [SupervisorController::class, 'rejectProject'])->name('supervisor.rejectProject');
    Route::get('/supervisor/accepted-files', [SupervisorController::class, 'viewAcceptedFiles'])->name('supervisor.acceptedFiles');
    Route::get('/supervisor/rejected-files', [SupervisorController::class, 'viewRejectedFiles'])->name('supervisor.rejectedFiles');
    Route::put('/supervisor/reject/{id}', [SupervisorController::class, 'processReject'])
    ->name('supervisor.processReject');

    Route::get('/feedback/create/{groupId}', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::get('/supervisor/level-groups/{level}', [SupervisorController::class, 'viewLevelGroupsWithReports'])->name('supervisor.levelGroups');
    Route::get('/supervisor/level-groups', [SupervisorController::class, 'viewLevelGroupsWithReports'])->name('supervisor.levelGroups');



 });
//evaluator
 Route::middleware(['auth','evaluator'])->group(function () {
     
    Route::get('/evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');


    Route::get('/Evaluator/index', function () {
        return view('Evaluator.index');
    });
 });

Route::get('/notice', function () {
    return view('notice');
});

// Route::get('/quiz', function () {
//     $categories = Category::all();
//     if ($categories){
//         return view('quiz.dashboard', compact('categories'));
//     }else{
//         abort(404);
//     }
//     // return view('quiz.dashboard');
// });

// Route::get('/quiz/{category}', function ($cname) {
//     $category = Category::where('title', 'like', $cname)->first();
//     if ($category){
//         // Get all mcq_ids that the user has answered correctly
//         $mcq_id_correct = McqResponse::where('user_id', Auth::id())
//             ->where('correct', 1)
//             ->pluck('mcq_id')
//             ->toArray();

//         // Find an MCQ in the given category that the user has not answered correctly
//         $mcq = Mcq::where('category', $category->id)
//             ->whereNotIn('id', $mcq_id_correct)
//             ->first();
//         if($mcq)
//             return view('quiz.index', compact('mcq'));
//     }else{
//         abort(404);
//     }
//     return view('quiz.index');
// });

// Route::post('/answerQuizCheck1', function (Request $request) {
//     $choice = $request['choice'];
//     $qid = $request['qid'];
//     $q = Mcq::find($qid);
//     $score = (int)$q->answer==(int)$choice?1:0;
//     $nextq = Mcq::where('id','>',$q->id)->first();
//     return response()->json(['message' => 'Data received successfully', 'score' => $score, 'nextq' => $nextq]);
// });

// Route::post('/answerQuizCheck2', function (Request $request) {
//     // Validate the incoming request
//     $request->validate([
//         'choice' => 'required|integer',
//         'qid' => 'required|integer|exists:mcqs,id',
//         'user_id' => 'required|integer|exists:users,id',
//     ]);

//     $choice = $request['choice'];
//     $qid = $request['qid'];
//     $userId = $request['user_id'];

//     // Find the question
//     $q = Mcq::find($qid);

//     // Calculate the score
//     $score = ((int)$q->answer === (int)$choice) ? 1 : 0;

//     // Save the response to the mcq_responses table
//     McqResponse::create([
//         'user_id' => $userId,
//         'mcq_id' => $qid,
//         'selected_option' => $choice,
//         'correct' => $score,
//     ]);

//     // Get the next question
//     $nextq = Mcq::where('id', '>', $q->id)->first();

//     // Return response
//     return response()->json([
//         'message' => 'Data received successfully',
//         'score' => $score,
//         'nextq' => $nextq
//     ]);
// });

// Route::post('/answerQuizCheck', function (Request $request) {
//     // Validate the incoming request
//     $request->validate([
//         'choice' => 'required|integer',
//         'qid' => 'required|integer|exists:mcqs,id',
//     ]);

//     $choice = $request['choice'];
//     $qid = $request['qid'];

//     // Find the question
//     $q = Mcq::find($qid);

//     // Calculate the score
//     $score = ((int)$q->answer === (int)$choice) ? 1 : 0;

//     // Check if the user is authenticated
//     if (Auth::check()) {
//         // Get the authenticated user's ID
//         $userId = Auth::id();

//         // Save the response to the mcq_responses table
//         McqResponse::create([
//             'user_id' => $userId,
//             'mcq_id' => $qid,
//             'selected_option' => $choice,
//             'correct' => $score,
//         ]);
//     }

//     // Get the next question
//     $nextq = Mcq::where('id', '>', $q->id)->first();

//     // Return response
//     return response()->json([
//         'message' => 'Data received successfully',
//         'score' => $score,
//         'nextq' => $nextq
//     ]);
// });

Auth::routes();

// // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', function(){
//     return redirect('/quiz');
// })->name('home');
// Route::get('/readme', function(){
//     $tutorial = \App\Models\Tutorial::find(1);
//     $tutorials = \App\Models\Tutorial::all();
//     $tutorials = \App\Models\Tutorial::where('status',1)->get();;
//     return view('readme',compact('tutorial','tutorials'));
// })->name('readme');

// Route::get('/readme/{categoryid}', function($cid){
//     //$tutorial = \App\Models\Tutorial::find(1);
//     //$tutorials = \App\Models\Tutorial::all();
//     $tutorials = \App\Models\Tutorial::where('categoryid',$cid)->get();;
//     return view('readme',compact('tutorials'));
// })->name('readme');

// Route::get('/login/google', [GoogleController::class, 'redirect']);
// Route::get('/login/google/callback', [GoogleController::class, 'login']);

