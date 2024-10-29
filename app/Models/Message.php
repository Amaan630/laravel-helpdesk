<?php

namespace App\Models;

use App\Traits\UsesUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use UsesUuidKey;
    use SoftDeletes;

    protected $fillable = ['user_uuid', 'content', 'reactions', 'is_from_user', 'read_at', 'src_url'];

    protected $casts = [
        'reactions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
