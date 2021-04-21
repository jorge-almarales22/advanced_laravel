<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        // 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // protected static function booted()
    // {
    //     static::creating(function (Post $post) {
    //         $faker = \Faker\Factory::create();
    //         $post->avatar = $faker->imageUrl();
    //         $post->user()->associate(auth()->user());
    //     });
    // }

    protected static function booted()
    {
        static::creating(function (Post $post) {
            $faker = \Faker\Factory::create();
            $post->avatar = $faker->imageUrl();
        });
    }
}
