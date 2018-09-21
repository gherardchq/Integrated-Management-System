<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    //Validation
    public static $rules=[
            'category_id' => 'nullable|exists:categories,id',
            'severity' => 'required|in:M,N,A',
            'title' => 'required|min:5',
            'description' => 'required|min:5',
        ];

    public static $messages=[
            'category_id.exists' => 'No debiste meterte aquí.',
            'severity.in' => 'No debiste meterte aquí.',
            'title.required' => 'Es necesario ingresar un título para la incidencia.',
            'title.min' => 'El título debe presentar al menos 5 caracteres.',
            'description.required' => 'Es necesario ingresar una descripción para la incidencia.',
            'description.min' => 'La descripción debe presentar al menos 5 caracteres.',
        ];


    //Relationships
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function support()
    {
        return $this->belongsTo('App\User', 'support_id');
    }

    public function client()
    {
        return $this->belongsTo('App\User', 'client_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    //Accessors

    public function getSeverityFullAttribute()
    {
    	switch ($this->severity) {
    		case 'M':
    			return 'Menor';

    		case 'N':
    			return 'Normal';   			
    		
    		default:    			
    			return 'Alta';
    	}
    }

    public function getTitleShortAttribute()
    {
    	return mb_strimwidth($this->title, 0, 20, '...');
    }

    //Category_name
    public function getCategoryNameAttribute()
    {
        if ($this->category)
            return $this->category->name;

        return 'General';
    }

    //Support_name
    public function getSupportNameAttribute()
    {
        if ($this->support)
            return $this->support->name;

        return 'Sin Asignar';
    }

    //State
    public function getStateAttribute()
    {
        if ($this->active == 0)
            return 'Resuelto';

        if ($this->support_id)
            return 'Asignado';

        return 'Pendiente';
    }

}
