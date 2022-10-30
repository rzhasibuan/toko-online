<?php

namespace App\Models\Feature;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRepley extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];

    public function chat()
    {
        return $this->belongsTo(Chat::class,'chat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
