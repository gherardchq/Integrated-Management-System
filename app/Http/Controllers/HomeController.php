<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Incident;

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
        return view('home');
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