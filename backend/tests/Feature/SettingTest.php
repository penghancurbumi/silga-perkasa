<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_settings_page(): void
    {
        $response = $this->get('/settings');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_settings_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/settings');
        $response->assertStatus(200);
        $response->assertSee('Zona Waktu');
    }

    public function test_settings_initializes_with_user_settings(): void
    {
        $user = User::factory()->create([
            'settings' => [
                'timezone' => 'Asia/Makassar',
                'theme' => 'dark',
                'notif_login' => false,
                'notif_publish' => false,
                'pagination_limit' => 20,
            ]
        ]);

        Livewire::actingAs($user)
            ->test(Setting::class)
            ->assertSet('timezone', 'Asia/Makassar')
            ->assertSet('notif_login', false)
            ->assertSet('notif_publish', false)
            ->assertSet('pagination_limit', 20);
    }

    public function test_user_can_update_settings(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Setting::class)
            ->set('timezone', 'Asia/Jayapura')
            ->set('notif_login', false)
            ->set('notif_publish', false)
            ->set('pagination_limit', 25)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('settings-success');

        $user->refresh();

        $this->assertEquals('Asia/Jayapura', $user->getSetting('timezone'));
        $this->assertFalse($user->getSetting('notif_login'));
        $this->assertFalse($user->getSetting('notif_publish'));
        $this->assertEquals(25, $user->getSetting('pagination_limit'));
    }

    public function test_settings_validation_rules(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Setting::class)
            ->set('timezone', 'invalid-timezone')
            ->set('pagination_limit', 99)
            ->call('save')
            ->assertHasErrors([
                'timezone' => 'in',
                'pagination_limit' => 'in',
            ]);
    }

    public function test_user_can_set_pagination_limit_to_normal(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Setting::class)
            ->set('pagination_limit', 25)
            ->set('pagination_limit', null)
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('pagination_limit', null);

        $user->refresh();
        $this->assertNull($user->getSetting('pagination_limit'));
    }
}
