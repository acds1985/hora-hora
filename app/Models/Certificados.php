<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Certificados extends Model
{
    use HasFactory;


    protected $fillable = [
    
        'titulo',
        'horas',
        'user_id',
        'tipo',
        'path',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
