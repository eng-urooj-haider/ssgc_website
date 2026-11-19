<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class AdminBoardOfDirector extends Model implements HasMedia
{
     use InteractsWithMedia;

    protected $fillable = ['name', 'type', 'profile' , 'picture' , 'user_id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }
}
