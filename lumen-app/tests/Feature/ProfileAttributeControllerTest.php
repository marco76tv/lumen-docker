<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Profile;
use App\Models\ProfileAttribute;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ProfileAttributeControllerTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function it_can_create_a_profile_attribute()
    {
        $profile = Profile::factory()->create();
        $data = [
            'profile_id' => $profile->id,
            'attribute' => 'Test Attribute',
        ];

        $response = $this->post('/profile-attributes', $data, $this->getAuthHeaders());

        $response->assertResponseStatus(201);
        $this->seeInDatabase('profile_attributes', $data);
    }

    /** @test */
    public function it_can_read_a_profile_attribute()
    {
        $profileAttribute = ProfileAttribute::factory()->create();

        $response = $this->get('/profile-attributes/' . $profileAttribute->id, $this->getAuthHeaders());

        $response->assertResponseStatus(200);
        $this->seeJson(['attribute' => $profileAttribute->attribute]);
    }

    /** @test */
    public function it_can_update_a_profile_attribute()
    {
        $profileAttribute = ProfileAttribute::factory()->create();

        $data = [
            'attribute' => 'Updated Attribute',
        ];

        $response = $this->put('/profile-attributes/' . $profileAttribute->id, $data, $this->getAuthHeaders());

        $response->assertResponseStatus(200);
        $this->seeInDatabase('profile_attributes', ['id' => $profileAttribute->id, 'attribute' => 'Updated Attribute']);
    }

    /** @test */
    public function it_can_delete_a_profile_attribute()
    {
        $profileAttribute = ProfileAttribute::factory()->create();

        $response = $this->delete('/profile-attributes/' . $profileAttribute->id, [], $this->getAuthHeaders());

        $response->assertResponseStatus(204);
        //$this->notSeeInDatabase('profile_attributes', ['id' => $profileAttribute->id]);
        $this->assertNull(ProfileAttribute::find($profileAttribute->id));
    }
}
