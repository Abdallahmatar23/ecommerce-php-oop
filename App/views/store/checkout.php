<div class="container my-5">
    <h2>Complete Your Order</h2>
    <?php if ($error = \App\Core\Session\Session::flash("error")): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form action="<?= BASE_URL ?>checkout/checkout" method="POST" class="col-md-6 mt-4">
        <div class="mb-3">
            <label for="shipping_address" class="form-label">Shipping Address</label>
            <input type="text" name="shipping_address" id="shipping_address" class="form-control" placeholder="e.g. Cairo, Nasr City" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash" checked>
                <label class="form-check-label" for="cash">Cash on Delivery</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                <label class="form-check-label" for="card">Credit Card</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>