<?php

namespace App\Repositories;

use App\User;
use App\Models\Travel;
use App\Repositories\Interfaces\TravelRelationRepositoryInterface;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements TravelRelationRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Month[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->user->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->user->find($id);
    }

    /**
     * @param $attr
     * @return Month
     */
    public function fill($attr)
    {
        return $this->user->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->user->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function travels()
    {
        return $this->user->travels();
    }

    public function sendMessageTo($recipient, $message, $subject)
    {
        return $this->user->sent()->create([
            'body' => $message,
            'subject' => $subject,
            'sent_to_id' => $recipient,
        ]);
    }

}
