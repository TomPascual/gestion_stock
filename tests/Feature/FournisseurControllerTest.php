<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Fournisseur;

/**
 * Class FournisseurControllerTest
 *
 * Teste les fonctionnalités du contrôleur FournisseurController.
 *
 * @package Tests\Feature
 */
class FournisseurControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Crée un fournisseur via la factory pour les tests.
     *
     * @return \App\Models\Fournisseur
     */
    private function createFournisseur()
    {
        return Fournisseur::factory()->create();
    }

    /**
     * Vérifie que la liste des fournisseurs est bien affichée.
     *
     * @return void
     */
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

    /**
     * Vérifie que le formulaire de création est bien accessible.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_fournisseur_creation_form()
    {
        $response = $this->get('/fournisseurs/create');
        $response->assertStatus(200);
    }

    /**
     * Vérifie qu’un nouveau fournisseur peut être enregistré.
     *
     * @return void
     */
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
        $response->assertStatus(302); // redirection après création
        $this->assertDatabaseHas('fournisseurs', ['nom' => 'Nouveau Fournisseur']);
    }

    /**
     * Vérifie que la vue d’un fournisseur spécifique s’affiche correctement.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_a_specific_fournisseur()
    {
        $fournisseur = $this->createFournisseur();
        $response = $this->get("/fournisseurs/{$fournisseur->id}");
        $response->assertStatus(200);
        $response->assertViewHas('fournisseur');
    }

    /**
     * Vérifie que le formulaire d’édition d’un fournisseur s’affiche.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_fournisseur_edit_form()
    {
        $fournisseur = $this->createFournisseur();
        $response = $this->get("/fournisseurs/{$fournisseur->id}/edit");
        $response->assertStatus(200);
        $response->assertViewHas('fournisseur');
    }

    /**
     * Vérifie que les données d’un fournisseur peuvent être mises à jour.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_a_fournisseur()
    {
        $fournisseur = $this->createFournisseur();
        $updatedData = [
            'nom' => 'Fournisseur Modifié',
            'email' => $fournisseur->email, // éviter erreur de contrainte unique
            'telephone' => $fournisseur->telephone,
            'adresse' => $fournisseur->adresse
        ];

        $response = $this->put("/fournisseurs/{$fournisseur->id}", $updatedData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('fournisseurs', ['nom' => 'Fournisseur Modifié']);
    }

    /**
     * Vérifie qu’un fournisseur peut être supprimé.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_a_fournisseur()
    {
        $fournisseur = $this->createFournisseur();
        $response = $this->delete("/fournisseurs/{$fournisseur->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('fournisseurs', ['id' => $fournisseur->id]);
    }
}
