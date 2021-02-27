<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SentMails extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'email',
        'subject',
        'body'
    ];

    /**
     * @inheritDoc
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }
}
