<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Load Library
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    use HasFactory;
    protected $table    = 'users';
    protected $dates    = ['deleted_at'];
    protected $fillable = [
        'username',
        'password',
        'role_id',
        'last_login',
    ];

    public static function getUsersWithRole()   
    {
        // SELECT
        // u.`id`, u.`username`, mrole.`nama` AS nama_role, u.`last_login`
        // FROM users AS u
        // JOIN master_role AS mrole ON mrole.`id` = u.`role_id`
        $query = DB::table('users AS u');
        $query->selectRaw('u.`id`, u.`username`, mrole.`nama` AS nama_role, u.`last_login`');
        $query->join('master_role AS mrole', 'mrole.id', '=', 'u.role_id');
        return $query;
    }
}