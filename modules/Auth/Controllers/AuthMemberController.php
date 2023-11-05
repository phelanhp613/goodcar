<?php

namespace Modules\Auth\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Auth\Requests\AuthMemberRequest;
use Modules\Base\Models\Status;
use Modules\Member\Models\Member;
use Modules\User\Models\User;

class AuthMemberController extends Controller {

    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->auth = Auth::guard('web');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|string
     */
    public function login(Request $request) {
        if ($request->post()) {
            $credentials               = $request->only('email', 'password');
            $credentials['deleted_at'] = null;

            if ($this->auth->attempt($credentials, $request->has('remember_me'))) {
                if ($this->auth->user()->status != Status::STATUS_ACTIVE) {
                    $request->session()->flash('danger',
                        trans('Your account is inactive. Please contact with admin page to get more information.'));
                    $this->auth->logout();
                } else {
                    $request->session()->flash('success', trans('Logged In Successfully!'));
                }
            } else {
                $request->session()->flash('danger', trans('Incorrect username or password'));
            }

            return redirect()->back();
        }

        return view('Frontend::modal.login')->render();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request) {
        $this->auth->logout();
        $request->session()->flash('success', trans('Logged Out Successfully!'));

        return redirect()->route('get.home.index');
    }


    /**
     * @param Request $request
     * @return RedirectResponse|string
     */
    public function forgotPassword(Request $request) {
        if ($request->post()) {
            $member = Member::query()->where('email', $request->email)->first();
            if (!empty($member)) {
                $password = Str::random(6);
                $body     = '';
                $body     .= "<div><p>" . trans("Your password: ") . $password . "</p></div>";
                $body     .= '<div><i><p style="color: red">' . trans("You should change password after login.") . '</p></i></div>';
                $send     = Helper::sendMail($member->email, trans('Reset password'), trans('Reset password'), $body);
                if ($send) {
                    $member->password = $password;
                    $member->save();
                    $request->session()->flash('success', trans('Send email successfully. Please check your email'));
                } else {
                    $request->session()->flash('danger', trans('Can not send email. Please contact with admin.'));
                }
            } else {
                $request->session()->flash('danger', trans('Your email not exist.'));
            }

            return redirect()->back();
        }

        return view('Frontend::modal.forgot_password')->render();
    }


    /**
     * @return Factory|View|RedirectResponse
     */
    public function getRegister() {
        if ($this->auth->check()) {
            return redirect()->route('get.home.index');
        }
        return view('Frontend::register');
    }

    /**
     * @param AuthMemberRequest $request
     * @return RedirectResponse
     */
    public function postRegister(AuthMemberRequest $request) {
        $data           = new Member($request->all());
        $data->username = Str::random(8);
        $data->save();
        $this->auth->attempt(['email' => $request->email, 'password' => $request->password]);

        $request->session()->flash('success', 'Registered Successfully');


        return redirect()->route('get.home.index');
    }
}
