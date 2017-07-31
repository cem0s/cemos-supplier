<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Doctrine\ORM\EntityManager;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

     /**
     * maxLoginAttempts
     *
     * @var
     */
    protected $maxLoginAttempts;

     /**
     * lockoutTime
     *
     * @var
     */
    protected $lockoutTime;


    protected $em;
 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EntityManager $em)
    {
        $this->middleware('guest')->except('logout');
        $this->em = $em;
        $this->lockoutTime  = 1;    //lockout for 1 minute (value is in minutes)
        $this->maxLoginAttempts = 2;  //lockout after 2 attempts
    }


    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxLoginAttempts, $this->lockoutTime
        );
    }

    /**
     * This overrides the log in function from AuthenticatesUsers class. 
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $request userdata
     * @return Response
     */
    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $userRepo = $this->em->getRepository('App\Entity\Management\User');

        // 2) Check if the user has surpassed their alloed maximum of login attempts
        // We'll key this by the username and the IP address of the client making 
        // these requests into this application. 
        if ($this->hasTooManyLoginAttempts($request)) {

            return redirect()->route('login')->with('failedAttempt','You have 2 or more failed attempts. Please verify you are human.');
        }

        $credentials = $request->only('email', 'password');

        //Check the credentials if already existed in the user table
        $checkIfExists = $userRepo->checkCredentials($credentials);

        if ($checkIfExists['exist'] == "yes")
        { 
            $user = $userRepo->getUserById($checkIfExists['user_id']);

            //Add necessary data to session
            $request->session()->put('email',$credentials['email']); 
            $request->session()->put('user_id',$checkIfExists['user_id']); 
            $request->session()->put('company_id',$user->getCompanyId()); 

            //Group Id is needed to determine if the user is a supplier admin or not,
            //Group Id # 1 means supplier admi
            $request->session()->put('group_id',$user->getGroupId()); 

            //Auth login uses the user object variable.
            Auth::login($user);
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            $companyRepo = $this->em->getRepository('App\Entity\Management\Company');
            $companyCount = count($companyRepo->getAllCompany());
            $types = $companyRepo->getCompanyType($user->getCompanyId());
            $request->session()->put('company_count',$companyCount); 
            $request->session()->put('user_type',$types); 
            
            return redirect()->route('dashboard');
          
        } else if($checkIfExists['exist'] == "no") {
            $this->incrementLoginAttempts($request);
    
            return redirect()->route('login')->with('status','Sorry, no account existed with credentials provided.');
        }  else if($checkIfExists['exist'] == "not supplier"){

            return redirect()->route('login')->with('status','Sorry, you have no supplier privileges. Kindly contact the web admin for your access.');
        } else {
            
            return redirect()->route('login')->with('status','Sorry, your account needs to be activated. Please check your email for activation link.');

        }

        return redirect($this->loginPath())
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors([
                        'email' => $this->getFailedLoginMessage(),
                    ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/login';
    }

    public function logout(Request $request)
    {
        $request->session()->forget('email');
        $request->session()->flush(); 
        Auth::logout();
        return redirect()->route('login')->with('status','You have been logged out.');
    }
}
