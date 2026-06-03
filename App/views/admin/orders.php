<?php
$allOrders = $allOrders ?? []; ?>
<div class="container my-5">
    <h2>Manage Customer Orders</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Address</th>
                <th>Current Status</th>
                <th>Change Status</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($allOrders as $order):
            ?>
                <tr>
                    <td>#<?= $order['id'] ?></td>
                    <td><?= $order['user_name'] ?></td>
                    <td><?= $order['total_price'] ?> EGP</td>
                    <td><?= $order['shipping_address'] ?></td>
                    <td><span class="badge bg-warning text-dark"><?= $order['status'] ?></span></td>
                    <td>
                        <form action="<?= BASE_URL ?>order/updateStatus/<?= $order['id'] ?>" method="POST">
                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : '' ?>>Processing</option>
                                <option value="shipping" <?= $order['status'] == 'shipping' ? 'selected' : '' ?>>Shipping</option>
                                <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                                <option value="canceled" <?= $order['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                            </select>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>