<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use App\Models\UserEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function loggedIn()
    {
        return view('logged_in', [
            'emails' => Email::orderBy('date', 'desc')
                ->whereIn('recipient',
                    UserEmail::where('user_id', Auth::user()->id)->pluck('email')->toArray())
                ->simplePaginate(6),
        ]);
    }

    public function lastEmailId(Request $request)
    {
        if(!$request->ajax()) return redirect()->route('profiles.logged_in');

        $email = Email::orderBy('id', 'desc')
            ->whereIn('recipient',
                UserEmail::where('user_id', Auth::user()->id)->pluck('email')->toArray())
            ->first();

        return $email ? $email->id : -99999;
    }

    public function listOfEmails()
    {
        return view('list_of_emails', [
            'emails' => UserEmail::where('user_id', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->simplePaginate(25),
        ]);
    }

    public function showEmail(Email $email)
    {
        if (UserEmail::where([
            'user_id' => Auth::user()->id,
            'email' => $email->recipient
        ])->exists()) {
            return $email->body;
        }
    }

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse|RedirectResponse
     */
    public function show(Request $request, User $user)
    {
        if(!$request->ajax()) return redirect()->route('profiles.logged_in');

        list($limitReached, $email) = generateEmail(Auth::user());

        $data = [
            'first_name' => 'Dick',
            'last_name' => 'Dickson',
            'username' => generateWords(),
            'password' => generatePassword(),
            'email' => $email,
            'fields' => [
                'username' => ['username', 'name', 'user', 'usr', 'acct'],
                'password' => ['password', 'pass', 'psw', 'pw', 'passwd'],
                'email' => ['email', 'mail', 'e-mail'],
                'first_name' => ['first_name', 'firstname'],
                'last_name' => ['last_name', 'lastname'],
            ],
            'limitReached' => $limitReached,
        ];
        return response()->json($data);
    }

    /**
     * @throws \Exception
     */
    public function deleteEmailAddress(UserEmail $userEmail)
    {
        if ($userEmail->user_id === Auth::user()->id) {
            $userEmail->delete();
        }
        return redirect(route('profiles.list_of_emails'));
    }

    /**
     * @throws \Exception
     */
    public function deleteEmail(Email $email)
    {
        if (UserEmail::where([
            'email' => $email->recipient,
            'user_id' => Auth::user()->id
        ])->exists()) {
            $email->delete();
        }

        return redirect(route('profiles.logged_in'));
    }
}
