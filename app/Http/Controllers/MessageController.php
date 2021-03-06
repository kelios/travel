<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Repositories\MessageRepository;
use Carbon\Carbon;
use App\Models\Thread;
use App\Models\Participant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

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

    public function list()
    {
        $messages = Thread::forUser(Auth::id())->latest('updated_at')
            ->with('messagesLatest', 'users')
            ->paginate(Config::get('constants.showListMessage.count'));
        return response()->json($messages);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(int $recipientId)
    {
        $thread = Thread::Between([Auth::id(), $recipientId])->first();
        if ($thread) {
            $messages = $thread->messagesLatest()->paginate(Config::get('constants.showListMessage.count'));
        } else {
            $messages = Thread::Between([Auth::id(), $recipientId])->paginate(Config::get('constants.showListMessage.count'));
        }
        // dd($thread->unreadMessageForAuthUser);
        return response()->json($messages, 200);
    }

    public function getUsers()
    {
        $thread = Thread::forUser(Auth::id())->latest('updated_at')
            ->with('users')
            ->get();
        // dd($thread[0]->unreadMessageForAuthUser);
        // $users = $thread->pluck('users')->flatten()->unique('id');
        return response()->json($thread);
    }

    /**
     * @param $idThread
     * @return \Illuminate\Http\JsonResponse
     */
    public function markUsRead($idThread)
    {
        try {
            $thread = \Cmgmyr\Messenger\Models\Thread::findOrFail($idThread);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $idThread . ' was not found.');
            return response()->json('error', '200');
        }
        $thread->markAsRead(Auth::id());
        return response()->json('ok', '200');
    }


    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'sender_id' => 'required',
            'recipient_id' => 'required',
        ]);
        $sanitized = $request->all();
        $thread = Thread::Between([Auth::id(), array_get($sanitized, 'recipient_id')])->first();
        $isNew = false;
        if (!$thread) {
            $isNew = true;
            $thread = Thread::create([
                'subject' => Auth::id() .
                    '-' . array_get($sanitized, 'recipient_id') .
                    '-' . array_get($sanitized, 'travel_id')
            ]);
        }
        //dd($thread->id);
        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $sanitized['message'],
        ]);
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();
        if ($isNew) {
            $thread->addParticipant($sanitized['recipient_id']);
        }

        // Sender
        /*    Participant::firstOrCreate([
                'thread_id' => $thread->id,
                'user_id' => Auth::id(),
                'last_read' => new Carbon,
            ]);
            $thread->addParticipant($sanitized['recipient_id']);*/


        //  $this->messageRep->fill($sanitized);
        //  $id = $this->messageRep->save();
        return ["status" => "true"];
    }

}
