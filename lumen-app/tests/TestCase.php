<?php

namespace Tests;

use Tests\Traits\DatabaseAssertions;
use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseAssertions;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate');
    }

    public function assertStatus($expectedStatus)
    {

        $this->assertEquals($expectedStatus, $this->response->getStatusCode());
    }

    public function getAuthHeaders()
    {

        $token = 'YOUR_SECRET_TOKEN'; // Imposta il token correttamente

        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];
    }

}
