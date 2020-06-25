<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @var Comment
     */
    private $comment;

    /**
     * CommentRepository constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return Comment[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->comment->all();
    }

    /**
     * @param $attr
     * @return Comment
     */
    public function fill($attr)
    {
        return $this->comment->fill($attr);
    }

    /**
     * @return bool
     */
    public function save()
    {
        $this->comment->save();
        return $this->comment->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function travel()
    {
        return $this->comment->travel();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->comment->user();
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function getListBy($where = [])
    {
        $comments = $this->comment;

        return $comments
            ->where($where)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(60);
    }

}
