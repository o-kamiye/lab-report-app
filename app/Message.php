<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Twilio\Rest\Client as TwilioClient;
use Mail;

class Message extends Model
{
    //
    const BASE_URL = "http://api.clickatell.com/http/sendmsg?";
    const USERNAME = "kamiye";
    const PASSWORD = "pathology123";
    const APP_ID = 3624438;

    const ACCOUNT_SID = "AC414b8f34e99a02b723061d1c0b4460b5";
    const AUTH_TOKEN = "your_auth_token";

    public static function sendSms($to, $message) {

    	$baseUrl = self::generateSmsUrl();
    	$queryUrl = $baseUrl."&to=$to"."&text=$message";
    	$client = new Client();
    	$res = $client->request('GET', $queryUrl, ['exceptions' => false]);

    	// TODO you might want to use a callback method here so as not to block the application thread here
    	return $res->getStatusCode() == 200;
    }

    public static function sendEmail($to, $messageBody) {
        Mail::raw($messageBody, function ($message) use ($to) {
            $message->from('info@pathology.com', 'Pathology Report');
            $message->to($to);
            $message->subject("Pathology Laboratory");
        });
    }

    private static function generateSmsUrl() {
        $url = self::BASE_URL."user=".self::USERNAME."&password=".self::PASSWORD
                ."&api_id=".self::APP_ID;
        return $url;
    }

    private static function sendSmsWithTwilio($to, $message) {
        $twilio_client = new TwilioClient(self::ACCOUNT_SID, self::AUTH_TOKEN);

        $sms = $twilio_client->account->messages->create(
            $to,
            array(
                'from' => "+12566458604",
                // the sms body
                'body' => $message
            )
        );
        return true;
    }
}
