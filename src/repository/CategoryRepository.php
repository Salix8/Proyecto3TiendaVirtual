<?php
namespace ProyectoWeb\repository;

use NotFoundException;
use ProyectoWeb\database\QueryBuilder;
use Slim\Handlers\NotFound;

class CategoryRepository extends QueryBuilder
{
    public function __construct(){
        parent::__construct('categorias', 'Category');
    }

    public function listado($request, $response, $args) {
        extract($args);

        try {
            //Se llama $categoriaActual y no $categoria porque en el partial category.part.php ya usamos una variable con el mismo nombre.
            $categoriaActual = $repositorio->findById($id);
        } catch (NotFoundException $nfe) {
            return $response->write("Categoría no encontrada");
        }

        $title = $categoriaActual->getNombre();

        $repositorioProductos = new ProductRepository();
        $productos = $repositorioProductos->getByCategory($categoriaActual->getId());
        $categorias = $repositorio->findAll();

        return $this->container->renderer->render($response, "categoria.view.php", compact('title', 'categorias', 'categoriaActual', 'productos'));
    }
}