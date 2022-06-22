<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Participation\ParticipationController;
use App\Http\Resources\ResponsibleUser;
use App\Models\Responsibility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{

    /**
     * Display list of users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function listUsers(Request $request)
    {
        $sortColumn = $request->query->get('sort', 'name');
        $sortDesc = $request->query->getBoolean('desc', false);

        $query = User::query();
        $query = $query->whereNotNull('email_verified_at');
        $query = $query->orderBy($sortColumn, $sortDesc ? 'desc' : 'asc');

        ResponsibleUser::withoutWrapping();
        return Inertia::render('Admin/Responsibles', [
            'users' => ResponsibleUser::collection($query->get()),
            'tribes' => ParticipationController::$Tribes,
            'sortColumn' => $sortColumn,
            'sortDesc' => $sortDesc,
        ]);
    }

    /**
     * Save responsibility for user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function saveUserResponsibility(Request $request, User $user)
    {
        $data = $request->validate([
            'group' => Rule::in(array_merge(['none', 1313], array_keys(ParticipationController::$Tribes))),
            'readonly' => 'boolean',
        ]);
        $group = $data['group'];
        $readonly = $data['readonly'];

        if($group == 'none'){
            $user->responsibilities()->delete();
        }else{
            if($user->responsibilities()->count()) {
                $responsibility = $user->responsibilities()->first();
                $responsibility->group = $group;
                $responsibility->readonly = $readonly;
                $responsibility->save();
            }else{
                $responsibility = new Responsibility();
                $responsibility->group = $group;
                $responsibility->readonly = $readonly;
                $user->responsibilities()->save($responsibility);
            }
        }

        return redirect()->route('admin.user.list');
    }
}
