<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoveltyPart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function novelty()
    {
        return $this->belongsTo('App\Models\Novelty');
    }
}
