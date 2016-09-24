<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Message;

class SetupController extends Controller {


	public function __construct() {
		$this->middleware('config_check');
	}

	public function index(Request $request) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
					'email' => 'required|email',
					'phone' => 'required|numeric'
				]);
			$data['email'] = $request->email;
			$data['phone'] = $request->phone;
			$data['passcode'] = $this->generatePassCode();
			$this->sendAuthenticationCode($data);
			return redirect('/config/proceed')->with("data", $data);
		}
		return view('pages.setup.new');
	}

	public function complete_account_creation(Request $request) {
		$request->session()->reflash();
		if ($request->isMethod('post') && $request->session()->has('data')) {
			$data = $request->session()->get('data');
			$this->validate($request, [
					'fullname' => 'required|max:255',
					'passcode' => 'required|digits:6'
				]);
			$passcode_hash = password_hash($request->passcode, PASSWORD_BCRYPT);
			$unique_id = uniqid();
			if ($request->passcode == $data['passcode']) {
				$admin = new User;
				$admin->unique_id = $unique_id;
				$admin->fullname = $request->fullname;
				$admin->email = $data['email'];
				$admin->phone = $data['phone'];
				$admin->passcode_hash = $passcode_hash;
				$admin->user_type = 1;
				$admin->save();
				$this->sendAccountCreationMessage($admin);
				return redirect('/dashboard');
			}
			return redirect('/config')->with("error", "Error creating admin. Please try again");
		}
		return view('pages.setup.proceed');
	}

	private function sendAuthenticationCode($array) {
		$message = "Your verification code is: ".$array['passcode'];
		$smsSent = Message::sendSms($array['phone'], $message);
		$emailSent = Message::sendEmail($array['email'], $message);
	}

	private function generatePassCode() {
		return mt_rand(99999, 999999);
	}

	private function sendAccountCreationMessage($user) {
		$message = "Hello, ".$user->fullname.".\n Your account has been created. You can login with your email: \n".
					"Email: ".$user->email."\n\n";
		$smsSent = Message::sendSms($user->phone, $message);
		$emailSent = Message::sendEmail($user->email, $message);
	}
}