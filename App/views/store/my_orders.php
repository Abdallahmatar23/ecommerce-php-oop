<?php $orders = $orders ?? []; ?>
<div class="container my-5">
    <h2>My Orders History</h2>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?= $order['id'] ?></td>
                    <td><?= $order['total_price'] ?> EGP</td>
                    <td><?= strtoupper($order['payment_method']) ?></td>
                    <td><span class="badge bg-info text-dark"><?= strtoupper($order['status']) ?></span></td>
                    <td><?= $order['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>