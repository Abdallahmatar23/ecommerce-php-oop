<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="<?= BASE_URL ?>home">home</a></li>
                        <li><a href="<?= BASE_URL ?>order/myOrders">My Orders</a></li>
                        <li>Order #<?= $order['id'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<div class="container my-5">
    <div class="row">

        <!-- Order Items -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-4">Order #<?= $order['id'] ?> — Items</h5>
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
                                        <?php if (!empty($item['image_url'])): ?>
                                            <img src="<?= BASE_URL . 'uploads/' . $item['image_url'] ?>"
                                                alt="<?= htmlspecialchars($item['name']) ?>"
                                                style="width:50px;height:50px;object-fit:cover;border-radius:6px;">
                                        <?php endif; ?>
                                        <?= htmlspecialchars($item['name']) ?>
                                    </td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td><?= number_format($item['price'], 2) ?> EGP</td>
                                    <td><?= number_format($item['price'] * $item['quantity'], 2) ?> EGP</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total</td>
                                <td class="fw-bold"><?= number_format($order['total_price'], 2) ?> EGP</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Info Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-4">
                    <h6 class="mb-3">Order Info</h6>
                    <p class="mb-1"><strong>Order ID:</strong> #<?= $order['id'] ?></p>
                    <p class="mb-1"><strong>Date:</strong> <?= $order['created_at'] ?></p>
                    <p class="mb-1"><strong>Payment:</strong> <?= strtoupper($order['payment_method']) ?></p>
                    <p class="mb-1"><strong>Address:</strong> <?= htmlspecialchars($order['shipping_address']) ?></p>
                    <p class="mb-0"><strong>Status:</strong>
                        <?php
                        $statusColors = [
                            'pending'    => 'warning text-dark',
                            'processing' => 'info text-dark',
                            'shipping'   => 'primary',
                            'delivered'  => 'success',
                            'canceled'   => 'danger',
                            'returned'   => 'secondary',
                        ];
                        $color = $statusColors[$order['status']] ?? 'secondary';
                        ?>
                        <span class="badge bg-<?= $color ?>"><?= strtoupper($order['status']) ?></span>
                    </p>
                </div>
            </div>

            <!--breadcrumbs area start-->
            <div class="breadcrumbs_area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb_content">
                                <ul>
                                    <li><a href="<?= BASE_URL ?>home">home</a></li>
                                    <li><a href="<?= BASE_URL ?>order/myOrders">My Orders</a></li>
                                    <li>Order #<?= $order->getId() ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            /** @var \App\Models\Order       $order      */
            /** @var \App\Models\OrderItem[] $orderItems */
            $statusColors = [
                'pending'    => 'warning text-dark',
                'processing' => 'info text-dark',
                'shipping'   => 'primary',
                'delivered'  => 'success',
                'canceled'   => 'danger',
                'returned'   => 'secondary',
            ];
            $color = $statusColors[$order->getStatus()] ?? 'secondary';
            ?>

            <div class="container my-5">
                <div class="row">

                    <!-- Items -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h5 class="mb-4">Order #<?= $order->getId() ?> — Items</h5>
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
                                <p class="mb-1"><strong>Order ID:</strong> #<?= $order->getId() ?></p>
                                <p class="mb-1"><strong>Date:</strong> <?= $order->getCreatedAt() ?></p>
                                <p class="mb-1"><strong>Payment:</strong> <?= strtoupper($order->getPaymentMethod()) ?></p>
                                <p class="mb-3"><strong>Address:</strong> <?= htmlspecialchars($order->getShippingAddress()) ?></p>
                                <p class="mb-0"><strong>Status:</strong>
                                    <span class="badge bg-<?= $color ?>"><?= strtoupper($order->getStatus()) ?></span>
                                </p>
                            </div>
                        </div>
                        <a href="<?= BASE_URL ?>order/myOrders" class="btn btn-outline-secondary w-100">← Back to My Orders</a>
                    </div>

                </div>
            </div> <a href="<?= BASE_URL ?>order/myOrders" class="btn btn-outline-secondary w-100">
                ← Back to My Orders
            </a>
        </div>

    </div>
</div>