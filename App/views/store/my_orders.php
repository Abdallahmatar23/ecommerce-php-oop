<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="<?= BASE_URL ?>home">home</a></li>
                        <li>My Orders</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/** @var \App\Models\Order[] $orders */
$orders = $orders ?? [];
?>

<div class="container my-5">
    <h3 class="mb-4">My Orders History</h3>

    <?php if (empty($orders)): ?>
        <div class="alert alert-info text-center py-5">
            <h5>You haven't placed any orders yet.</h5>
            <a href="<?= BASE_URL ?>home" class="btn btn-primary mt-2">Start Shopping</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $statusColors = [
                        'pending'    => 'warning text-dark',
                        'processing' => 'info text-dark',
                        'shipping'   => 'primary',
                        'delivered'  => 'success',
                        'canceled'   => 'danger',
                        'returned'   => 'secondary',
                    ];
                    foreach ($orders as $order):
                        $color = $statusColors[$order->getStatus()] ?? 'secondary';
                    ?>
                        <tr>
                            <td><strong>#<?= $order->getId() ?></strong></td>
                            <td><?= number_format($order->getTotalPrice(), 2) ?> EGP</td>
                            <td><?= strtoupper($order->getPaymentMethod()) ?></td>
                            <td><span class="badge bg-<?= $color ?>"><?= strtoupper($order->getStatus()) ?></span></td>
                            <td><?= $order->getCreatedAt() ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>order/details/<?= $order->getId() ?>"
                                   class="btn btn-sm btn-outline-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>