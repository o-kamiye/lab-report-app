<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Main\PatientController;

class PatientControllerTest extends TestCase
{
    /**
     * @var \Illuminate\Session\SessionManager
     */
    protected $manager;

    private $user;
    private $session;

    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp()
    {
        parent::setUp();
        // Avoid "Session store not set on request." - Exception!
        Session::setDefaultDriver('array');
        $this->manager = app('session');

        $user = new User;
        $user->id = 77;
    	$user->fullname = "Jack Robinson";
    	$user->phone = "+2348022007561";
    	$user->email = "some@mail.com";

    	$request = new Request();
        $request->setSession($this->manager->driver());
        $request->session()->set('patient', $this->user);

        $session = $request->session()->get('patient');

    }

    public function testPageNavigationWithoutMiddleware() {
        $this->withSession(['patient' => $this->session])
        	->visit('/report/list')
        	->dontSee('Showing all reports for Jack Robinson');
    }

}
