<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // Table Name
    protected $table = 'companies';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];
    
    public function employees(){
        return $this->hasMany('App\Employee');
    }
    public function countries(){
        return $this->belongsTo('App\Country');
    }
    public function showCompany()
    {
        return $this->hasOne('App\ShowCompany');
    }
}
