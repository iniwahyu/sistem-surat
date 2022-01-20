<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Load Library
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterRoleModel extends Model
{
    use HasFactory;
    protected $table    = 'master_role';
    protected $dates    = ['deleted_at'];
    protected $fillable = [
        'nama',
    ];
}