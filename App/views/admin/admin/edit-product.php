<?php

/** @var \App\Models\Product $product */

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h2 class="mb-3">Update Product</h2>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <div class="mb-4">
                            <h5 class="mb-0">Edit Product Information</h5>
                            <small class="text-muted">Update the required fields below</small>
                        </div>

                        <form method="POST"
                            action="<?= BASE_URL ?>product/update"
                            enctype="multipart/form-data">

                            <input type="hidden" name="id"
                                value="<?= $product->getId(); ?>">

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text"
                                    name="name"
                                    value="<?= htmlspecialchars($product->getName()) ?>"
                                    class="form-control">

                                <?php showIndexedMessage('name'); ?>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text"
                                    name="description"
                                    value="<?= htmlspecialchars($product->getDescription()) ?>"
                                    class="form-control">

                                <?php showIndexedMessage('description'); ?>
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number"
                                    min="1"
                                    name="price"
                                    value="<?= $product->getPrice() ?>"
                                    class="form-control">

                                <?php showIndexedMessage('price'); ?>
                            </div>

                            <!-- Stock -->
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number"
                                    min="0"
                                    name="stock"
                                    value="<?= $product->getStock() ?>"
                                    class="form-control">

                                <?php showIndexedMessage('stock'); ?>
                            </div>

                            <!-- Old Image -->
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>

                                <div class="mb-2">
                                    <img src="<?= BASE_URL . 'uploads/' . $product->getImage() ?>"
                                        alt="Product Image"
                                        style="width:120px;height:120px;object-fit:cover;border-radius:8px;">
                                </div>

                                <input type="hidden"
                                    name="oldImage"
                                    value="<?= $product->getImage(); ?>">
                            </div>

                            <!-- New Image -->
                            <div class="mb-3">
                                <label class="form-label">Change Image</label>
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
                                    value="<?= $product->getDiscount() ?>"
                                    class="form-control">

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
                                    Update Product
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
if (!empty($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

?>