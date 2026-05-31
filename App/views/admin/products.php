<?php showSuccessMessage();
$products = $products ?? [] ;
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Products</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= BASE_URL . '/admin/dashboard' ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="mb-0">Products List</h3>

                            <a href="<?= BASE_URL ?>product/create" class="btn btn-success">
                                <i class="bi bi-plus-circle me-1"></i>
                                Add Product
                            </a>
                        </div>

                        <!-- Table -->
                        <table class="table table-hover table-striped align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Image</th>
                                    <th>After Discount</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($products as $product): ?>

                                    <tr>
                                        <td><?= $product->getId() ?></td>

                                        <td><?= htmlspecialchars($product->getName()) ?></td>

                                        <td>
                                            <?= htmlspecialchars($product->getDescription()) ?>
                                        </td>

                                        <td>
                                            <?= number_format($product->getPrice(), 2) ?> EGP
                                        </td>

                                        <td><?= $product->getStock() ?></td>

                                        <td>
                                            <img
                                                src="<?= BASE_URL . 'uploads/' . $product->getImage() ?>"
                                                alt="product"
                                                style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                        </td>

                                        <td>
                                            <?= number_format($product->priceAfterDiscount(), 2) ?> EGP
                                        </td>

                                        <td>
                                            <?php
                                            $created = (new \App\Repositories\ProductRepository())
                                                ->getCreationTime($product->getId());

                                            echo $created['created_at'] ?? '';
                                            ?>
                                        </td>

                                        <td>

                                            <div class="btn-group">

                                                <a href="<?= BASE_URL ?>product/edit/<?= $product->getId() ?>"
                                                    class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>

                                                <form method="POST"
                                                    action="<?= BASE_URL ?>product/delete/<?= $product->getId() ?>"
                                                    onsubmit="return confirm('Are you sure you want to delete this product?')">

                                                    <input type="hidden" name="id"
                                                        value="<?= $product->getId() ?>">

                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>