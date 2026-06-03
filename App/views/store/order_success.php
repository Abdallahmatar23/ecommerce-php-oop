<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="<?= BASE_URL ?>home">home</a></li>
                        <li>Order Confirmed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/** @var \App\Models\Order       $order      */
/** @var \App\Models\OrderItem[] $orderItems */
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-sm border-0 p-5">

                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#28a745" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477
                                 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0
                                 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </div>

                <h2 class="mb-2">Order Placed Successfully!</h2>
                <p class="text-muted mb-1">Thank you for your purchase.</p>
                <p class="text-muted">Order ID: <strong>#<?= $order->getId() ?></strong></p>

                <hr>

                <div class="text-start mt-3">
                    <h5 class="mb-3">Order Summary</h5>
                    <table class="table table-bordered align-middle">
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
                                    <td><?= htmlspecialchars($item->getProduct()->getName()) ?></td>
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

                <div class="text-start mt-2">
                    <h5 class="mb-3">Delivery Info</h5>
                    <p><strong>Shipping Address:</strong> <?= htmlspecialchars($order->getShippingAddress()) ?></p>
                    <p><strong>Payment Method:</strong> <?= strtoupper($order->getPaymentMethod()) ?></p>
                    <p><strong>Status:</strong>
                        <span class="badge bg-warning text-dark"><?= strtoupper($order->getStatus()) ?></span>
                    </p>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="<?= BASE_URL ?>home" class="btn btn-outline-secondary">Continue Shopping</a>
                    <a href="<?= BASE_URL ?>order/myOrders" class="btn btn-primary">View My Orders</a>
                </div>

            </div>
        </div>
    </div>
</div>