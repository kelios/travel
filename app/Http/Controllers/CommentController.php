<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Auth;

class CommentController extends Controller
{

    protected $commentRep;

    public function __construct(CommentRepository $commentRep)
    {
        $this->commentRep = $commentRep;
    }

    /**
     *  Get Comments for pageId
     *
     * @return Comments
     */

    public function index($travel_id)
    {
        $where = [
            'travel_id' => $travel_id,
            'reply_id' => null
        ];
        $comments = $this->commentRep->getListBy($where);
        return response()->json($comments);
    }


    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',
            'travel_id' => 'required',
            'users_id' => 'required',
        ]);
        $sanitized = $request->all();

        $this->commentRep->fill($sanitized);
        $id = $this->commentRep->save();
        return ["status" => "true", "commentId" => $id];
    }

}
