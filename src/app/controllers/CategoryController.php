<?php
    namespace ProyectoWeb\app\controllers;

    use Psr\Container\ContainerInterface;
    use ProyectoWeb\entity\Product;
    use ProyectoWeb\exceptions\QueryException;
    use ProyectoWeb\exceptions\NotFoundException;
    use ProyectoWeb\database\Connection;
    use ProyectoWeb\repository\CategoryRepository;
    use ProyectoWeb\repository\ProductRepository;
    use JasonGrimes\Paginator;
    use ProyectoWeb\core\App;

    class CategoryController {

        protected $container;

        //Constructor recives container instance
        public function __construct(ContainerInterface $container) {
            $this->container = $container;
        }

        public function listado($request, $response, $args) {
            extract($args);
    
            $repositorio = new CategoryRepository();
            try {
                //Se llama $categoriaActual y no $categoria porque en el partial category.part.php ya usamos una variable con el mismo nombre.
                $categoriaActual = $repositorio->findById($id);
            } catch (\NotFoundException $nfe) {
                return $response->write("Categoría no encontrada");
            }
    
            $title = $categoriaActual->getNombre();
            $repositorioProductos = new ProductRepository();

            //datos del paginador
            $currentPage = ($currentPage ?? 1);
            $totalItems = $repositorioProductos->getCountByCategory($categoriaActual->getId());
            $itemsPerPage = App::get('config')['itemsPerPage'];
            $urlPattern = $this->container->router->pathFor('categoria', 
            ['nombre' =>  \ProyectoWeb\app\utils\Utils::encodeURI($categoriaActual->getNombre()),
             'id' => $categoriaActual->getId()
            ]) .
            '/page/(:num)';

            $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
            $productos = $repositorioProductos->getByCategory($categoriaActual->getId(), $itemsPerPage, $currentPage);
            $categorias = $repositorio->findAll();
    
            return $this->container->renderer->render($response, "categoria.view.php", compact('title', 'categorias', 'categoriaActual', 'productos'));
        }
    }