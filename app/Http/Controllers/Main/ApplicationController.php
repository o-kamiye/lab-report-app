<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Message;

class ApplicationController extends Controller {


	public function __construct() {
		$this->middleware('new_setup_check');
	}

	public function index(Request $request) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
					'email' => 'required|email'
				]);
			$user = User::where('email', $request->email)->first();
			if ($user != null) {
				$passcode = $this->generatePassCode();
				$this->sendAuthenticationCode($user->phone, $user->email, $passcode);
				$data['user'] = $user;
				$data['passcode'] = $passcode;
				return redirect('complete_login')->with('data', $data);
			}
			return redirect('/login')->with('login_error', 'Incorrect login credential');
		}
		return view('pages.index');
	}

	public function signup() {
		return view('pages.signup');
	}

	public function complete_login(Request $request) {
		$request->session()->reflash();
		if ($request->isMethod('post') && $request->session()->has('data')) {
			$data = $request->session()->get('data');
			$this->validate($request, [
					'code' => 'required|digits:6'
				]);
			if ($data['passcode'] == $request->code) {
				$this->createNewSession($request, $data['user']);
				return redirect('dashboard');
			}
			return view('pages.login')->with("login_error", "An error occured while loggin in. Please try again");
		}
		return view('pages.login');
	}

	public function signout(Request $request) {
		$request->session()->flush();
		return redirect('/');
	}

	private function generatePassCode() {
		return mt_rand(99999, 999999);
	}

	private function sendAuthenticationCode($phoneNumber, $email, $passcode) {
		$message = "Your verification code is: ".$passcode;
		$smsSent = Message::sendSms($phoneNumber, $message);
		$emailSent = Message::sendEmail($email, $message);
	}

	private function createNewSession(Request $request, $user) {
		$request->session()->forget('patient');
		$request->session()->forget('operator');
		if ($user->user_type == 1) {
			$request->session()->put('operator', $user);
		}
		else {
			$request->session()->put('patient', $user);
		}
	}
}