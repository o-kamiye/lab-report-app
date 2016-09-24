<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApplicationControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDefaultPage() {
        $this->visit('/')->see('Login');
    }

    public function testCorrectLogin() {
    	$this->visit('/login')
         ->type('john@smith.com', 'email')
         ->press('Login')
         ->seePageIs('/complete_login');
    }

    public function testIncorrectLogin() {
    	// Incorrect login credential
    	$this->visit('/login')
         ->type('wrong@wrong.com', 'email')
         ->press('Login')
         ->seePageIs('/login');
    }
}
