<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getSubject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject');
    }

    public function getPaper()
    {
        return $this->hasOne(Paper::class, 'id', 'paper');
    }

    public function getChapter()
    {
        return $this->hasOne(Chapter::class, 'id', 'chapter');
    }

    public function getType()
    {
        return $this->hasOne(Type::class, 'id', 'type');
    }
}
