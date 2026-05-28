<main id="main" class="main">

    <div class="pagetitle">
        <h1>Update Product</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="<?= BASE_URL ?>product/update" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $product['id']; ?>" />

                            <div class="row mb-3 mt-3">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="<?= $product['name'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" value="<?= $product['description'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" name="price" value="<?= $product['price'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Stock</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" name="stock" value="<?= $product['stock'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Old Image</label>
                                <div class="col-sm-10">
                                    <img id="image-preview" src="<?= $product['image_url']; ?>" alt="Current Image" style="max-width: 200px; display: block; margin-bottom: 10px;">
                                    <input type="hidden" name="oldImage" value="<?= $product['image_url']; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Discount</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0.01" max="0.99" step="0.01" name="discount" value="<?= $product['discount'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>