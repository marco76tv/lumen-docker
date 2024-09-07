<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\Profile;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ProfileControllerTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function it_can_create_a_profile()
    {
        $data = Profile::factory()->raw();
        $response = $this->post('/profiles', $data, $this->getAuthHeaders());
        $response->assertResponseStatus(201);
        $this->seeInDatabase('profiles', $data);
    }

    /** @test */
    public function it_can_read_a_profile()
    {
        $profile = Profile::factory()->create();

        $response = $this->get('/profiles/' . $profile->id, $this->getAuthHeaders());

        $response->assertResponseStatus(200);
        $this->seeJson(['first_name' => $profile->first_name]);
    }

    /** @test */
    public function it_can_get_profiles()
    {
        $response = $this->get('/profiles', $this->getAuthHeaders());

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_update_a_profile()
    {

        $profile = Profile::factory()->create();
        $data = Profile::factory()->raw();

        $response = $this->put('/profiles/' . $profile->id, $data, $this->getAuthHeaders());

        $response->assertStatus(200);
        $this->assertDatabaseHas('profiles', [
            'first_name' => $data['first_name']
        ]);
    }

    /** @test */
    public function it_can_delete_a_profile()
    {
        $profile = Profile::factory()->create();

        $response = $this->delete('/profiles/' . $profile->id, [], $this->getAuthHeaders());

        $response->assertStatus(204);

        $this->assertNull(Profile::find($profile->id));

    }

    /** @test */
    public function it_returns_unauthorized_for_no_token()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe'
        ];
        $response = $this->post('/profiles', $data);

        $response->assertStatus(401);
    }

}
