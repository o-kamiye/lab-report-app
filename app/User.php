<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Report;
use App\TestResult;

class User extends Model
{

    const PATIENT = 0;
    const OPERATOR = 1;

	protected $fillable = ['unique_id', 'fullname', 'email', 'phone', 'passcode_hash'];
    //
    // define a method to get the phone number of user



    public function setUserType($type) {

    }

    public static function addNewUser($array) {
        $user = self::create($array);
        return $user;
    }

    public static function getAllPatients() {
        $patients = self::where('user_type', self::PATIENT)
                    ->orderBy('fullname', 'asc')
                    ->get();
        return $patients;
    }

    public static function getPatientByEmail($email) {
        return self::where('email', $email)->first();
    }

    public static function deleteUser($unique_id) {
        $user = self::where('unique_id', $unique_id)->first();
        Report::where('patient_id', $user->id)->delete();
        TestResult::where('patient_id', $user->id)->delete();
        $user->delete();
        return true;
    }

    public static function getUserByUniqueId($unique_id) {
        return self::where('unique_id', $unique_id)->first();
    }

}
