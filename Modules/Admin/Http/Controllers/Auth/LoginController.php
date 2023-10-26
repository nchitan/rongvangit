<?php
namespace Modules\Admin\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;

use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;

use Laravel\Fortify\Actions\PrepareAuthenticatedSession;

use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Http\Requests\LoginRequest;

use Modules\Admin\Responses\AdminLoginResponse;
use Modules\Admin\Actions\AttemptToAuthenticate;

use Illuminate\Support\Facades\Log;
use App\Models\Admin;

class LoginController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Show the login view.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {

        return view('auth.login', ['guard' => 'admin']);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(AdminLoginResponse::class);
        });
    }

    public function profile()
    {

        // return view('auth.login', ['guard' => 'admin']);
        return view('admin::admin.profile');

        
    }
    public function updatePassword(Request $request)
    {
        Log::debug($request);
       
        // Validator::make($input, [
        //     'current_password' => ['required', 'string'],
        //     'password' => $this->passwordRules(),
        // ])->after(function ($validator) use ($user, $input) {
        //     if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
        //         $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
        //     }
        // })->validateWithBag('updatePassword');

        // $user->forceFill([
        //     'password' => Hash::make($input['password']),
        // ])->save();
    }


    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        return (new Pipeline(app()))->send($request)->through(array_filter([
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }
}
