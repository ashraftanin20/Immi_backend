<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'post_body',
        'send_id',
        'category_id',
    ];

    public function user(): BelongsTo {
        $this->belongsTo(User::class);
    }
    public function category(): BelongsTo {
        $this->belongsTo(Category::class);
    }

}
