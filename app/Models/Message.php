<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'client',
        'user',
        'message',
    ];

    public function post()
    {
        return $this->belongsTo(Client::class);
    }
}
