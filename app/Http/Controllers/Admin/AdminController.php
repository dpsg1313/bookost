<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Participation\ParticipationController;
use App\Http\Resources\ResponsibleUser;
use App\Models\Participation;
use App\Models\Responsibility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdminController extends Controller
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

    /**
     * Create a manual participation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function manual(Request $request)
    {
        return Inertia::render('Participation/Manual', []);
    }

    /**
     * Store the manually appended participation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function append(Request $request)
    {
        $data = $this->validateForCorrection($request);

        $data['user_id'] = $request->user()->id;
        $data['mode'] = 'manual';
        $participation = Participation::create($data);

        $participation->apply();
        $participation->save();
        return redirect()->route('participation.list');
    }

    private function validateForCorrection(Request $request): array{
        return $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => ['nullable', Rule::in(array_keys(ParticipationController::$Genders))],
            'stamm' => ['nullable', Rule::in(array_keys(ParticipationController::$Tribes))],
            'stufe' => ['nullable', Rule::in(array_keys(ParticipationController::$Stufen))],
            'role' => ['nullable', 'exclude_unless:stufe,leiter', Rule::in(array_keys(ParticipationController::$Roles))],
            'prevention' => ['nullable', 'exclude_unless:stufe,leiter', 'boolean'],
            'mail' => 'nullable|email|max:255',
            'insurance_person' => 'nullable|string|max:255',
            'insurance' => 'nullable|string|max:255',
            'food' => ['nullable', Rule::in(array_keys(ParticipationController::$Foods))],
            'gluten' => 'required|boolean',
            'lactose' => 'required|boolean',
            'allergies' => 'nullable|string|max:255',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:255',
            'parent_mobile' => 'nullable|string|max:255',
            'parent_address' => 'nullable|string|max:255',
            'bus_there' => 'required|boolean',
            'bus_back' => 'required|boolean',
            'travel_comment' => 'nullable|string|max:255',
            'signed_at' => 'nullable|date',
            'paid_at' => 'nullable|date',
        ]);
    }
}
