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
    protected $with = [
        'media'
    ];

    /**
     * @inheritDoc
     */
    protected $appends = [
        'attachments_urls'
    ];

    /**
     * @inheritDoc
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }

    /**
     * An accessor to get the media urls
     *
     * @return array
     */
    public function getAttachmentsUrlsAttribute(): array
    {
        $urls = $this->media->map(fn ($item) => $item->getFullUrl())->toArray();

        unset($this->media);

        return $urls;
    }
}
