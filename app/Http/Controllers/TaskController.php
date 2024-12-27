<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
// use Auth;
class TaskController extends Controller
{
    public function index(){
        // list all authenticated users
        // return response()->json(User::all()->where('id',Auth::user()->id)->with('tasks')->get());
        return response()->json(User::where('id',2)->with('tasks')->get());
    }
    public function store(Request $request){
        // Create a new task. Validate the request data and dispatch an event for task creation
    
        $validated = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'status' => 'in:pending,in_progress,completed',
        ]);

        $validated['user_id'] = 2;

        $task = Task::create($validated);

        return response()->json($task);
    }
    public function show($id){
        // Show a specific task for the authenticated user
        // $this->authorize('view', $id);
        return response()->json(Task::all()->where('id' , $id)->where('user_id' , 2 ));
    }
    public function update(Request $request, $id){
        // Update a specific task. Validate the request data
        // $this->authorize('update', arguments: $id);
        $validated = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'status' => 'in:pending,in_progress,completed',
        ]);

        Task::where('id', $id)
       ->update([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
        ]);

        return response()->json(Task::find($id));
    
    }
    public function destroy($id){
        // Delete a specific task
        // $this->authorize('delete', $id);
        Task::find($id)->delete();
        return response()->noContent();
    }
}
