<?php

/** @var \App\Models\Order[] $allOrders */
$allOrders = $allOrders ?? [];
showSuccessMessage();

$statusColors = [
    'pending'    => 'warning',
    'processing' => 'info',
    'shipping'   => 'primary',
    'delivered'  => 'success',
    'canceled'   => 'danger',
    'returned'   => 'secondary',
];
$statuses = ['pending', 'processing', 'shipping', 'delivered', 'canceled', 'returned'];
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Orders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>admin/index">Home</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h5 class="mb-4">All Customer Orders</h5>

                        <?php if (empty($allOrders)): ?>
                            <div class="alert alert-info">No orders found.</div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#ID</th>
                                            <th>Customer</th>
                                            <th>Total</th>
                                            <th>Address</th>
                                            <th>Payment</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allOrders as $order):
                                            $color = $statusColors[$order->getStatus()] ?? 'secondary';
                                        ?>
                                            <tr>
                                                <td><strong>#<?= $order->getId() ?></strong></td>
                                                <td><?= htmlspecialchars($order->getUserName() ?? '—') ?></td>
                                                <td><?= number_format($order->getTotalPrice(), 2) ?> EGP</td>
                                                <td><?= htmlspecialchars($order->getShippingAddress()) ?></td>
                                                <td><?= strtoupper($order->getPaymentMethod()) ?></td>
                                                <td><?= $order->getCreatedAt() ?></td>
                                                <td>
                                                    <form action="<?= BASE_URL ?>order/updateStatus/<?= $order->getId() ?>" method="POST">
                                                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                            <?php foreach ($statuses as $s): ?>
                                                                <option value="<?= $s ?>" <?= $order->getStatus() === $s ? 'selected' : '' ?>>
                                                                    <?= ucfirst($s) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="<?= BASE_URL ?>order/adminDetails/<?= $order->getId() ?>"
                                                        class="btn btn-sm btn-outline-primary">View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>