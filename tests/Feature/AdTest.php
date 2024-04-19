<?php


namespace Tests\Feature;

use App\Models\Ad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_ad()
    {
        $adData = [
            'title' => 'Test Ad',
            'description' => 'Ad description',
            'price' => 100.50,
            'photo' => 'https://en.wiktionary.org/wiki/kitty#/media/File:Stray_kitten_Rambo002.jpg',
            'photos' => [
                'https://www.uspca.co.uk/media/uploads/11847481931666379167768075554147634861869145o.jpg',
                'https://www.uspca.co.uk/media/uploads/11847481931666379167768075554147634861869145o.jpg',
                'https://www.uspca.co.uk/media/uploads/11847481931666379167768075554147634861869145o.jpg'
            ],
        ];

        $this->json('POST', route('ads.store'), $adData)
            ->assertStatus(201)
            ->assertJson(['status' => 'success']);
    }

    public function test_can_show_ad()
    {
        $Ad = Ad::factory()->create();

        $this->json('GET', route('ads.show', $Ad->id))
            ->assertStatus(200);
    }

    public function test_can_list_ads()
    {
        $ads = Ad::factory()->count(2)->create();

        $this->json('GET', route('ads.index'))
            ->assertStatus(200);
    }

    public function test_can_list_sort_ads()
    {
        $ads = Ad::factory()->count(2)->create();

        $this->json('GET', route('ads.index'))
            ->assertStatus(200);
    }

    public function test_ad_are_sorted_by_price_ascending()
    {
        // Ads for test
        $ad1 = Ad::factory()->create(['price' => 200]);
        $ad2 = Ad::factory()->create(['price' => 100]);
        $ad3 = Ad::factory()->create(['price' => 300]);

        // Get ads with by sort params
        $response = $this->get('/api/ad?sort_field=price&sort_order=asc');
        $ads = $response->json('data');

        $this->assertEquals($ad2->id, $ads[0]['id']);
        $this->assertEquals($ad1->id, $ads[1]['id']);
        $this->assertEquals($ad3->id, $ads[2]['id']);
    }
}
