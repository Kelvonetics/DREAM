<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public $table = "budgets";
    protected $primaryKey = 'id';

    protected $fillable=['zip','month','lodging','meal', 'housing', 'plate'];
}
