<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message_recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id',
        'message_id',
     ];

    public function Recipient(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function Message(): BelongsTo {
        return $this->belongsTo(Message::class);
    }

    public function RecipientGroup(): BelongsTo {
        return $this->belongsTo(User_group::class);
    }
}
