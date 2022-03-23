<?php

namespace Tests\Unit\Http\Controllers\API\V01\Channel;

use Tests\TestCase;
use App\Models\Channel;
use Symfony\Component\HttpFoundation\Response;

class ChannelControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * Test All Channel List Should Be Accessible
     */
    public function test_all_channel_list_should_be_accessible()
    {
        $response = $this->get(route('channel.all'));
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test Create Channel Should Be Validated
     */
    public function test_create_channel_should_be_validated()
    {
        $response = $this->postJson(route('channel.create'), []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test Create New Channel
     */
    public function test_create_new_channel()
    {
        $response = $this->postJson(route('channel.create'), [
            'name' => 'Laravel'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Test Channel Update Should Be validated
     */
    public function test_channel_update_should_be_validated()
    {
        $response = $this->json('PUT', route('channel.update'), []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test Channel Update
     */
    public function test_channel_update()
    {
        $channel = Channel::factory(Channel::class)->create([
            'name' => 'Laravel'
        ]);

        $response = $this->json('PUT', route('channel.update'), [
            'id' => $channel->id,
            'name' => 'React Js',
        ]);

        $updateChannel = Channel::find($channel->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('React Js', $updateChannel->name);
    }

    /**
     * Test channel delete should be validate
     */
    public function test_channel_delete_should_be_validate()
    {
        $response = $this->json('DELETE', route('channel.delete'), []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test channel delete
     */
    public function test_channel_delete()
    {
        $channel = Channel::factory(Channel::class)->create();
        $response = $this->json('DELETE', route('channel.delete'), [
            'id' => $channel->id,
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }
}
