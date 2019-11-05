<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowEmployee extends Model
{
    // Table Name
    protected $table = 'show_employees';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable=['employee_id', 'lat', 'lng'];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
