<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\TestResult;

class Report extends Model
{
    //
    protected $fillable = ['unique_id', 'patient_id', 'title', 'date'];

    /**
     * Get the user record associated with the report.
     */
    public function patient()
    {
        return $this->hasOne('App\User', 'patient_id');
    }

    public static function getAll() {
    	$reports = DB::select('select reports.unique_id, reports.title, reports.date, users.fullname, users.email from reports LEFT JOIN users ON reports.patient_id = users.id');

    	return $reports;
    }

    public static function getForOne($patient_id) {
        $reports = DB::select('select reports.unique_id, reports.title, reports.date, users.fullname, users.email from reports LEFT JOIN users ON reports.patient_id = users.id where users.id = ?', [$patient_id]);

        return $reports;
    }

    public static function getOne($report_id) {
        return self::where('unique_id', $report_id)->first();
    }

    public static function deleteReport($report_id) {
        $report = self::where('unique_id', $report_id)->first();
        TestResult::where('report_id', $report->unique_id)->delete();
        $report->delete();
        return true;
    }
}
