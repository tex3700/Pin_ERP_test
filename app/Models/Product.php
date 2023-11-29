<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    private Builder $query;
    protected $fillable = [
        'article',
        'name',
        'status',
        'data',
    ];

    public function scopeAvailable($query): Builder
    {
        return $query->where('status', "available");
    }


}
