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

                                // use App\Models\ProductRepository;

                                // var_dump(class_exists(\App\Models\ProductRepository::class));
                                // var_dump($products);
                                // die;
                                // $products = (new ProductRepository)->getAll() ?>
                                <?php foreach ($products as $product): ?>
                                    <?php  ?>
                                    <tr>
                                        <td><?= $product->getId() ?></td>
                                        <td><?= $product->getName() ?></td>
                                        <td><?= $product->getDescription() ?></td>
                                        <td><?= $product->getPrice() ?></td>
                                        <td><?= $product->getStock() ?></td>
                                        <td><?= $product->getImage() ?></td>
                                        <td><?= $product->priceAfterDiscount() ?></td>
                                        <td><?= $product->getCreatedAt() ?></td>
                                        <!-- <td><? //= (new ProductRepository())->getCreationTime($product->getId())['created_at'] ?></td> -->
                                        <td>
                                            <form method="POST" action="<?= BASE_URL ?>product/edit/<?= $product->getId() ?>">
                                                <input type="hidden" name="id" value="<?= $product->getId() ?>">
                                                <button type="submit" name="edit" class="btn btn-primary btn-sm">
                                                    edit
                                                </button>
                                            </form>
                                            <form method="POST" action="<?= BASE_URL ?>product/delete/<?= $product->getId() ?>">
                                                <input type="hidden" name="id" value="<?= $product->getId() ?>">
                                                <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
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