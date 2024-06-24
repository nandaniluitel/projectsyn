objective is to have login
bootstrap/ui
>composer install --no-autoloader
>php artisan migrate
composer require laravel/ui will default to version 4.3 in laravel 9 that uses vite instead of webpack
>composer require laravel/ui:^3.4
[use "laravel/ui": "^3.4" in composer.json]
[you may need to use command composer update]

Now to generate Authentication scaffolding and install Bootstrap scaffolding
>php artisan ui bootstrap --auth
Check the list of files that are updated/added

>npm install
----npm audit fix --force
>npm run dev
>npm install && npm run dev
php artisan cache:clear
php artisan view:clear


>composer require laravel/socialite
---socialite5.11 for laravel 9.52.16

web.php
-------------
Route::get('/auth/redirect', [GoogleController::class, 'redirect']);
Route::get('/auth/callback', [GoogleController::class, 'login']);


php artisan make:controller GoogleController
-----------------
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function login(){
        $data = Socialite::driver('google')->user();
        $name=$data->name;
        $email=$data->email;
        $user=User::where('email',$email)->first();
        if(!$user){
            $user=User::updateOrCreate([
                'name'=>$name,
                'email'=>$email,
                'password' => ''
                ]
            );
            $user->save();
        }
        
        Auth::login($user);
        return redirect('/quiz');
    }
    
}
============
php artisan make:migration create_mcqs_table
--------
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->integer('category');
            $table->integer('sn');
            $table->text('question');
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('option3')->nullable();
            $table->string('option4')->nullable();
            $table->string('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcqs');
    }
}
-----------
php artisan make:model Mcq
php artisan make:migration create_mcq_responses_table
php artisan migrate:status
  Migration name ...................... Batch / Status  
  2014_10_12_000000_create_users_table ................................................... [1] Ran   
  2024_05_21_040605_create_mcqs_table .................................................... Pending  
  2024_05_21_041905_create_mcq_responses_table ........................................... Pending  
INSERT INTO migrations (migration, batch) VALUES ('2024_05_21_040605_create_mcqs_table', 1);
------------------
ADD COLUMN correct
$table->integer('correct')->default(0); // Column to mark if the response was correct
----------
php artisan make:migration add_correct_to_mcq_responses_table --table=mcq_responses
-----------


php artisan make:model McqResponse
---------
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mcq_id',
        'selected_option',
        'correct',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mcq()
    {
        return $this->belongsTo(Mcq::class);
    }
}
-------------

php artisan make:controller McqResponseController
--------
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
-----------


