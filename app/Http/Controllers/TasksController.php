<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Goal;
use Illuminate\Database\ConnectionResolverInterface;

class TasksController extends Controller
{
    protected function showTasks($arrTasks)
    {
        $json = response()->json($arrTasks);

        return view('/tasks')->with(['arrTasks'=> $arrTasks, 'json'=>$json]);
    }

    protected function getTasks()
    {

        $rezult = Goal::select('id', 'task', 'done')->get()->toArray();

        return $rezult;

    }

    public function index(Request $request)
    {
        $arrTasks = $this->getTasks();
        return $this->showTasks($arrTasks);
    }
    public function getTask(Request $request)
    {
        $arrTasks = $this->getTasks();
        return response()->json($arrTasks);
    }

    public function store(Request $request)
    {

        $action = $request->input('action');
        $id = $request->input('id');

        if ($action == "add") {

            $request->validate([
                'task' => 'required',
            ]);
            $goal = new Goal($request->all());
            $goal->save();

        } else if ($action == "update") {
            $goal = Goal::find($id);
            $goal->done = $request->input('done');
            $goal->save();
        } else if ($action == "delete") {
            $goal = Goal::find($id);
            $goal->delete();
        }
        $arrTasks = $this->getTasks();
        return response()->json($arrTasks);
    }
}
