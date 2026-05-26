<?php

namespace App\Classes\Controllers;

// use App\Classes\Database;
use App\Classes\Models\Product;



class ProductController
{
    public function __construct(private ?Product $repo = null) {}

    public function store()
    {

        if (isset($_POST['create'])) {
            $data = $_POST;
            if (!empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../uploads/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $imageName = time() . '_' . $_FILES['image']['name'];
                $tmp = $_FILES['image']['tmp_name'];

                move_uploaded_file($tmp, $uploadDir . $imageName);

                $data['image'] = $imageName;
            }
            $this->repo->create($data);
            header('Location: index.php?page=products&alert=success');
            // header('Location: index.php?page=view-products&alert=success');
            exit;
            // echo "Product created Successfully.";
        }
    }

    public function create()
    {
        include '../../views/products/create_product.php';
    }
    public function delete()
    {

        if (isset($_POST['delete'])) {
            $id = $_POST['id'];
            $this->repo->delete($id);
            header('Location: index.php?page=products&alert=success');
            // header('Location: index.php?page=view-products&alert=success');
            exit;
            // echo "Product Delete Successfully.";
        }
    }
    public function update()
    {

        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $this->repo->update($id, $_POST);
            header('Location: index.php?page=products&alert=success');
            // header('Location: index.php?page=view-products&alert=success');
            exit;
            // echo "Product Updated Successfully.";
        }
    }

    public function index()
    {
        $products = $this->repo->getAllProducts();
        include '../../views/products.php';
    }
}
