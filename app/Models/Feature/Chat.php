<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function replay()
    {
        return $this->hasMany(ChatRepley::class, 'chat_id');
    }
}
