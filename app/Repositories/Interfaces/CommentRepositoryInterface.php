<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function all();

    public function fill($attr);

    public function save();

}
