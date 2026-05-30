<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Product</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="<?= BASE_URL ?>product/store" enctype="multipart/form-data">
                        <!-- <form method="POST" action="http://localhost/ecommerce/public/product/store" enctype="multipart/form-data"> -->

                            <div class="row mb-3 mt-3">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" name="price" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Stock</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" name="stock" class="form-control">
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
                                    <input type="number" min="0.01" max="0.99" step="0.01" name="discount" class="form-control">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>