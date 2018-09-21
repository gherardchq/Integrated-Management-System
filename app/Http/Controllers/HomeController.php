<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\ProjectUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $selected_project_id = $user->selected_project_id;

        if($user->is_support){
            $my_incidents = Incident::where('project_id', $selected_project_id)->where('support_id', $user->id)->get();

            $projectUser = projectUser::where('project_id', $selected_project_id)->where('user_id', $user->id)->first();

            $pending_incidents = Incident::where('support_id', null)->where('level_id', $projectUser->level_id)->get(); 
        }


        $incidents_by_me = Incident::where('client_id', $user->id)->where('project_id', $selected_project_id)->get(); 

        return view('home')->with(compact('my_incidents', 'pending_incidents', 'incidents_by_me'));
    }

    public function selectProject($id)
    {
        //Validar que el usuario esté asociado con el proyecto
        $user = auth()->user();
        $user->selected_project_id = $id;
        $user->save();

        return back();
    }

    public function getReport() {
        // $project = Project::find(1);
        // $categories = $project -> categories;
        $categories = Category::where('project_id', 1)->get();
        return view('report')->with(compact('categories'));
    }

    public function postReport(Request $request) 
    {
        $rules=[
            'category_id' => 'nullable|exists:categories,id',
            'severity' => 'required|in:M,N,A',
            'title' => 'required|min:5',
            'description' => 'required|min:5',
        ];

        $messages=[
            'category_id.exists' => 'No debiste meterte aquí.',
            'severity.in' => 'No debiste meterte aquí.',
            'title.required' => 'Es necesario ingresar un título para la incidencia.',
            'title.min' => 'El título debe presentar al menos 5 caracteres.',
            'description.required' => 'Es necesario ingresar una descripción para la incidencia.',
            'description.min' => 'La descripción debe presentar al menos 5 caracteres.',
        ];

        $this->validate($request, $rules, $messages);
        
        $incident = new Incident();
        $incident->category_id = ($request->input('category_id') ?: null);
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');
        $incident->client_id = auth()->user()->id;
        $incident->save();

        return back();
    }
}