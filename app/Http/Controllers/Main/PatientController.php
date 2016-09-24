<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Report;
use App\TestResult;
use App\Message;
use PDF;

class PatientController extends Controller {

	public function __construct() {
		$this->middleware('login_check');
	}

	public function show_all_reports(Request $request) {
		$patient = $request->session()->get('patient');
		$data['patient'] = $patient;
		$data['reports'] = Report::getForOne($patient->id);
		return view('pages.report.patient_all', $data);
	}

	public function show_report_details(Request $request, $report_id) {
		$data['patient'] = $request->session()->get('patient');
		$data['report'] = Report::getOne($report_id);
		$data['tests'] = TestResult::getAll($report_id);
		return view('pages.report.patient_details', $data);
	}

	public function download_report(Request $request, $report_id) {
		$data['patient'] = $request->session()->get('patient');
		$data['report'] = Report::getOne($report_id);
		$data['tests'] = TestResult::getAll($report_id);
		$pdf = PDF::loadView('pages.report.pdf', $data);
		$reportname = "report_".$report_id.".pdf";
		return $pdf->download($reportname);
	}

	private function sendReportMail($user, $report, $attachment) {
		$message = "Hello, ".$user->fullname.".\n Please find attached your ".$report->title." on ".$report->date."\n";
		$emailSent = Message::sendReport($user->email, $message, $attachment);
	}
	
}