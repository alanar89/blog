<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['mensaje', 'nombre', 'email'];

    public function posts(): BelongsTo
    {
        return $this->BelongsTo(Post::class);
    }
}