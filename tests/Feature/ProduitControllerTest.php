<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Fournisseur;

class ProduitControllerTest extends TestCase
{
    use RefreshDatabase;

    private function createProduit()
    {
        return Produit::factory()->create();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_list_of_products()
    {
        $this->createProduit();
        $this->createProduit();
        $this->createProduit();

        $response = $this->get('/produits');
        $response->assertStatus(200);
        $response->assertViewHas('produits');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_product_creation_form()
    {
        $response = $this->get('/produits/create');
        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_a_new_product()
    {
        $categorie = Categorie::factory()->create();
        $fournisseur = Fournisseur::factory()->create();

        $data = [
            'nom' => 'Produit Test',
            'prix' => 49.99,
            'quantite' => 10,
            'categorie_id' => $categorie->id,
            'fournisseur_id' => $fournisseur->id,
        ];

        $response = $this->post('/produits', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('produits', ['nom' => 'Produit Test']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_a_specific_product()
    {
        $produit = $this->createProduit();
        $response = $this->get("/produits/{$produit->id}");
        $response->assertStatus(200);
        $response->assertViewHas('produit');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_product_edit_form()
    {
        $produit = $this->createProduit();
        $response = $this->get("/produits/{$produit->id}/edit");
        $response->assertStatus(200);
        $response->assertViewHas('produit');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_a_product()
    {
        $produit = $this->createProduit();

        $updatedData = [
            'nom' => 'Produit Modifié',
            'prix' => $produit->prix,
            'quantite' => $produit->quantite,
            'categorie_id' => $produit->categorie_id,
            'fournisseur_id' => $produit->fournisseur_id,
        ];
        
        $response = $this->put("/produits/{$produit->id}", $updatedData);
        $response->assertStatus(302);
        
        $this->assertDatabaseHas('produits', ['nom' => 'Produit Modifié']);
        
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_a_product()
    {
        $produit = $this->createProduit();
        $response = $this->delete("/produits/{$produit->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('produits', ['id' => $produit->id]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_product_mouvements()
    {
        $produit = $this->createProduit();
        $response = $this->get("/produits/{$produit->id}/mouvements");
        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_add_mouvement_to_product()
    {
        $produit = $this->createProduit();
        $data = [
            'type' => 'entree',
            'quantite' => 5,
        ];
        $response = $this->post("/produits/{$produit->id}/ajouter-mouvement", $data);
        $response->assertStatus(302);
    }
}
