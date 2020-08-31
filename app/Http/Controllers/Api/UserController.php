<?php

namespace App\Http\Controllers\Api;

use Image;
use JWTAuth;
use App\UserApi;
use App\Password_reset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\MailRepository as MailInterface;

class UserController extends Controller
{
    public function index()
    {
        $getAllUsers = UserApi::all();
        $data = [
            "response" => [
                "status" => true,
                "data" => $getAllUsers,
                "message" => "Data Users",
            ],
            "code" => 200
        ];
        return response()->json($data['response'], $data['code']);
    }

    public function show($id)
    {
        $getUsers = UserApi::find($id);
        $data = [
            "response" => [
                "status" => true,
                "data" => $getUsers,
                "message" => "Data Users",
            ],
            "code" => 200
        ];
        return response()->json($data['response'], $data['code']);
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string:50',
            'password' => 'required|string|min:6',
        ]);
        
        if($validator->fails()){
            $message = $validator->errors()->toArray();
            $code = 400;
            $error = true;
        }
        $getUser = UserApi::where('nip',$request->nip)->first();
        // dd($getUser);

        if ($getUser) {
            if (password_verify($request->password, $getUser['password'])) {
                try {
                    $token = JWTAuth::fromUser($getUser);
                    $error = false;
                } catch (JWTException $e) {
                    $message = 'could_not_create_token';
                    $code = 400;
                    $error = true;
                }
            }else{
                $message = 'Password Salah';
                $code = 400;
                $error = true;
            }
        }else{
            $message = 'Usernmae Salah';
            $code = 400;
            $error = true;
        }        

        if ($error) {
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $message,
                ],
                "code" => $code
            ];
        }else{
            $data = [
                "response" => [
                    "status" => true,
                    "data" => $getUser,
                    "message" => "Berhasil Login",
                    "token" => $token,
                ],
                "code" => 200
            ];
        }
        return response()->json($data['response'], $data['code']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:100',
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|string|min:7',
            'email' => 'required|string|email|max:150|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        if($validator->fails()){
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $validator->errors()->toArray()
                ],
                "code" => 400
            ];
        }else{
            $token = uniqid();
            $user = UserApi::create([
                'nip' => $request->get('nip'),
                'nama' => $request->get('nama'),
                'email' => $request->get('email'),
                'no_hp' => $request->get('no_hp'),
                'is_admin' => 0,
                'remember_token' => $token,
                'password' => Hash::make($request->get('password')),
            ]);
            // $VerfiyEmail = [
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'token' => $user->remember_token,
            //     'subject' => 'Verfikasi Akun',
            //     'view' => 'send.verify'
            // ];
            // $message =  MailInterface::sendMail($VerfiyEmail);
            $data = [
                "response" => [
                    "status" => true,
                    "data" => $user,
                    "message" => "Berhasil Membuat Akun",
                ],
                "code" => 201
            ];
        }
        return response()->json($data['response'], $data['code']);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function verfiyEmail($token)
    {
       $verfiyEmail = Password_reset::where('remember_token' , $token)->get();
       if (!$verfiyEmail->isEmpty()) {
           UserApi::where('remember_token', $token)
            ->update([
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
            $data = [
                "response" => [
                    "status" => true,
                    "data" => null,
                    "message" => "Account Verfiy Success"
                ],
                "code" => 200
            ];
        }else{
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => "Token Valid"
                ],
                "code" => 500
            ];
        }
    
        return response()->json($data['response'], $data['code']);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if($validator->fails()){
            $message = $validator->errors()->toArray();
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $message,
                ],
                "code" => 400
            ];
        }else{
            $image = $request->file('img');
            if ($image) {
                $imageName = uniqid().date('Y-m-d-H:i:s').".".$image->extension();
                $destinationPath = public_path('/thumbnail');
                $img = Image::make($image->path());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$imageName);
        
                $destinationPath = public_path('/image/profile');
                $image->move($destinationPath, $imageName);
            }else{
                $imageName = null;
            }
            $users = UserApi::where('id', $request->id)
            ->update([
                'img' => $imageName, 
                'nama' => $request->name,
                'no_hp' => $request->phone_number
            ]);
            
            $data = [
                "response" => [
                    "status" => true,
                    "data" => $users,
                    "message" => "Berhasil",
                ],
                "code" => 201
            ];
        }
        return response()->json($data['response'], $data['code']);
    }

    public function changePassword(Request $request,$nip)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        if($validator->fails()){
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $validator->errors()->toArray()
                ],
                "code" => 400
            ];
        }else{
            $sqlCek = UserApi::select('password')->where('nip' ,$nip)->first();
            if (password_verify($request->post('old_password'), $sqlCek->password)) { 
                $users = UserApi::where('nip', $nip)
                ->update([
                    'password' => Hash::make($request->post('password')),
                ]);
                
                $data = [
                    "response" => [
                        "status" => true,
                        "data" => $users,
                        "message" => "Berhasil Ubah Password",
                    ],
                    "code" => 200
                ];
            }else{
                $data = [
                    "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => [
                            "old_password" => ["The Old Password Is Wrong"]
                        ]
                    ],
                    "code" => 400
                ];
            }
        }
        return response()->json($data['response'], $data['code']);
    }

    public function forgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string',
        ]);
        
        if($validator->fails()){
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $validator->errors()->toArray()
                ],
                "code" => 400
            ];
        }else{
            $token = uniqid();
            $email = $request->email;
           
            $users = UserApi::select('name')->where('email', $email)
            ->update([
                'remember_token' => $token, 
            ]);
            if ($users > 0) {
                // $forgotEmail = [
                //     'name' => substr($email, 0, strpos($email, '@')),
                //     'email' => $email,
                //     'token' => $token,
                //     'subject' => 'Lupa Password Akun',
                //     'view' => 'send.forgot'
                // ];
                // $message =  MailInterface::sendMail($forgotEmail);
                $message = 'Check Your email';
            }else{
                $message = 'Email Not Find';
            }
             $data = [
                "response" => [
                    "status" => true,
                    "data" => $users,
                    "message" => $message,
                ],
                "code" => 200
            ];
        }
        return response()->json($data['response'], $data['code']);
    }

    public function forgotEmail($token)
    {
        $forgotEmail = UserApi::select('email')->where('remember_token' , $token)->first();
        if ($forgotEmail) {
            $tokenNew = uniqid();
            UserApi::where('remember_token', $token)
            ->update([
                'remember_token' => $tokenNew,
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
            $insert = Password_reset::create([
                'email' => $forgotEmail->email, 
                'token' => $token,
            ]);
            $data = [
                'email' => $forgotEmail->email,
                'remember_token' => $tokenNew
            ];
            return view('reset', $data);
        }else{
            return "Silahkan Ulangi Kembali Lupa Password Anda";
        }

    }
    public function resetpassword(Request $request)
    {
        $resetPassword = Password_reset::select('email')->where(['token' => $request->token,'email' => $request->email])->first();
        if ($resetPassword) {
            UserApi::where(['remember_token' => $request->token,'email' => $request->email])
            ->update([
                'password' => Hash::make($request->post('password')),
            ]);
            return "Silahkan Login Kembali";
        }else{
            return "Silahkan Ulangi Kembali Lupa Password Anda";
        }

    }
}
