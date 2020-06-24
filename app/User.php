<?php

namespace App;

use App\Models\Travel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Brackets\Media\HasMedia\AutoProcessMediaTrait;
use \Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use \Brackets\Media\HasMedia\HasMediaThumbsTrait;
use \Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    use ProcessMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $appends = ['resource_url', 'public_url', 'user_avatar_thumb_url'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getResourceUrlAttribute()
    {
        return url('/admin/users/' . $this->getKey());
    }

    public function travels()
    {
        return $this->belongsToMany(Travel::class);
    }

    public function getPublicUrlAttribute()
    {
        return url('/users/' . $this->getKey());
    }

    public function getUserAvatarThumbUrlAttribute(): ?string
    {

        $image = $this->getMedia('userAvatar');
        if (Arr::get($image, 0)) {
            if (Storage::disk('s3')->exists($image[0]->getPath())) {
                Storage::disk('s3')->delete($image[0]->getPath());
            }
        }

        return $this->getFirstMediaUrl('userAvatar', 'thumb_150') ?: null;
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('userAvatar')
            ->accepts('image/*');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();

        $this->addMediaConversion('thumb_75')
            ->width(75)
            ->height(75)
            ->fit('crop', 75, 75)
            ->optimize()
            ->performOnCollections('userAvatar')
            ->nonQueued();

        $this->addMediaConversion('thumb_150')
            ->width(150)
            ->height(150)
            ->fit('crop', 150, 150)
            ->optimize()
            ->performOnCollections('userAvatar')
            ->nonQueued();
    }

    /**
     * Auto register thumb overridden
     */
    public function autoRegisterThumb200()
    {

        $this->getMediaCollections()->filter->isImage()->each(function ($mediaCollection) {
            $this->addMediaConversion('thumb_200')
                ->width(200)
                ->height(200)
                ->fit('crop', 200, 200)
                ->optimize()
                ->performOnCollections($mediaCollection->getName())
                ->nonQueued();
        });
    }
}
