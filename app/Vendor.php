<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public $table = "vendor";
    protected $primaryKey = 'VendorId';
}
