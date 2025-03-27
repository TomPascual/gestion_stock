<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Fournisseur;

class FournisseurControllerTest extends TestCase
{
    use RefreshDatabase;

    private function createFournisseur()
    {
        return Fournisseur::factory()->create();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_list_of_fournisseurs()
    {
        $this->createFournisseur();
        $this->createFournisseur();
        $this->createFournisseur();

        $response = $this->get('/fournisseurs');
        $response->assertStatus(200);
        $response->assertViewHas('fournisseurs');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_fournisseur_creation_form()
    {
        $response = $this->get('/fournisseurs/create');
        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_a_new_fournisseur()
    {
        $data = [
            'nom' => 'Nouveau Fournisseur',
            'email' => 'fournisseur@test.com',
            'telephone' => '0102030405',
            'adresse' => '12 rue des tests'
        ];

        $response = $this->post('/fournisseurs', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('fournisseurs', ['nom' => 'Nouveau Fournisseur']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_a_specific_fournisseur()
    {
        $fournisseur = $this->createFournisseur();
        $response = $this->get("/fournisseurs/{$fournisseur->id}");
        $response->assertStatus(200);
        $response->assertViewHas('fournisseur');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_fournisseur_edit_form()
    {
        $fournisseur = $this->createFournisseur();
        $response = $this->get("/fournisseurs/{$fournisseur->id}/edit");
        $response->assertStatus(200);
        $response->assertViewHas('fournisseur');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_a_fournisseur()
    {
        $fournisseur = $this->createFournisseur();
        $updatedData = [
            'nom' => 'Fournisseur Modifié',
            'email' => $fournisseur->email, // éviter erreur unique
            'telephone' => $fournisseur->telephone,
            'adresse' => $fournisseur->adresse
        ];

        $response = $this->put("/fournisseurs/{$fournisseur->id}", $updatedData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('fournisseurs', ['nom' => 'Fournisseur Modifié']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_a_fournisseur()
    {
        $fournisseur = $this->createFournisseur();
        $response = $this->delete("/fournisseurs/{$fournisseur->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('fournisseurs', ['id' => $fournisseur->id]);
    }
}
