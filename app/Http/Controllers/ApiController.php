<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use App\Role;
use App\Account;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
class APIController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationFormRequest $request)
    {
        $user = new User();
        $user->customerName = $request->customerName;
        $user->accountNumber = $request->accountNumber;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        if ($this->loginAfterSignUp) {
         $account=new Account();
         $account->email= $user->email;
         $account->customerId=$user->customerId;
         $account->amount=0;
         $account->save();
       
         // Create a new Pickup entry
      $role= Role::create([
        'default' => true,
        'roleName' => '[1,2]', // you can easily assign an actual integer array here
        'statusId' => 4
    ]);
            return $this->login($request);
        }


        return response()->json([
            
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }

    public function users()
        {
            return User::all();
        }
    public function user($id)
    {
        $user=User::find($id);
       if(!$user){
        return response()->json("user does not exist");
       }
       return response()->json($user);
    }


    public function upateUsers(Request $request,$id){
        $user=User::find($id);
        $user->email =$request->email;
        $user->password =$request->password;
        $user->save();
        return $user;

    }
    public function destroy($id){
        $user = User::find($id);
        $user -> delete();
        return response()->json([]);    


    }
    public function setRoles(){
    
}
}
