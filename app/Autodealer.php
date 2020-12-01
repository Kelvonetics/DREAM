<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autodealer extends Model
{
    public $table = "autodealer";
    protected $primaryKey = 'DealerId';
}
