<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th># Id</th>
                                    <th>
                                        <b>N</b>ame
                                    </th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>image</th>
                                    <th>Price After Discount</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                use App\Classes\Models\Product;

                                // var_dump(class_exists(\App\Classes\Models\Product::class));
                                // die;
                                $products = (new Product)->getAll() ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?= $product['id'] ?></td>
                                        <td><?= $product['name'] ?></td>
                                        <td><?= $product['description'] ?></td>
                                        <td><?= $product['price'] ?></td>
                                        <td><?= $product['stock'] ?></td>
                                        <td><?= $product['image_url'] ?></td>
                                        <td><?= $product['price'] * $product['discount'] ?></td>
                                        <td><?= $product['created_at'] ?></td>
                                        <td> Delete </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->