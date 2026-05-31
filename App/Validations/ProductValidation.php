<?php


namespace App\Validations;

use App\Models\Product;
use finfo;

class ProductValidation extends Product
{

    private string $name;
    private string $description;
    private string $price;
    private string $image;
    private int $stock;
    private string $discount;

    private ?array $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function validateRequired(string $filedName, mixed $value)
    {
        if ($value === null || $value === '') {
            return ucfirst($filedName) . " Is Required !";
        }
        return null;
    }
    public function validateName(string $name)
    {
        if (strlen($name) < 2) {
            return "Name Must Be More Than 2 Characters !";
        }
        if (strlen($name) > 255) {
            return "Name Must Be Less Than 255 Characters !";
        }
        return null;
    }
    public function validateDescription(string $description)
    {
        if (strlen($description) < 5) {
            return "Name Must Be More Than 5 Characters !";
        }
        if (strlen($description) > 255) {
            return "Name Must Be Less Than 255 Characters !";
        }
        return null;
    }
    public function validatePrice(string $price)
    {
        if (!is_numeric($price)) {
            return "Enter a valid number !";
        }

        if ($price < 0) {
            return "Price cannot be negative !";
        }

        if (!preg_match('/^\d+(\.\d{1,2})?$/', $price)) {
            return "Max 2 decimal places allowed !";
        }
        return null;
    }
    public function validateImage(array $image)
    {
        if (!isset($image['error']) || $image['error'] !== UPLOAD_ERR_OK) {
            return "Error uploading image";
        }

        $maxSize = 2 * 1024 * 1024;

        if ($image['size'] > $maxSize) {
            return "Image size must be less than 2MB";
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($image['tmp_name']);

        if (!in_array($mime, $allowedTypes)) {
            return "Only JPG, PNG, WEBP allowed";
        }

        return null;
    }
    public function validateStock(int $stock)
    {
        if (!is_numeric($stock) && $stock < 1) {
            return "Stock Must be At least one item !";
        }
        return null;
    }
    public function validateDiscount(string $discount)
    {
        if ($discount < 0 || $discount > 100) {
            return "Discount Must be More Than 0 % And less Than 100 % !";
        }
        return null;
    }
    public function productValidator(array $data, string $action)
    {
        $this->errors = [];
        $validators = [
            'name'        => 'validateName',
            'description' => 'validateDescription',
            'price'       => 'validatePrice',
            'image'       => 'validateImage',
            'stock'       => 'validateStock',
            'discount'    => 'validateDiscount'
        ];

        foreach ($validators as $field => $method) {
            $value = $data[$field] ?? null;
            if ($field === 'image' && $action === 'update' && isset($value['error']) && $value['error'] === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            if ($error = $this->validateRequired($field, $value)) {
                $this->errors[$field][] = $error;
                continue;
            }
            if ($error = $this->$method($value)) {
                $this->errors[$field][] = $error;
            }
        }

        return $this->errors;





        // foreach ($data as $key => $val) {
        //     if ($error = $this->validateRequired($key, $val)) {
        //         $this->errors[$key][] = $error;
        //     }
        //     switch ($key) {
        //         case ('name'):
        //             $this->errors['name'][] = $this->validateName($val);
        //             break;
        //         case ('description'):
        //             $this->errors['description'][] = $this->validateDescription($val);
        //             break;
        //         case ('price'):
        //             $this->errors['price'][] = $this->validatePrice($val);
        //             break;
        //         case ('image'):
        //             $this->errors['image'][] = $this->validateImage($data['image']);
        //             break;
        //         case ('stock'):
        //             $this->errors['stock'][] = $this->validateStock($val);
        //             break;
        //         case ('discount'):
        //             $this->errors['discount'][] = $this->validateDiscount($val);
        //             break;
        //     }
        // }
        // if ($data['name']) {
        //     $this->errors['name'][] = $this->validateName($data['name']);
        // }
        // if ($data['description']) {
        //     $this->errors['description'][] = $this->validateDescription($data['description']);
        // }
        // if ($data['price']) {
        //     $this->errors['price'][] = $this->validatePrice($data['price']);
        // }
        // if ($data['image']) {
        //     $this->errors['image'][] = $this->validateImage($data['image']);
        // }
        // if ($data['stock']) {
        //     $this->errors['stock'][] = $this->validateStock($data['stock']);
        // }
        // if ($data['discount']) {
        //     $this->errors['discount'][] = $this->validateDiscount($data['discount']);
        // }
        // return $this->errors;
    }
}
