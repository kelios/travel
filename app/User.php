<?php

namespace App;

use App\Models\Message;
use App\Models\Travel;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Brackets\Media\HasMedia\AutoProcessMediaTrait;
use \Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use \Brackets\Media\HasMedia\HasMediaThumbsTrait;
use \Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use Multicaret\Acquaintances\Status;
use Multicaret\Acquaintances\Traits\CanBeFollowed;
use Multicaret\Acquaintances\Traits\CanBeRated;
use Multicaret\Acquaintances\Traits\CanFollow;
use Multicaret\Acquaintances\Traits\CanLike;
use Multicaret\Acquaintances\Traits\CanRate;
use Multicaret\Acquaintances\Traits\Friendable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use Notifiable;

    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    use ProcessMediaTrait;

    use Friendable;
    use CanLike;
    use CanFollow, CanBeFollowed;

    use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $appends = ['resource_url', 'public_url', 'user_avatar_thumb_url', 'accepted_friends_count'];


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

        $image = $this->getMedia('userAvatar')->first();
        if ($image) {
            if (Storage::disk(config('filesystems.storageDisk'))->exists($image->getPath())) {
                Storage::disk(config('filesystems.storageDisk'))->delete($image->getPath());
            }
            $userImageThumbUrl = $image->getUrl('thumb_150');
        }
        return $userImageThumbUrl
            ?? Config::get('constants.image.defaultCatImage');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('userAvatar')
            ->maxFilesize(20 * 1024 * 1024)
            ->useDisk(config('filesystems.storageDisk'))
            ->singleFile()
            ->accepts('image/*');
    }

    public function registerMediaConversions(Media $media = null): void
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

    public function likes()
    {
        return $this->belongsToMany(Travel::class, 'travel_like', 'user_id', 'travel_id');
    }

    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }

    public function recieved()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function sent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function travelsFavorite()
    {
        return $this->belongsToMany(Travel::class, 'travel_save', 'user_id', 'travel_id')
            ->whereNull('travel_save.deleted_at');
    }

    public function travelsFriend()
    {
        return $this->belongsToMany(Travel::class, 'travel_save', 'user_id', 'travel_id');
    }

    public function getPendingFriendsCount($groupSlug = '')
    {
        $friendsCount = $this->findFriendships(Status::PENDING, $groupSlug)->count();
        return $friendsCount;
    }

    public function getAcceptedFriendsCountAttribute($groupSlug = '')
    {
        $acceptedFriendsCount = $this->getFriendRequests()->count();
        return $acceptedFriendsCount;
    }
}
