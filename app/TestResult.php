<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TestResult extends Model
{
    //
    protected $table = 'test_results';
    protected $fillable = ['test_id', 'patient_id', 'report_id', 'result', 'comment'];

    public static function getAll($report_id) {
    	$results = DB::select('select test_results.result, test_results.comment, tests.name from test_results LEFT JOIN tests ON test_results.test_id = tests.id where test_results.report_id = ?', [$report_id]);

        return $results;
    }
}
