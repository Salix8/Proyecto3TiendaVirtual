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
}