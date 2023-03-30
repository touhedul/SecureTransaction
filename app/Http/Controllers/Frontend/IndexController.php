<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactFeedback;
use App\Models\Gallery;
use App\Services\VisitorService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // return date('Y-m-d H:i:s');

        // (new VisitorService())->checkBlockIp();
        // (new VisitorService())->saveVisitorInfo();
        // return redirect()->route('login');
        if(auth()->user()){
            return redirect()->route('user.dashboard');
        }
        return view('frontend.fingure');
    }

    public function changeLanguage($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return back();
    }


    public function checkFingure()
    {

        $startTime = date("H:i:s", strtotime('-2 minutes', strtotime(date("H:i:s"))));
        $endTime = date("H:i:s", strtotime('+1 minutes', strtotime(date("H:i:s"))));
        // $endTime = date("H:i:s");
        $data = array("operation" => "fetch_log" , "auth_user" => "touhedul" , "auth_code"
        => "lxb3r83z136mz87j4y36mjdchype06z" , "start_date" => date('Y-m-d') , "end_date" =>
        date('Y-m-d') , "start_time" => $startTime, "end_time" => $endTime);


        // return $data;
        $datapayload = json_encode($data);
        $api_request = curl_init('https://rumytechnologies.com/rams/json_api');
        curl_setopt($api_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api_request, CURLINFO_HEADER_OUT, true);
        curl_setopt($api_request, CURLOPT_POST, true);
        curl_setopt($api_request, CURLOPT_POSTFIELDS, $datapayload);
        curl_setopt($api_request, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($datapayload)));
        $result = curl_exec($api_request);
        $result = json_decode($result);
        if(count($result->log) > 0){
            $accountNumber = $result->log[0]->registration_id;
            return view('frontend.index',compact('accountNumber'))->with('success','Fingure Successful.');
        }else{

            return back()->with('error',"No user found. Put your fingure to the machine then try again.");
        }
    }
}
