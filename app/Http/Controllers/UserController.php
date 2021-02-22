<?php

namespace App\Http\Controllers;

use App\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\User\UpdateUser;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRep;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRep)
    {
        $this->userRep = $userRep;
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * @param User $user
     * @return Factory|View
     */
    public function allFriends(User $user)
    {

        return view('users.allFriends', [
            'user' => $user,

        ]);
    }

    /**
     * @param User $user
     * @return Factory|View
     */
    public function allMessages(User $user)
    {

        return view('users.allMessages', [
            'user' => $user,

        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUser $request
     * @param User $user
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateUser $request, User $user)
    {

        // Sanitize input
        $sanitized = $request->getModifiedData();

        // Update changed values User
        $user->update($sanitized);
        if ($request->ajax()) {
            return [
                'redirect' => url('travels'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('/travels');
    }

    public function getAllUsers(Request $request)
    {
        $users = $this->userRep->all();
        return response()->json($users, 200);
    }


}
