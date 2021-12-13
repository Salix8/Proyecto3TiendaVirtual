<?php
    namespace ProyectoWeb\app\controllers;

    use Psr\Container\ContainerInterface;
    use ProyectoWeb\entity\Product;
    use ProyectoWeb\exceptions\QueryException;
    use ProyectoWeb\exceptions\NotFoundException;
    use ProyectoWeb\database\Connection;
use ProyectoWeb\repository\CategoryRepository;
use ProyectoWeb\repository\ProductRepository;

    class ProductController {

        protected $container;

        //Constructor recives container instance
        public function __construct(ContainerInterface $container) {
            $this->container = $container;
        }

        public function ficha($request, $response, $args) {
            extract($args);

            $repositorio = new ProductRepository();

            try {
                $producto = $repositorio->findById($id);
            } catch (NotFoundException $nfe) {
                return $response->write("Producto no enconrtrado");
            }
            $title = $producto->getNombre();
            $relacionados = $repositorio->getRelacionados($producto->getId(), $producto->getIdCategoria());

            return $this->container->renderer->render($response, "product.view.php", compact("title", "producto", "relacionados"));
        }
    }