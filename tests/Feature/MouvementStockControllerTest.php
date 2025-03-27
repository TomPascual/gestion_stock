<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\MouvementStock;

class MouvementStockControllerTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_list_of_stock_movements()
    {
        // Création de quelques mouvements de stock
        MouvementStock::factory()->count(5)->create();

        $response = $this->get('/mouvements');
        $response->assertStatus(200);
        $response->assertViewHas('mouvements');
    }
}
