<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WebboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {

     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


     public function addcars(Request $request)
{

     }

     public function deletecars(Request $request)
     {



     }

    public function index()
    {
      Session::forget('tabmanu');
        Session::forget('tabmanu1');
      Session::put("tabmanu2","active");
      return view('user.webboard');
    }

}
