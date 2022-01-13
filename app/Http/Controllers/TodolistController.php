<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{

    public function index()
    {
        $todolists = Todolist::all();
        return view("/tasks", compact('todolists'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'content'=>'required'
        ]);
        Todolist::creat($data);
        return back();
    }


    public function destroy(Todolist $todolist)
    {
        $todolist->delete();
        return back();
    }
}
