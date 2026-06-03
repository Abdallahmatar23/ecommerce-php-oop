<?php

if (!empty($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $oldData = $_SESSION['old'] ?? '';
}

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h2 class="mb-3">Add Product</h2>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <div class="mb-4">
                            <h5 class="mb-0">Product Information</h5>
                            <small class="text-muted">Fill all required fields below</small>
                        </div>

                        <form method="POST"
                            action="<?= BASE_URL ?>product/store"
                            enctype="multipart/form-data">

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Enter product name"
                                    value="<?= $oldData['name'] ?? '' ?>">

                                <?php showIndexedMessage('name'); ?>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text"
                                    name="description"
                                    class="form-control"
                                    placeholder="Enter product description"
                                    value="<?= $oldData['description'] ?? '' ?>">

                                <?php showIndexedMessage('description'); ?>
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number"
                                    min="1"
                                    name="price"
                                    class="form-control"
                                    placeholder="0.00"
                                    value="<?= $oldData['price'] ?? '' ?>">

                                <?php showIndexedMessage('price'); ?>
                            </div>

                            <!-- Stock -->
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number"
                                    min="0"
                                    name="stock"
                                    class="form-control"
                                    placeholder="Quantity"
                                    value="<?= $oldData['stock'] ?? '' ?>">

                                <?php showIndexedMessage('stock'); ?>
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file"
                                    name="image"
                                    class="form-control">

                                <?php showIndexedMessage('image'); ?>
                            </div>

                            <!-- Discount -->
                            <div class="mb-4">
                                <label class="form-label">Discount</label>
                                <input type="number"
                                    min="0.01"
                                    max="0.99"
                                    step="0.01"
                                    name="discount"
                                    class="form-control"
                                    placeholder="0.00"
                                    value="<?= $oldData['discount'] ?? '' ?>">

                                <?php showIndexedMessage('discount'); ?>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between align-items-center">

                                <a href="<?= BASE_URL ?>product/products"
                                    class="btn btn-outline-secondary">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="btn btn-primary px-4">
                                    Add Product
                                </button>

                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
unset($_SESSION['errors']);
?>