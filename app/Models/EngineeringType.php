<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getSubject()
    {
        return $this->hasOne(EngineeringSubject::class, 'id', 'subject_id');
    }


    public function getChapter()
    {
        return $this->hasOne(EngineeringChapter::class, 'id', 'chapter_id');
    }
}
