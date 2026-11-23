<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AdminBoardOfDirector extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $connection = 'mysql_noprefix';
    protected $fillable = ['name', 'type', 'profile', 'picture', 'user_id'];
    protected $table = "admin_board_of_directors";

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }
}
