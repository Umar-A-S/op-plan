<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Driver;
use App\Models\Fleet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed roles and create admin
        \Artisan::call('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
        
        $role = Role::findByName('Admin Logistik');
        $this->user = User::factory()->create();
        $this->user->assignRole($role);
    }

    public function test_admin_can_view_reports()
    {
        $response = $this->actingAs($this->user)->get(route('reports.index'));
        $response->assertStatus(200);
    }

    public function test_admin_can_export_reports()
    {
        $response = $this->actingAs($this->user)->get(route('reports.export'));
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    }
}
