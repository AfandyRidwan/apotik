<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berobat extends Model
{
    use HasFactory;
    protected $table = 'berobat';
    protected $fillable = ['no_transaksi','pasien_id','tanggal_berobat','dokter_id','keluhan','biaya_adm'];
    protected $primaryKey = 'no_transaksi';
}
