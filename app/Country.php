<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Table Name
    protected $table = 'countries';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'country','latitude','longitude','name',
    ];

    public function employees(){
        return $this->hasMany('App\Employee');
    }

    public function countries(){
        return $this->hasMany('App\Country');
    }
}
