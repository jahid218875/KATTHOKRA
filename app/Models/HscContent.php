<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HscContent extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getSubject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function getPaper()
    {
        return $this->hasOne(Paper::class, 'id', 'paper_id');
    }

    public function getChapter()
    {
        return $this->hasOne(Chapter::class, 'id', 'chapter_id');
    }

    public function getType()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }
}
