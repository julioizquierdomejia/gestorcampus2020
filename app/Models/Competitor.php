<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
        'competitor_type_id'
    ];

    public function type(){
        return $this->hasOne(CompetitorType::class, 'id', 'competitor_type_id');
    }
    public function user(){
        return $this->hasOne(UserMoodle::class, 'id', 'user_id');
    }
}
