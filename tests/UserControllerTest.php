<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPageNavigationWithoutMiddleware() {
    	$this->withoutMiddleware();
        $this->visit('/dashboard')->see('Add New Patient');
    }

    public function testPageNavigationWithMiddleware() {
        $this->visit('/dashboard')->dontSee('Add New Patient');
    }

    public function testOperatorNavigation_patientNav() {
    	$this->withoutMiddleware();
    	$this->visit('/dashboard')->click('Add New Patient')->seePageIs('/patient/add');
    	$this->visit('/dashboard')->click('Show Patients')->seePageIs('/patient/show_all');
    }

    public function testOperatorNavigation_reportNav() {
    	$this->withoutMiddleware();
    	$this->visit('/dashboard')->click('Add New Report')->seePageIs('/report/add');
    	$this->visit('/dashboard')->click('Show Reports')->seePageIs('/report/show_all');
    }

    public function testOperatorNavigation_testNav() {
    	$this->withoutMiddleware();
    	$this->visit('/dashboard')->click('Add New Test')->seePageIs('/test/add');
    	$this->visit('/dashboard')->click('Show Tests')->seePageIs('/test/show_all');
    }

    public function testAddNewPatientPage() {
    	$this->withoutMiddleware();
    	$this->visit('/patient/add')->see('Add a New Patient');
    }

    public function testShowAllPatientPage() {
    	$this->withoutMiddleware();
    	$this->visit('/patient/show_all')->see('Showing all patients');
    }

    public function testAddNewReportPage() {
    	$this->withoutMiddleware();
    	$this->visit('/report/add')->see('Add a New Patient Report');
    }

    public function testShowAllReportPage() {
    	$this->withoutMiddleware();
    	$this->visit('/report/show_all')->see('Showing all patient reports');
    }

    public function testAddNewTestPage() {
    	$this->withoutMiddleware();
    	$this->visit('/test/add')->see('Add a New test');
    }

    public function testShowAllTestPage() {
    	$this->withoutMiddleware();
    	$this->visit('/test/show_all')->see('Showing all tests');
    }




}
