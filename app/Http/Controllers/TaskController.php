<?php

namespace App\Http\Controllers;

use App\Models\Orgtask;
use App\Models\Task;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function tasks()
    {
        $activeTasks = Task::where('creator_id', Auth::user()->id)
            ->where(DB::raw('CAST(execution_date AS DATE)'), '=', DB::raw('CURDATE()'))
            ->where('completed', '=', false)
            ->get();
        $upcomingTasks = Task::where('creator_id', Auth::user()->id)
            ->where(DB::raw('CAST(execution_date AS DATE)'), '>', DB::raw('CURDATE()'))
            ->where('completed', '=', false)
            ->get();
        $completedTasks = Task::where('creator_id', Auth::user()->id)
            ->where('completed', true)
            ->get();
        $previousTasks = Task::where('creator_id', Auth::user()->id)
            ->where(DB::raw('CAST(execution_date AS DATE)'), '<', DB::raw('CURDATE()'))
            ->where('completed', '=', false)
            ->get();


        return view('tasks.tasklist')
            ->with('activeTasks', $activeTasks)
            ->with('upcomingTasks', $upcomingTasks)
            ->with('completedTasks', $completedTasks)
            ->with('previousTasks', $previousTasks);
    } 

    public function orgTasks()
    {
        $orgTable = Orgtask::where('creator_id', Auth::user()->id)
            ->where('completed', '=', false)
            ->get();

        $completedTasks = Orgtask::where('creator_id', Auth::user()->id)
            ->where('completed', '=', true)
            ->get();
        return view('tasks.org')
            ->with('orgTable', $orgTable)
            ->with('completedTasks', $completedTasks);
    }

    
    public function addTableOrg(Request $req)
    {
        $req->validate([
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $origin = new DateTime($req->start_date);
        $target = new DateTime($req->end_date);
        $interval = $origin->diff($target);

        for ($i = 0; $i <= $interval->days; $i++) {
            $orgTask = new Orgtask();
            $orgTask->date = $origin->format('Y-m-d');
            $orgTask->creator_id = Auth::user()->id;
            $orgTask->activity = "";
            $orgTask->description = "";
            $orgTask->completed = false;
            $orgTask->save();
            $origin->modify('+1 day');
        }

        return redirect('/orgTasks')->with('success', 'Table added successfully!');
    }

    public function editTableTask(Request $req)
    {
        $req->validate([
            'date' => 'required',
            'activity' => 'required',
            'description' => 'required',
            'severity' => 'required'
        ]);

        Orgtask::where('date', $req->date)
            ->update(
                [
                    'activity' => $req->activity,
                    'description' => $req->description,
                    'severity' => $req->severity
                ]
            );

        redirect('/orgTasks')->with('success', 'Table updated successfully!');
    }

    public function completeTaskOrg(Request $req)
    {
        Orgtask::where('date', $req->task_id)
            ->update(
                [
                    'completed' => true,
                ]
            );

        return redirect('/orgTasks')->with('success', 'Task completed successfully!');
    }

    public function addTask(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'execution_date' => 'required',
            'execution_time' => 'required'
        ]);

        $task = new Task();
        $task->title = $req->title;
        $task->description = $req->description;
        $task->execution_date = $req->execution_date;
        $task->execution_time = $req->execution_time;
        $task->type = $req->type;
        $task->creator_id = Auth::user()->id;
        $task->save();

        return redirect('/tasks')->with('success', 'Task added successfully!');
    }

    public function completeTask(Request $req)
    {
        $task = Task::find($req->task_id);
        $task->completed = true;
        $task->save();

        return redirect('/tasks')->with('success', 'Task completed successfully!');
    }

    public function completedTask()
    {
        $completedTasks = Task::where('creator_id', Auth::user()->id)
            ->where('completed', true)
            ->get();
        return view('tasks.completedtasklist')
            ->with('completedTasks', $completedTasks);
    }
}