<?php

namespace App\Controllers;

// use App\Database;

use App\Core\Controller;
use App\Core\Session\Session;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Repositories\CartItemRepository;
use App\Validations\ProductValidation;

class ProductController extends Controller
{
    private ?ProductRepository $repo = null;
    private ?ProductValidation $validator = null;
    public function __construct()
    {
        $this->repo = new ProductRepository();
        $this->validator = new ProductValidation();
    }

    public function index()
    {
        $products = $this->repo->getAll() ?? [];

        return $this->view('store/home', [
            'products' => $products
        ]);
        // $products = $this->repo->getAll();
        // $this->view("admin/products", ['products' => $products]);
        // include '../../views/products.php';
    }
    public function products()
    {
        $products = $this->repo->getAll() ?? [];

        return $this->view('admin/products', [
            'products' => $products
        ]);
        // $products = $this->repo->getAll();
        // $this->view("admin/products", ['products' => $products]);
        // include '../../views/products.php';
    }
    public function details(int $product_id)
    {
        $qty = 0;

        if (Session::check("user")) {

            $cartItem = (new CartItemRepository())
                ->getCartItem(
                    Session::get('user')['id'],
                    $product_id
                );

            if ($cartItem) {

                $product = $cartItem->getProduct();
                $qty = $cartItem->getQty();
            } else {

                $product = $this->repo->getById($product_id);
            }
        } else {

            $product = $this->repo->getById($product_id);
        }

        if (!$product) {
            http_response_code(404);
            return $this->view('store/404');
        }

        $this->view(
            'store/product-details',
            [
                'product' => $product,
                'qty' => $qty
            ]
        );
    }
    public function create()
    {
        $this->view("admin/add-product");
    }
    public function edit(int $id)
    {
        $product = $this->repo->getById($id);

        if (!$product) {
            Session::set('error', 'Product not found');
            redirect('/product/products');
        }

        $this->view(
            'admin/edit-product',
            [
                'product' => $product
            ]
        );
    }
    public function uploadImage(array $imageData)
    {
        if (empty($imageData['name'])) {
            return null;
        }

        $uploadDir = __DIR__ . '/../uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $extension = pathinfo(
            $imageData['name'],
            PATHINFO_EXTENSION
        );

        $imageName =
            uniqid('product_', true)
            . '.'
            . $extension;

        $tmp = $imageData['tmp_name'];

        move_uploaded_file(
            $tmp,
            $uploadDir . $imageName
        );

        return $imageName;
    }
    public function store()
    {
        $data = $_POST;

        $allData = [
            'name'        => trim($data['name'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'price'       => $data['price'] ?? '',
            'image'       => $_FILES['image'] ?? null,
            'stock'       => $data['stock'] ?? '',
            'discount'    => $data['discount'] ?? '',
        ];

        $errors = $this->validator->productValidator($allData, 'create');

        if (!empty($errors)) {

            Session::set('errors', $errors);

            Session::set('old', [
                'name'        => $allData['name'],
                'description' => $allData['description'],
                'price'       => $allData['price'],
                'stock'       => $allData['stock'],
                'discount'    => $allData['discount'],
            ]);

            redirect('/product/create');
        }

        $imageName = $this->uploadImage($_FILES['image']);

        $success = $this->repo->add(
            $allData['name'],
            $allData['description'],
            (float)$allData['price'],
            $imageName,
            (int)$allData['stock'],
            (float)$allData['discount']
        );

        if($success){

            Session::set('success', 'Product created successfully');
            unset($_SESSION['errors']);
            redirect('/product/products');
        }
    }

    public function update()
    {
        $data = $_POST;

        $allData = [
            'name'        => trim($data['name'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'price'       => $data['price'] ?? '',
            'image'       => $_FILES['image'] ?? null,
            'stock'       => $data['stock'] ?? '',
            'discount'    => $data['discount'] ?? '',
        ];

        $errors = $this->validator->productValidator($allData, 'update');

        if (!empty($errors)) {

            Session::set('errors', $errors);

            Session::set('old', [
                'name'        => $allData['name'],
                'description' => $allData['description'],
                'price'       => $allData['price'],
                'stock'       => $allData['stock'],
                'discount'    => $allData['discount'],
            ]);

            redirect('/product/edit/' . $data['id']);
        }

        $imageName = $data['oldImage'];

        if (
            isset($_FILES['image']) &&
            $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            $imageName = $this->uploadImage($_FILES['image']);
        }

        $this->repo->update(
            (int)$data['id'],
            $allData['name'],
            $allData['description'],
            (float)$allData['price'],
            $imageName,
            (int)$allData['stock'],
            (float)$allData['discount']
        );

        Session::set('success', 'Product updated successfully');

        redirect('/product/products');
    }

    public function delete()
    {
        $id = (int) $_POST['id'];

        $this->repo->delete($id);

        Session::set('success', 'Product deleted successfully');

        redirect('/product/products');
    }







    // public function update()
    // {

    //     $data = $_POST;

    //     $allData = [
    //         'id' => $data['id'],
    //         'name' => (trim($data['name']) ?? ''),
    //         'description' => (trim($data['description']) ?? ''),
    //         'price'       => (trim($data['price']) ?? ''),
    //         'image'       => $_FILES['image'] ?? null,
    //         'stock'       => trim($data['stock']) ?? '',
    //         'discount'    => trim($data['discount']) ?? ''
    //     ];

    //     $errors = $this->validator->productValidator($allData, 'update');

    //     if (!empty($errors)) {
    //         Session::set('errors', $errors);
    //         Session::set('old', [
    //             'name' => $allData['name'],
    //             'description' => $allData['description'],
    //             'price' => $allData['price'],
    //             'image' => $allData['image'],
    //             'stock' => $allData['stock'],
    //             'discount' => $allData['discount'],
    //         ]);
    //         redirect('product/edit');
    //     }

    //     $imageName = $this->uploadImage($_FILES['image']);


    //     $this->repo->update(
    //         $allData['id'],
    //         $allData['name'],
    //         $allData['description'],
    //         (float)$allData['price'],
    //         $imageName,
    //         (int)$allData['stock'],
    //         (float)$allData['discount']
    //     );

    //     Session::set('success', 'Product created successfully');

    //     redirect('/product/index');
    //     // redirect('/admin/products');








    //     // var_dump($data);
    //     // die();
    //     // $id = $data['id'];
    //     // $name = $data['name'];
    //     // $description = $data['description'];
    //     // $price = $data['price'];
    //     // $stock = $data['stock'];
    //     // if (!empty($_FILES['image']['name'])) {
    //     //     $image = $this->uploadImage($_FILES['image']);
    //     // } else {
    //     //     $image = $data['oldImage'];
    //     // }
    //     // $discount = $data['discount'];
    //     // $this->repo->update($id, $name, $description, $price, $image, $stock, $discount);
    //     // header("Location: {$this->view('admin/products')}");
    //     // // header('Location: index.php?page=view-products&alert=success');
    //     // exit;
    // }
}
