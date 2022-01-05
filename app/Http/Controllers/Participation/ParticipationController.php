<?php

namespace App\Http\Controllers\Participation;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class ParticipationController extends Controller
{
    /**
     * Display list of participations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function list(Request $request)
    {
        return Inertia::render('Participation/ListParticipations', [
            'participations' => $request->user()->participations()->get()
        ]);
    }

    /**
     * Create a new participation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Booking/NewBooking', [

        ]);
    }

    /**
     * Store the participation data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthday' => 'required|date',
            'stamm' => 'required',
        ]);

        $data['user_id'] = $request->user()->id;
        $participant = Participant::create($data);

        return redirect()->route('participation.list');
    }

    /**
     * Show finish form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function finish(Request $request)
    {
        return Inertia::render('Participation/FinishParticipation', [

        ]);
    }

    /**
     * Send participation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'participation_id' => ['required', 'exists:participants,id'],
        ]);

        /** @var Participant $participant */
        $participant = Participant::findOrFail($data['participation_id']);

        $participant->apply();
        $participant->save();

        return redirect()->route('participation.print');
    }

    /**
     * Show finish form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function print(Request $request)
    {
        return Inertia::render('Participation/Print', [

        ]);
    }
}
