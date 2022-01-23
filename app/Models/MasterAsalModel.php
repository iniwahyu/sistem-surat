<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Load Library
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterAsalModel extends Model
{
    use HasFactory;
    protected $table = 'master_asal';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nama',
    ];
}