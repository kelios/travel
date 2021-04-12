<?php

namespace App\Repositories;

use App\Models\Message;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class MessageRepository implements CommentRepositoryInterface
{
    /**
     * @var Message
     */
    private $message;

    /**
     * CommentRepository constructor.
     * @param Comment $comment
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return Comment[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->message->all();
    }

    /**
     * @param array $param
     * @return mixed
     */
    public function get($param = [])
    {
        return $this->message->get($param);
    }

    /**
     * @param $attr
     * @return Comment
     */
    public function fill($attr)
    {
        return $this->message->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        $this->message->save();
        return $this->message->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function travel()
    {
        return $this->message->travel();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->message->sender();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->message->sender();
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function getListBy($where = [])
    {
        $comments = $this->message;

        return $comments
            ->with('sender', 'recipient')
            ->where($where)
            ->orderBy('created_at', 'desc')
            ->paginate(60);
    }

}
