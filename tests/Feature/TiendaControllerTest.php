<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tienda;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TiendaControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_listado_libros(): void
{
    $response1 = $this->get('/tienda');
    $response1->assertRedirect('/login');

    $this->actingAs($user = User::factory()->create());

    $response2 = $this->get('/tienda');
    $response2->assertStatus(200)
        ->assertSee('Listado de Libros');
}

public function test_creacion_registro(): void
{
    
    $this->actingAs($user = User::factory()->create());

    
    $archivoSimulado = UploadedFile::fake()->image('archivo.jpg');

    
    $response = $this->post('/tienda', [
        'titulo' => 'Título del libro',
        'autor' => 'Autor del libro',
        'editorial' => 'Editorial del libro',
        'precio' => 100,
        'archivo' => $archivoSimulado,
    ]);

    
    $nombreArchivo = $archivoSimulado->getClientOriginalName();

    
    $tipoMIME = $archivoSimulado->getMimeType();

    
    $ubicacionArchivo = 'public/archivos_tienda/' . $nombreArchivo;

    
    $this->assertDatabaseHas('archivos', [
        'nombre_original' => $nombreArchivo,
        'mime' => $tipoMIME,
    ]);

    
    $response->assertRedirect('/tienda');

    
    $this->assertDatabaseHas('tiendas', [
        'titulo' => 'Título del libro',
        'autor' => 'Autor del libro',
        'editorial' => 'Editorial del libro',
        'precio' => 100,
        
    ]);
}

public function test_creacion_registro_con_informacion_incorrecta_o_faltante()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post('/tienda', []);

        $response->assertRedirect();

        $errors = session('errors');

        $this->assertNotNull($errors);
        $this->assertTrue($errors->has('archivo'));
        $this->assertTrue($errors->has('titulo'));
        $this->assertTrue($errors->has('autor'));
        $this->assertTrue($errors->has('editorial'));
        $this->assertTrue($errors->has('precio'));

        $response->assertSessionHasErrors();
    }

    public function test_eliminar_registro(): void
    {
        $this->actingAs(User::factory()->create());

        $tienda = Tienda::factory()->create(['user_id' => auth()->id()]);

        $response = $this->delete('/tienda/' . $tienda->id);

        $response->assertRedirect('/tienda');

        $this->assertSoftDeleted('tiendas', ['id' => $tienda->id]);
    }
}
