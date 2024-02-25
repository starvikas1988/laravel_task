<?php

use App\Models\Task;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


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

// class Task
// {
//     public int $id;
//     public string $title;
//     public string $description;
//     public ?string $long_description;
//     public bool $completed;
//     public string $created_at;
//     public string $updated_at;

//     public function __construct(
//         int $id,
//         string $title,
//         string $description,
//         ?string $long_description,
//         bool $completed,
//         string $created_at,
//         string $updated_at
//     ) {
//         $this->id = $id;
//         $this->title = $title;
//         $this->description = $description;
//         $this->long_description = $long_description;
//         $this->completed = $completed;
//         $this->created_at = $created_at;
//         $this->updated_at = $updated_at;
//     }
// }



// $tasks = [
//     new Task(
//         1,
//         'Buy groceries',
//         'Task 1 description',
//         'Task 1 long description',
//         false,
//         '2023-03-01 12:00:00',
//         '2023-03-01 12:00:00'
//     ),
//     new Task(
//         2,
//         'Sell old stuff',
//         'Task 2 description',
//         null,
//         false,
//         '2023-03-02 12:00:00',
//         '2023-03-02 12:00:00'
//     ),
//     new Task(
//         3,
//         'Learn programming',
//         'Task 3 description',
//         'Task 3 long description',
//         true,
//         '2023-03-03 12:00:00',
//         '2023-03-03 12:00:00'
//     ),
//     new Task(
//         4,
//         'Take dogs for a walk',
//         'Task 4 description',
//         null,
//         false,
//         '2023-03-04 12:00:00',
//         '2023-03-04 12:00:00'
//     ),
// ];

// Route::get('/task', function () use ($tasks) {
//     return view('index', [
//         'tasks' => $tasks
//     ]);
// })->name('tasks.index');

Route::get('/task', function (){
    return view('index', [
        //'tasks' => \App\Models\Task::latest()->get()
       // 'tasks' => \App\Models\Task::latest()->where('completed',true)->get()
       'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

// Route::get('/task/{id}', function ($id) {
//     return 'One single task';
// })->name('tasks.show');

Route::get('/task/{id}', function ($id) {
    return view('show', [
        'task' => \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.show');

Route::get('/tasks/{id}/edit', function ($id) {
    return view('edit', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.edit');

//Route::delete('/tasks/{id}', 'TaskController@destroy')->name('tasks.destroy');

Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');


Route::view('/tasks/create','create')->name('tasks.create');

Route:: post('/tasks',function(Request $request){
    //dd($request->all());
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show',['id' => $task->id])->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{id}', function ($id, Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task updated successfully!');
       // return redirect()->back()->with('success', 'Task updated successfully!');    
})->name('tasks.update');

// {{-- second way to use model and route|| all above routes are the first way to do the same task without using model directly.In second case we don't have to use the request object and pass the id in the callback function only the model instance will do the job --}}
Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

