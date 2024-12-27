<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $table = 'penumpang';
    protected $primaryKey = 'id';
    protected $fillable = ['kode_booking', 'nama', 'kota', 'usia', 'tahun_lahir', 'no_telp', 'pickup_location'];
    public $timestamps = true;
}