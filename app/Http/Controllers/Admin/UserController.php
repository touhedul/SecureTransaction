<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Helpers\FileHelper;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Http\Controllers\AppBaseController;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends AppBaseController
{

    public function index(UserDataTable $userDataTable)
    {

        // return  $users = User::all();
        //  $users = User::with('login_activity')->get();
        // return view('admin.users.index',compact('users'));


        $this->authorize('user-view');
        $users = User::all();
        return $userDataTable->render('admin.users.index', compact('users'));
    }


    public function create()
    {
        $this->authorize('user-create');
        return view('admin.users.create');
    }


    public function store(UserCreateRequest $request)
    {
        $this->authorize('user-create');
        $status = $request->status ?? 0;
        $imageName = FileHelper::uploadImage($request, NULL, ['avatar', 'avatarHeight' => 50, 'avatarWidth' => 50]);
        $user = User::create(array_merge($request->validated(), ['image' => $imageName, 'status' => $status, 'password' => bcrypt($request->password)]));
        $user->assignRole('user');
        $this->addFingurePrintUser($request->signature, $request->account_number);
        notify()->success(__("Successfully Created"), __("Success"));
        return redirect(route('admin.users.create'));
    }



    public function addFingurePrintUser($signature, $accountNumber)
    {
        $username = "" . $accountNumber . "";
        $data = array(
            "operation" => "add_user", "auth_user" => "touhedul", "signature_type" => "fp1", "auth_code" => "lxb3r83z136mz87j4y36mjdchype06z", "username" => "$accountNumber",
            "signature" => $signature, "device_id" => "FP2236693829"
        );

        $datapayload = json_encode($data);
        $api_request = curl_init('https://rumytechnologies.com/rams/json_api');
        curl_setopt($api_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api_request, CURLINFO_HEADER_OUT, true);
        curl_setopt($api_request, CURLOPT_POST, true);
        curl_setopt($api_request, CURLOPT_POSTFIELDS, $datapayload);
        curl_setopt($api_request, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($datapayload)));

        $result = curl_exec($api_request);

        info($result);
    }

    public function show($id)
    {

        // $startTime = date("H:i:s", strtotime('-7 minutes', strtotime(date("H:i:s"))));
        // $endTime = date("H:i:s");

        // $data = array(
        //     "operation" => "set_user_registration_mode", "auth_user" => "touhedul", "auth_code"
        //     => "lxb3r83z136mz87j4y36mjdchype06z", "device_id" => "FP2236693829"
        // );

        // $data = array(
        //     "operation" => "add_user", "auth_user" => "touhedul", "signature_type" => "fp1", "auth_code" => "lxb3r83z136mz87j4y36mjdchype06z", "username" => "123",
        //     "signature" => "", "device_id" => "DS3356652"
        // );

        $data = array(
            "operation" => "fetch_user_list", "auth_user" => "touhedul", "auth_code"
            => "lxb3r83z136mz87j4y36mjdchype06z"
        );


        $datapayload = json_encode($data);
        $api_request = curl_init('https://rumytechnologies.com/rams/json_api');
        curl_setopt($api_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api_request, CURLINFO_HEADER_OUT, true);
        curl_setopt($api_request, CURLOPT_POST, true);
        curl_setopt($api_request, CURLOPT_POSTFIELDS, $datapayload);
        curl_setopt($api_request, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($datapayload)));
        return $result = curl_exec($api_request);



        // // $result = '{"log": [{"unit_name": "Educo School", "registration_id": "20207", "access_id": "9772671", "department": "None", "access_time": "10:11:30", "access_date": "2020-02-17", "user_name": " ", "unit_id": "DS3356652", "card": "None"}, {"unit_name": "Educo School", "registration_id": "20200", "access_id": "9772672", "department": "None", "access_time": "10:11:24", "access_date": "2020-02-17", "user_name": " ", "unit_id": "DS3356652", "card": "None"}]}';

        // $logs = json_decode($result);

        // return $logs;


        $this->authorize('user-view');
        $user = User::findOrFail($id);

        $transactions = Transaction::where('user_id', $id)->latest()->get();
        return view('admin.users.show', compact('user', 'transactions'));
    }



    public function edit($id)
    {
        $this->authorize('user-update');
        $user = User::findOrFail($id);
        return view('admin.users.edit')->with('user', $user);
    }


    public function update($id, UserUpdateRequest $request)
    {
        $this->authorize('user-update');
        $user = User::findOrFail($id);
        $imageName = FileHelper::uploadImage($request, $user, ['avatar', 'avatarHeight' => 50, 'avatarWidth' => 50]);
        if ($request->password) {
            $password = bcrypt($request->password);
        } else {
            $password = $user->password;
        }
        $status = $request->status ?? 0;
        $user->fill(array_merge($request->validated(), ['image' => $imageName, 'password' => $password, 'status' => $status,]))->save();

        notify()->success(__("Successfully Updated"), __("Success"));
        return back();
    }


    public function destroy($id)
    {
        $this->authorize('user-delete');
        $user = User::findOrFail($id);
        FileHelper::deleteImage($user);
        $user->delete();
    }

    public function loginAsUser($userId)
    {
        $user = User::find($userId);
        Auth::login($user);
        return redirect()->route('index');
    }
}
