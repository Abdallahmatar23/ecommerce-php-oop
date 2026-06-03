<?php
/** @var \App\Models\Order       $order      */
/** @var \App\Models\OrderItem[] $orderItems */
$statuses = ['pending', 'processing', 'shipping', 'delivered', 'canceled', 'returned'];
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order #<?= $order->getId() ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>admin/index">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>order/orders">Orders</a></li>
                <li class="breadcrumb-item active">Order #<?= $order->getId() ?></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">

            <!-- Items -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Order Items</h5>
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderItems as $item): ?>
                                    <tr>
                                        <td class="d-flex align-items-center gap-2">
                                            <img src="<?= BASE_URL . 'uploads/' . $item->getProduct()->getImage() ?>"
                                                 style="width:50px;height:50px;object-fit:cover;border-radius:6px;" alt="">
                                            <?= htmlspecialchars($item->getProduct()->getName()) ?>
                                        </td>
                                        <td><?= $item->getQuantity() ?></td>
                                        <td><?= number_format($item->getPrice(), 2) ?> EGP</td>
                                        <td><?= number_format($item->getSubTotal(), 2) ?> EGP</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total</td>
                                    <td class="fw-bold"><?= number_format($order->getTotalPrice(), 2) ?> EGP</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body p-4">
                        <h6 class="mb-3">Order Info</h6>
                        <p class="mb-1"><strong>Customer:</strong> <?= htmlspecialchars($order->getUserName() ?? '—') ?></p>
                        <p class="mb-1"><strong>Order ID:</strong> #<?= $order->getId() ?></p>
                        <p class="mb-1"><strong>Date:</strong> <?= $order->getCreatedAt() ?></p>
                        <p class="mb-1"><strong>Payment:</strong> <?= strtoupper($order->getPaymentMethod()) ?></p>
                        <p class="mb-3"><strong>Address:</strong> <?= htmlspecialchars($order->getShippingAddress()) ?></p>

                        <hr>
                        <h6 class="mb-3">Change Status</h6>
                        <form action="<?= BASE_URL ?>order/updateStatus/<?= $order->getId() ?>" method="POST">
                            <select name="status" class="form-select mb-2">
                                <?php foreach ($statuses as $s): ?>
                                    <option value="<?= $s ?>" <?= $order->getStatus() === $s ? 'selected' : '' ?>>
                                        <?= ucfirst($s) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-primary w-100">Update Status</button>
                        </form>
                    </div>
                </div>
                <a href="<?= BASE_URL ?>order/orders" class="btn btn-outline-secondary w-100">← Back to Orders</a>
            </div>

        </div>
    </section>

</main>