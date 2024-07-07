<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\Task as TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data=$request->all();
        $data['user_id']=auth()->id();
        Task::create($data);
        return response()->json(['status'=>true,
                                 "messsage"=>"Inserted Successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json(['status'=>true,
                                 "data"=>$task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        try{
            $task->update($request->all());
            return response()->json(['status'=>true,
                                     "messsage"=>"Updated Successfully"]);
        }catch(\Exception $e)
        {
            return response()->json(['status'=>false,
                                 "messsage"=>$e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try{
        $task->delete();
        return response()->json(['status'=>true,
                                 "messsage"=>"Deleted Successfully"]);
        }catch(\Exception $e)
        {
            return response()->json(['status'=>false,
                                    "messsage"=>$e->getMessage()]);
        }
    }
    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'status' => 'required|in:pending,in_progress,completed'
        ]);
        $task=Task::find($request->task_id);
        $task->status=$request->status;
        $task->save();
        return response()->json(['status'=>true,
                                 "messsage"=>"Updated Successfully"]);
    }
}
