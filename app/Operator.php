<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    public $table = "operator";
    protected $primaryKey = 'OperatorId';

    public function user()
    {
        return $this->belongsTo('App\Users');
    }
}