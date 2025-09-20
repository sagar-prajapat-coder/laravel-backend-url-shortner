<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortUrlPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed roles and a company
        Role::insert([['name'=>'SuperAdmin'],['name'=>'Admin'],['name'=>'Member'],['name'=>'Sales'],['name'=>'Manager']]);
        Company::create(['name'=>'C1']);
    }

    public function test_admin_and_member_cannot_create_short_urls()
    {
        $admin = User::factory()->create(['role_id'=>Role::where('name','Admin')->first()->id]);
        $member = User::factory()->create(['role_id'=>Role::where('name','Member')->first()->id]);
        $this->actingAs($admin)->postJson('/short-urls',['original_url'=>'https://example.com'])->assertStatus(403);
        $this->actingAs($member)->postJson('/short-urls',['original_url'=>'https://example.com'])->assertStatus(403);
    }

    public function test_superadmin_cannot_create_short_urls()
    {
        $super = User::factory()->create(['role_id'=>Role::where('name','SuperAdmin')->first()->id]);
        $this->actingAs($super)->postJson('/short-urls',['original_url'=>'https://example.com'])->assertStatus(403);
    }

    public function test_admin_can_only_see_short_urls_not_in_own_company()
    {
        $admin = User::factory()->create(['role_id'=>Role::where('name','Admin')->first()->id, 'company_id'=>1]);
        ShortUrl::create(['code'=>'abc','original_url'=>'https://a','created_by'=>1,'company_id'=>1,'is_public'=>false]);
        ShortUrl::create(['code'=>'def','original_url'=>'https://b','created_by'=>1,'company_id'=>2,'is_public'=>false]);
        $this->actingAs($admin)->getJson('/short-urls')->assertJsonCount(1,'data');
    }

    public function test_member_can_only_see_short_urls_not_created_by_themselves()
    {
        $member = User::factory()->create(['role_id'=>Role::where('name','Member')->first()->id, 'company_id'=>1]);
        ShortUrl::create(['code'=>'abc','original_url'=>'https://a','created_by'=>999,'company_id'=>1,'is_public'=>false]);
        ShortUrl::create(['code'=>'def','original_url'=>'https://b','created_by'=>$member->id,'company_id'=>1,'is_public'=>false]);
        $this->actingAs($member)->getJson('/short-urls')->assertJsonCount(1,'data');
    }

    public function test_short_urls_are_not_publicly_resolvable()
    {
        ShortUrl::create(['code'=>'abc','original_url'=>'https://a','created_by'=>1,'company_id'=>1,'is_public'=>false]);
        $this->get('/r/abc')->assertStatus(404);
    }
}
