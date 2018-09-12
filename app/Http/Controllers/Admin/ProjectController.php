<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;


class ProjectController extends Controller
{
    public function index()
    {
    	$projects = Project::withTrashed()->get();
    	return view('admin.projects.index')->with(compact('projects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, Project::$rules, Project::$messages);
        Project::create($request->all());

        return back()->with('notification','El ciclo se ha registrado correctamente.');
    }

    public function edit($id)
    {
    	$project = Project::find($id);
    	return view('admin.projects.edit')->with(compact('project'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, Project::$rules, Project::$messages);
        Project::find($id)->update($request->all());
        return back()->with('notification','El ciclo se ha modificado correctamente.');   
    }

    public function delete($id)
    {
        Project::find($id)->delete();
        
        return back()->with('notification','El ciclo se ha eliminado correctamente.');   
    }

    public function restore($id)
    {
        Project::withTrashed()->find($id)->restore();
        
        return back()->with('notification','El ciclo se ha restaurado correctamente.');   
    }
}
