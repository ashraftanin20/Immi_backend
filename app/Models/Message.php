<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message_body',
        'sender_id'
     ];

    public function sender(): BelongsTo {
        $this->belongsTo(User::class);
    }

}
