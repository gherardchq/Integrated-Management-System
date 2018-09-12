<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required'
    	],[
    		'name.required' => 'Es necesario ingresar un nombre para la categoría'
    	]);

    	Category::create($request->all());

    	return back();
    }
}
