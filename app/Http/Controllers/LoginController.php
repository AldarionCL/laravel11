<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function authenticated(Request $request)
    {

        $credentials = $request->validate([
            'id' => ['required'],
            'token' => ['required']
        ]);

        if ($credentials) {
            $request->session()->invalidate();

            if (isset($request->call)) {
                session()->put('call', 1);

            } elseif (isset($request->oc)) {

                session()->put('call', 2);

            } elseif (isset($request->accessory)) {

                session()->put('call', 3);

            } elseif (isset($request->operation)) {

                session()->put('call', 4);
            } elseif (isset($request->lead)) {
                session()->put('call', 5);
            }elseif (isset($request->rec)) {
                session()->put('call', 6);
            }elseif (isset($request->dyp)) {
                session()->put('call', 7);
            }elseif (isset($request->cpd)) {
                session()->put('call', 8);
            }elseif (isset($request->tdrive)) {
                session()->put('call', 9);
            } else {
                session()->put('call', 0);
            }

            if ($request->token !== "6461433ef90325a215111f2af1464b2d09f2ba23") {
                Log::info('Token incorrecto');
                return Redirect::away(env('APP_URL'));
            }


            if (Auth::loginUsingId($request->id)) {

                $request->session()->regenerate();

                if (session()->get('call') === 0 || session()->get('call') === 2) {
                    return redirect()->intended('/ticket');

                } elseif (session()->get('call') === 3) {
                    return redirect()->intended('/accesorios');
                } elseif (session()->get('call') === 4) {
                    return redirect()->intended('/operaciones');
                } elseif (session()->get('call') === 5) {
                    return redirect()->intended('/landbot/' . $request->idLead);
                }elseif (session()->get('call') === 6) {
                    return redirect()->intended('/recepcion');
                }elseif (session()->get('call') === 7) {
                    return redirect()->intended('/dyp');
                }elseif (session()->get('call') === 8) {
                    return redirect()->intended('/cpd');
                }elseif (session()->get('call') === 9) {
                    return redirect()->intended('/tdrive');
                } else {
                    return redirect()->intended('/call-center');
                }
            }

            return Redirect::away(route('dashboard'));
        }else{
            return Redirect(route('login'));
        }

    }
}
