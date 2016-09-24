<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Test;
use App\TestResult;
use App\Report;
use App\Message;

class UserController extends Controller {

	public function __construct() {
		$this->middleware('operator_check');
	}

	public function index(Request $request) {
		return view('pages.dashboard');
	}

	public function add_patient(Request $request) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
					'fullname' => 'required|max:255',
					'email' => 'required|email|unique:users|max:255',
					'phone' => 'required|unique:users|max:255',
					'passcode' => 'required|digits:6'
				]);
			$passcode_hash = password_hash($request->passcode, PASSWORD_BCRYPT);
			$unique_id = uniqid();
			$user = User::create([
					'unique_id' => $unique_id,
					'fullname' => $request->fullname,
					'email' => $request->email,
					'phone' => $request->phone,
					'passcode_hash' => $passcode_hash
				]);
			$this->sendAccountCreationMessage($user, $request->passcode);
			return redirect('patient/show_all')->with("status", "New patient, ".$request->fullname." has been successfully created.");
		}
		return view('pages.patient.add');
	}

	public function show_all_patients(Request $request) {
		$data['patients'] = User::getAllPatients();
		return view('pages.patient.all', $data);
	}

	public function delete_patient(Request $request, $patient_id) {
		$deleted = User::deleteUser($patient_id);
		if ($deleted) {
			return redirect('/patient/show_all')->with('status', "User successfully deleted");
		}
		return redirect('/patient/show_all')->with('error_status', "User does not exist or already deleted");
	}

	public function edit_patient(Request $request, $patient_id) {
		$patient = User::getUserByUniqueId($patient_id);
		$data['patient'] = $patient;
		if ($request->isMethod('post')) {
			$this->validate($request, [
					'fullname' => 'required|max:255',
					'email' => 'required|email|unique:users|max:255',
					'phone' => 'required|unique:users|max:255'
				]);
			$passcode_hash = password_hash($request->passcode, PASSWORD_BCRYPT);
			$unique_id = uniqid();
			$patient->fullname = $request->fullname;
			$patient->email = $request->email;
			$patient->phone = $request->phone;
			$patient->save();
			return redirect('patient/show_all')->with("status", $request->fullname."'s details has been successfully modified.");
		}
		return view('pages.patient.add', $data);
	}

	public function add_report(Request $request) {
		$tests = Test::getAll();
		$data['tests'] = $tests;
		if ($request->isMethod('post')) {
			$this->validate($request, [
					'patient' => 'required|email|exists:users,email|max:255',
					'title' => 'required|max:255',
					'date' => 'required|date'
				]);
			$patient = User::getPatientByEmail($request->patient);
			$unique_id = uniqid();
			$report = Report::create([
					'unique_id' => $unique_id,
					'patient_id' => $patient->id,
					'title' => $request->title,
					'date' => $request->date
				]);
			
			$result_form = array();
			foreach ($tests as $test) {
				$result_field = "result_".$test->id;
				$comment_field = "comment_".$test->id;
				$result = $request->$result_field;
				if ($result != "") {
					$result_form['test_id'] = $test->id;
					$result_form['patient_id'] = $patient->id;
					$result_form['report_id'] = $report->unique_id;
					$result_form['result'] = $result;
					$result_form['comment'] = $request->$comment_field;
					$test_result = TestResult::create($result_form);
				}
			}
			return redirect('report/show_all')->with("status", "New report for ".$patient->fullname." successfully created");
		}
		return view('pages.report.add', $data);
	}

	public function show_all_reports(Request $request) {
		$data['reports'] = Report::getAll();
		return view('pages.report.all', $data);
	}

	public function delete_report(Request $request, $report_id) {
		$deleted = Report::deleteReport($report_id);
		if ($deleted) {
			return redirect('report/show_all')->with("status", "New successfully deleted");
		}
		return redirect('report/show_all')->with("error_status", "Report record not found or already deleted");
	}

	public function add_test(Request $request) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
					'name' => 'required|unique:tests|max:255'
				]);
			$test = Test::create([
					'name' => $request->name
				]);
			return redirect('test/show_all')->with("new_test", "New test, ".$request->name." has been successfully created");
		}
		return view('pages.test.add');
	}

	public function show_all_tests(Request $request) {
		$data['tests'] = Test::getAll();
		return view('pages.test.all', $data);
	}

	public function add_operator(Request $request) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
					'fullname' => 'required|max:255',
					'email' => 'required|email|unique:users|max:255',
					'phone' => 'required|unique:users|max:255',
					'passcode' => 'required|digits:6'
				]);
			$passcode_hash = password_hash($request->passcode, PASSWORD_BCRYPT);
			$unique_id = uniqid();

			$admin = new User;
			$admin->unique_id = $unique_id;
			$admin->fullname = $request->fullname;
			$admin->email = $request->email;
			$admin->phone = $request->phone;
			$admin->passcode_hash = $passcode_hash;
			$admin->user_type = 1;
			$admin->save();
			$this->sendAccountCreationMessage($admin, $request->passcode);
			return redirect('dashboard')->with("new_patient", "New operator, ".$request->fullname." has been successfully created.");
		}
		return view('pages.new_operator');
	}

	private function sendAccountCreationMessage($user, $passcode) {
		$message = "Hello, ".$user->fullname.".\n Your account has been created. You can login with your email: \n".
					"Email: ".$user->email."\n";
		$smsSent = Message::sendSms($user->phone, $message);
		$emailSent = Message::sendEmail($user->email, $message);
	}
}