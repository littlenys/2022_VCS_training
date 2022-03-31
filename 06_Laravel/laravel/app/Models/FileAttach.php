<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileAttach extends Model
{
    use HasFactory;
    protected $fillable = [
        'part',
        'partid',
        'tenfile',
        'url'];
}
