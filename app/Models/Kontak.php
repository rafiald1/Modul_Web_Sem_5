<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Kontak extends Model
{
use HasFactory;

/**
* fillable
*
* @var array
*/
protected $fillable = [
    'nama',
    'email',
    'telepon',
    'pesan',

    ];
}