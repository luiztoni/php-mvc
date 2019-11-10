<?php

namespace Demo\PhpMvc\Controllers;

use Demo\PhpMvc\Models\Product;
use Demo\PhpMvc\Repositories\ProductRepository as Repository;

class ProductsController extends Controller
{
    private $repository;

    public function index()
    {
        $this->repository = new Repository;
        $products = $this->repository->index();
        include_once($this->getViewPath("products/index.phtml"));
    }
    
    public function show($id = null)
    {   
        if (!$id) {
            return $this->index();
        }
        
        $this->repository = new Repository;
        $product = $this->repository->read($id);
    
        if (!$product) {
            return $this->index();
        }

        include_once($this->getViewPath("products/show.phtml"));
    }

    public function create()
    {
        include_once($this->getViewPath("products/create.phtml"));
    }

    public function search()
    {
        $this->repository = new Repository;
        $param = filter_input(INPUT_GET, 'search');
        $products = $this->repository->find($param);
        include_once($this->getViewPath("products/index.phtml"));
    }

    public function edit($id = null)
    {
        if (!$id) {
            return $this->index();
        }
     
        $this->repository = new Repository;
        $product = $this->repository->read($id);

        if (!$product) {
            return $this->index();
        }
        include_once($this->getViewPath("products/edit.phtml"));
    }

    public function store()
    {
        $name = filter_input(INPUT_POST, 'name');
        $price = filter_input(INPUT_POST, 'price');
        $product = new Product(null, $name, $price);
        $this->repository = new Repository;
        $this->repository->create($product);
        $this->index();  
    }

    public function update($id = null)
    {
        
        if (!$id) {
            return $this->index();
        }

        $this->repository = new Repository;
        $product = $this->repository->read($id);
        if (!$product) {
            return $this->index();
        }
        
        if ($_POST["_method"] === 'PUT') {
            $name = filter_input(INPUT_POST, 'name');
            $price = filter_input(INPUT_POST, 'price');
        
            $product->setName($name);
            $product->setPrice($price);
            $this->repository->update($id, $product);
        }    
        $this->index();
    }

    public function destroy($id = null)
    {
        if (!$id) {
            return $this->index();
        }
        
        if ($_POST["_method"] === 'DELETE') {
            $this->repository = new Repository;
            $this->repository->delete($id);
        }
        $this->index();
    }
}
