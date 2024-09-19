<?php

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use GuzzleHttp\Client;
// use Illuminate\Support\Str;
// use App\Models\Member;
// use App\Models\Teacher;
// use Illuminate\Support\Facades\Auth;

// class LineController extends Controller
// {
//     public function redirectToLineLogin()
//     {
//         $client_id = env('LINE_CLIENT_ID');
//         $redirect_uri = urlencode(env('LINE_REDIRECT_URI'));
//         $state = Str::random(40);

//         session(['state' => $state]);

//         $url = "https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id={$client_id}&redirect_uri={$redirect_uri}&state={$state}&scope=profile%20openid%20email";

//         return redirect($url);
//     }

//     public function handleLineCallback(Request $request)
//     {
//         $http = new Client();
//         $response = $http->post('https://api.line.me/oauth2/v2.1/token', [
//             'form_params' => [
//                 'grant_type' => 'authorization_code',
//                 'code' => $request->code,
//                 'redirect_uri' => env('LINE_REDIRECT_URI'),
//                 'client_id' => env('LINE_CLIENT_ID'),
//                 'client_secret' => env('LINE_CLIENT_SECRET'),
//             ],
//         ]);

//         $data = json_decode($response->getBody()->getContents(), true);

//         $response = $http->get('https://api.line.me/v2/profile', [
//             'headers' => [
//                 'Authorization' => 'Bearer ' . $data['access_token'],
//             ],
//         ]);

//         $user = json_decode($response->getBody()->getContents(), true);

//         if (Auth::guard('members')->check()) {
//             Member::where('id_student', Auth::guard('members')->user()->id_student)
//                 ->update(['id_line' => $user['userId']]);

//             return redirect()->route('member.edit.member');
//         }

//         if (Auth::guard('teachers')->check()) {
//             Teacher::where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
//                 ->update(['id_line' => $user['userId']]);

//             $userType = Auth::guard('teachers')->user()->user_type;

//             switch ($userType) {
//                 case 'Teacher':
//                     return redirect()->route('teacher.edit.teacher');
//                 case 'Admin':
//                     return redirect()->route('admin.edit.admin');
//                 case 'Branch head':
//                     return redirect()->route('branch-head.edit.branch-head');
//                 default:
//                     return redirect()->route('welcome');
//             }
//         }
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class LineController extends Controller
{
    protected $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    public function redirectToLineLogin()
    {
        $client_id = env('LINE_CLIENT_ID');
        $redirect_uri = urlencode(env('LINE_REDIRECT_URI'));
        $state = Str::random(40);

        session(['state' => $state]);

        $url = "https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id={$client_id}&redirect_uri={$redirect_uri}&state={$state}&scope=profile%20openid%20email";

        return redirect($url);
    }

    public function handleLineCallback(Request $request)
    {
        $data = $this->getAccessToken($request->code);
        $user = $this->getLineProfile($data['access_token']);

        if (Auth::guard('members')->check()) {
            $this->updateLineId(Member::class, 'id_student', 'members', $user['userId']);
            return redirect()->route('member.edit.member');
        }

        if (Auth::guard('teachers')->check()) {
            $this->updateLineId(Teacher::class, 'id_teacher', 'teachers', $user['userId']);
            return $this->redirectBasedOnUserType(Auth::guard('teachers')->user()->user_type);
        }

        return redirect()->route('welcome');
    }

    protected function getAccessToken($code)
    {
        $response = $this->http->post('https://api.line.me/oauth2/v2.1/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('LINE_REDIRECT_URI'),
                'client_id' => env('LINE_CLIENT_ID'),
                'client_secret' => env('LINE_CLIENT_SECRET'),
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function getLineProfile($accessToken)
    {
        $response = $this->http->get('https://api.line.me/v2/profile', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function updateLineId($model, $field, $guard, $userId)
    {
        $model::where($field, Auth::guard($guard)->user()->$field)
            ->update(['id_line' => $userId]);
    }

    protected function redirectBasedOnUserType($userType)
    {
        switch ($userType) {
            case 'Teacher':
                return redirect()->route('teacher.edit.teacher');
            case 'Admin':
                return redirect()->route('admin.edit.admin');
            case 'Branch head':
                return redirect()->route('branch-head.edit.branch-head');
            default:
                return redirect()->route('welcome');
        }
    }
}
