<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\MouvementStock;

/**
 * Class MouvementStockControllerTest
 *
 * Teste l'affichage de la liste des mouvements de stock via le contrôleur.
 *
 * @package Tests\Feature
 */
class MouvementStockControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Vérifie que la page des mouvements de stock s'affiche correctement.
     *
     * @return void
     */
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
