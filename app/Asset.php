<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public $table = "asset";
    protected $primaryKey = 'AssetId';
}
