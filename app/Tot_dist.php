<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tot_dist extends Model
{
    public $table = "tot_dist";
    protected $primaryKey = 'id';

   protected $fillable=['assetid', 'typeid', 'vehicle', 'starttime', 'stoptime','beginingmileage', 'endmileage', 'totaldistance'];
}
