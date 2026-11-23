<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $connection = 'mysql';   // your prefixed connection
    protected $table = 'media';
}
