namespace App\Http\Controllers;

use App\Models\Mcq;
use App\Models\McqResponse;
use Illuminate\Http\Request;

class McqResponseController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'mcq_id' => 'required|exists:mcqs,id',
            'selected_option' => 'required|string',
        ]);

        $mcq = Mcq::find($validatedData['mcq_id']);
        $correct = ($mcq->answer == $validatedData['selected_option']) ? 1 : 0;

        McqResponse::create([
            'user_id' => $validatedData['user_id'],
            'mcq_id' => $validatedData['mcq_id'],
            'selected_option' => $validatedData['selected_option'],
            'correct' => $correct,
        ]);

        return response()->json(['message' => 'Response saved successfully'], 201);
    }
}