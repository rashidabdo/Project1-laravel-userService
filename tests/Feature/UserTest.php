<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    /**
     * @return void
     */
    public function test_can_access_users()
    {
        $response = $this->get('api/users');
        $response->assertStatus(200);
    }

    public function test_can_edit_user()
    {
        $response = $this->put('api/users/2/edit');
        $this->assertArrayHasKey('data', $response);

    }

    public function test_can_not_edit_not_exist_user()
    {
        $response = $this->put('api/users/100/edit');
        $this->assertArrayNotHasKey('email', $response);
    }

    public function test_can_not_delete_user_has_details()
    {
        $response = $this->delete('api/users/7/delete');
        $this->assertJson($response->content(),'User has details not possible to delete it');
    }

    public function test_can_delete_user_does_not_has_details()
    {
        $response = $this->delete('api/users/2/delete');
        $this->assertJson($response->content(),'User deleted.');
    }

    public function tearDown(): void
    {
        DB::rollback();
        parent::tearDown();
    }
}

