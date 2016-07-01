<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    public function testPostCreateUser()
    {
        $credentials = array(
            'name' => 'alex',
            'password' => '1234',
            'email' => 'alexs2@gmail.com'
        );

        $response = $this->call('POST', route('userCreate'), $credentials);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPostCreateDog()
    {
        $credentials = array(
            'name' => 'alex',
            'gender' => '1',
            'user_id' => '1',
            'age' => '12',
            'breed' => 'snauzer'
        );

        $response = $this->call('POST', route('userCreateDogs'), $credentials);
        $this->assertEquals(200, $response->getStatusCode());
    }

}
