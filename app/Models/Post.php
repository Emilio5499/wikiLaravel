<?php

namespace App\Models;

use App\Models\Scopes\ApprovedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'status'];

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    protected static function booted()
    {
        static::addGlobalScope(new ApprovedScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }
}
