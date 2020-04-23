<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
   // use HasSlug;
    protected $fillable = [
        'user_id', 'name', 'description','phone','mobile_phone','logo','slug'
    ];
/*
 public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
*/
public function user()
{
    return $this->belongsTo(User::class);
}


public function products()
{
    return $this->hasMany(Product::class);
}
}