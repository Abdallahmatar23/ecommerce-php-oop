<?php

namespace App\Controllers;

// use App\Database;

use App\Core\Controller;
use App\Models\Product;
use App\Models\ProductRepository;

class ProductController extends Controller
{
    private ?ProductRepository $repo = null;
    private ?Product $product = null;
    public function __construct()
    {
        $this->repo = new ProductRepository();
        $this->product = new Product();
    }

    public function index()
    {
        $products = $this->repo->getAll();
        // $created_at = $this->repo->getCreationTime();
        $this->view("admin/products", ['products' => $products]);
        // include '../../views/products.php';
    }
    public function details(int $id)
    {
        // $id = $_POST['id'];
        // $product = $this->repo->getObjectById($id);
        $product = $this->repo->getById($id);
        // var_dump($product);
        // die;
        $this->view("store/product-details", ['product' => $product]);
        // include '../../views/products.php';
    }
    public function create()
    {
        $this->view("admin/add-product");
        // include '../../views/products/create_product.php';
    }

    public function edit(int $id)
    {
        // $id = $_POST['id'];
        // var_dump($id);
        // die();
        $product = $this->repo->getById($id);
        // var_dump($product);
        // die();
        $this->view("admin/edit-product", ['product' => $product]);
        // include '../../views/products.php';
    }
    public function uploadImage(array $imageData)
    {
        // $imageData  == $_FILES[image]
        if (!empty($imageData['name'])) {
            $uploadDir = __DIR__ . '/../uploads/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imageName = time() . '_' . $imageData['name'];
            $tmp = $imageData['tmp_name'];

            move_uploaded_file($tmp, $uploadDir . $imageName);

            return $imageName;
        }
    }
    public function store()
    {

        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // die;
        // var_dump($data);
        // die();
        $data = $_POST;

        $image = $this->uploadImage($_FILES['image']);
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $stock = $data['stock'];
        $discount = $data['discount'];
        $this->repo->add($name, $description, $price, $image, $stock, $discount);
        header("Location: {$this->view('admin/products')}");
        exit;
        // echo "Product created Successfully.";

    }

    public function delete()
    {


        $id = $_POST['id'];
        $this->repo->delete($id);
        header("Location: {$this->view('admin/products')}");
        // header('Location: index.php?page=view-products&alert=success');
        exit;
    }
    public function update()
    {

        $data = $_POST;
        // var_dump($data);
        // die();
        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $stock = $data['stock'];
        if (!empty($_FILES['image']['name'])) {
            $image = $this->uploadImage($_FILES['image']);
        }else{
            $image = $data['oldImage'];
        }
        $discount = $data['discount'];
        $this->repo->update($id, $name, $description, $price, $image, $stock, $discount);
        header("Location: {$this->view('admin/products')}");
        // header('Location: index.php?page=view-products&alert=success');
        exit;
    }
}
