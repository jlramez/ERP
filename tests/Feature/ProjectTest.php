<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Producto;

class ProjectTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function project_can_be_created()
    {
       // $this->withoutExceptionHandling();
        $response= $this->post('/productos',[
        'contenido' => 'Estambre',
        'marcas_id' => '1',
        'tipos_id' => '1',
        'colores_id' => '1',
        'precio' => '165.50'
        ]);
        $response->assertStatus(302);
        $this->assertCount(380, Producto::all());
        $productos=Producto::first();
        $this->assertEquals($productos->contenido,'Estambre');
        $this->assertEquals($productos->marcas_id,'2');
        $this->assertEquals($productos->tipos_id,'8');
    }
}
