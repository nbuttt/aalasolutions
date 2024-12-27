<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        // list all authenticated users
    }
    public function store(Request $request){
        // Create a new task. Validate the request data and dispatch an event for task creation
    }
    public function show($id){
        // Show a specific task for the authenticated user
    }
    public function update(Request $request, $id){
        // Update a specific task. Validate the request data
    }
    public function destroy($id){
        // Delete a specific task
    }
}
