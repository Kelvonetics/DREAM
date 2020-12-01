<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $table = "invoice";
    protected $primaryKey = 'InvoiceId';
}
