<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumUser extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];

    public function courses()
    {
        return $this->hasMany(PremiumCourses::class, 'order_id', 'order_id');
    }


    // public function sub()
    // {
    //     return $this->hasMany(Subscription::class, 'id', 'course');
    // }
}
