<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    
    protected function setUp(): void
    {
        parent::setUp();
        $admin = User::factory()->create();
        $role = Role::findOrCreate('Admin');
        $admin->assignRole($role);

        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        User::factory(10)->create();
    }

    /** @test */
    public function an_admin_can_view_all_users()
    {
        
        $response = $this->withoutExceptionHandling()->get(route('allUsers'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.user.all');
        $this->assertEquals(11, User::all()->count());
    }

    /** @test */
    public function add_user_form_can_be_rendered()
    {
        $response = $this->get(route('addUser'));
        $response->assertViewIs('admin.user.add');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_add_a_user()
    {
        Role::findOrCreate('Manager');
        $response = $this->post(route('createUser', [
            'name' => 'Test User',
            'email' => 'testuser@exmple.com',
            'phone' => '01345678900',
            'user_name' => 'kjsdfjhhjsdkf',
            'password' => 'Password',
            'password_confirmation' => 'Password',
            'role' => ['Manager']
        ]));
        
        $response->assertRedirect(route('allUsers'));
        $this->assertEquals(12, User::count());
    }

    /** @test */
    public function an_admin_can_view_single_user()
    {
        $user = User::findOrFail(5);
        $response = $this->get(route('viewUser',['user' => $user]));
        $response->assertViewIs('admin.user.view');
        $response->assertStatus(200);
        $this->assertEquals($user->id, $response->getOriginalContent()->user->id);

    }

    /** @test */
    public function an_admin_can_edit_a_user()
    {
        $user = User::findOrFail(3);
        $response = $this->get(route('editUser',['user' => $user]));
        $response->assertViewIs('admin.user.edit');
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    /** @test */
    public function an_admin_can_update_a_user()
    {
        $user = User::findOrFail(3);
        $response = $this->post(route('updateUser',
        [
            'user' => $user,
            'name' => 'Test Name',
            'email'=> 'ema5555il@gmail.com',
            'phone' => '01355556655',
            'role' => ['Customer'],
        ]));
        $response->assertSessionHas('success','User Updated Successfuly!');
        $response->assertRedirect(route('viewUser', ['user' => $user]));
    }

    /** @test */
    public function an_admin_can_view_soft_deleted_users()
    {
        User::destroy([3,4,5,7,8,11]);
        $response = $this->get(route('trashedUsers'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.user.trashedUsers');
        $this->assertEquals(6, User::onlyTrashed()->count());
    }

    /** @test */
    public function an_admin_can_soft_delete_user()
    {
        $user = User::find(5);
        $response = $this->post(route('deleteUser', ['user' => $user]));
        $response->assertSessionHas('success','User Deleted Successfuly!');
        $response->assertRedirect(route('allUsers'));
        $this->assertEquals(1, User::onlyTrashed()->count());
    }

    /** @test */
    public function an_admin_can_restore_user()
    {
        User::destroy([3,4,5,7,8,11]);
        $user = User::onlyTrashed()->find(4);
        $response = $this->post(route('restoreUser', ['id' => $user->id]));
        $response->assertSessionHas('success','User Restored Successfuly!');
        $response->assertRedirect(route('allUsers'));
        $this->assertEquals(5, User::onlyTrashed()->count());
        $this->assertEquals(6, User::count());
    }

    /** @test */
    public function an_admin_can_permanently_delete_user()
    {
        User::destroy([3,4,5,7,8,11]);
        $user = User::onlyTrashed()->find(3);
        $response = $this->post(route('permanentDeleteUser', ['id' => $user->id]));
        $response->assertSessionHas('success','User Permanently Deleted Successfuly!');
        $response->assertRedirect(route('allUsers'));
        $this->assertEquals(5, User::onlyTrashed()->count());
        $this->assertEquals(5, User::count());
    }
}
