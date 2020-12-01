<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totaldistance extends Model
{
    public $table = "totaldistance";
    protected $primaryKey = 'id';

   protected $fillable=['assetid', 'typeid', 'vehicle', 'starttime', 'stoptime','beginingmileage', 'endmileage', 'totaldistance'];
}
