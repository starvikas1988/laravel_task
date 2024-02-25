<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function destroy($id)
    {
        // Find the task by ID
        $task = Task::findOrFail($id);
        
        // Delete the task
        $task->delete();

        // Redirect to a route or return a response
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
