<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringSubject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function get_chapter()
    {
        return $this->hasMany(EngineeringChapter::class, 'subject_id', 'id');
    }
}
