<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\BulkDestroyComment;
use App\Http\Requests\Admin\Comment\DestroyComment;
use App\Http\Requests\Admin\Comment\IndexComment;
use App\Http\Requests\Admin\Comment\StoreComment;
use App\Http\Requests\Admin\Comment\UpdateComment;
use App\Models\Comment;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CommentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexComment $request
     * @return array|Factory|View
     */
    public function index(IndexComment $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Comment::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'travel_id', 'users_id', 'comment'],

            // set columns to searchIn
            ['id', 'comment']
        );
        $data->load('user','travel');

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.comment.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.comment.create');

        return view('admin.comment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreComment $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreComment $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Comment
        $comment = Comment::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/comments'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/comments');
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @throws AuthorizationException
     * @return void
     */
    public function show(Comment $comment)
    {
        $this->authorize('admin.comment.show', $comment);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Comment $comment)
    {
        $this->authorize('admin.comment.edit', $comment);


        return view('admin.comment.edit', [
            'comment' => $comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateComment $request
     * @param Comment $comment
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateComment $request, Comment $comment)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Comment
        $comment->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/comments'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyComment $request
     * @param Comment $comment
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyComment $request, Comment $comment)
    {
        $comment->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyComment $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyComment $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Comment::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
