<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Auth;
class TaskController extends Controller
{
    public function index(){
        // list all authenticated users
        return response()->json(Auth::user()->task);
    }
    public function store(Request $request){
        // Create a new task. Validate the request data and dispatch an event for task creation
        $validated = $request->validate([
            'title' => 'string',
            'description' => 'text',
            'status' => 'in:pending,in_progress,completed',
        ]);

        $validated['user_id'] = Auth::id();

        $expense = Task::create($validated);

        return response()->json($expense, 201);
    }
    public function show($id){
        // Show a specific task for the authenticated user
        $this->authorize('view', $id);
        return response()->json($id);
    }
    public function update(Request $request, $id){
        // Update a specific task. Validate the request data
        $this->authorize('update', $id);
        $validated = $request->validate([
            'title' => 'string',
            'description' => 'text',
            'status' => 'in:pending,in_progress,completed',
        ]);

        $id->update($validated);

        return response()->json($id);
    
    }
    public function destroy($id){
        // Delete a specific task
        $this->authorize('delete', $id);
        $id->delete();
        return response()->noContent();
    }
}
