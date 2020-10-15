<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

/**
 * Class MessageController
 * @package App\Http\Controllers
 */
class MessageController extends Controller
{

    /**
     * @var MessageRepository
     */
    protected $messageRep;

    public function __construct(MessageRepository $messageRep)
    {
        $this->messageRep = $messageRep;
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
        $messages = $this->messageRep->getListBy($where);
        return response()->json($messages);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($recipientId)
    {
        $messages = \Illuminate\Support\Facades\Auth::user()->sent()->where('recipient_id', $recipientId);
        return response()->json($messages, 200);
    }


    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'messages' => 'required',
            'sender_id' => 'required',
            'recipient_id' => 'required',
        ]);
        $sanitized = $request->all();

        $this->messageRep->fill($sanitized);
        $id = $this->messageRep->save();
        return ["status" => "true", "messageId" => $id];
    }

}
