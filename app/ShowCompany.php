<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowCompany extends Model
{
    // Table Name
    protected $table = 'show_companies';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable=['name', 'lat', 'lng'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

}
