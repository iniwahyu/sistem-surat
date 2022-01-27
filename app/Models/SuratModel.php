<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Load Library
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratModel extends Model
{
    use HasFactory;
    protected $table = 'surat';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'users_id',
        'jenis_id',
        'asal_id',
        'disposisi_id',
        'kategori',
        'nomor',
        'tanggal',
        'perihal',
        'berkas',
    ];

    public static function getSurat()
    {
        // SELECT
        // s.`id`, s.`kategori`, s.`nomor`, s.`tanggal`, s.`perihal`, s.`berkas`, 
        // u.`username`, mjenis.`nama` AS nama_jenis, masal.`nama` AS nama_asal, mdisposisi.`nama` AS nama_disposisi
        // FROM surat AS s
        // JOIN users AS u ON u.`id` = s.`users_id`
        // JOIN master_jenis AS mjenis ON mjenis.`id` = s.`jenis_id`
        // JOIN master_asal AS masal ON masal.`id` = s.`asal_id`
        // LEFT JOIN master_disposisi AS mdisposisi ON mdisposisi.`id` = s.`disposisi_id`
        $query = DB::table('surat AS s');
        $query->selectRaw('s.`id`, s.`kategori`, s.`nomor`, s.`tanggal`, s.`perihal`, s.`berkas`, u.`username`, mjenis.`nama` AS nama_jenis, masal.`nama` AS nama_asal, mdisposisi.`nama` AS nama_disposisi');
        $query->join('users AS u', 'u.id', '=', 's.users_id');
        $query->join('master_jenis AS mjenis', 'mjenis.id', '=', 's.jenis_id');
        $query->join('master_asal AS masal', 'masal.id', '=', 's.asal_id');
        $query->join('master_disposisi AS mdisposisi', 'mdisposisi.id', '=', 's.disposisi_id', 'left');
        return $query;
    }
}