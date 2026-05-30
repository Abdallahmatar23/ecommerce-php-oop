
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="<?= BASE_URL  ?>page/home">home</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--shopping cart area start -->
<?php if ($cart_items): ?>
<div class="shopping_cart_area mt-60">
    <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                            <th class="product_remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cart_items as $cart_item):  ?>
                                            

                                            <tr>
                                                <td class="product_thumb"><a href="#"><img src="<?= BASE_URL ?><?= $cart_item->getProduct()->getImage() ?> " alt=""></a></td>
                                                <td class="product_name"><a href="#"><?= $cart_item->getProduct()->getName() ?></a></td>
                                                <td class="product-price">$<?= $cart_item->getProduct()->getPrice()?></td>
                                                <td class="product_quantity"><label>Quantity</label> <input min="1" max="100" value="<?=  $cart_item->getQty()?>" type="number" readonly></td>
                                                <td class="product_total">$<?=  $cart_item->getSubTotal()?></td>
                                                <td class="product_remove"><a href="<?= BASE_URL ?>cart/handle/remove/<?= $cart_item->getProduct()->getId()?>"><i class="ion-android-close"></i></a></td>
                                            </tr>
                                    <?php endforeach;?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <button type="submit">update cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area start-->
                <div class="coupon_area">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code left">
                                <h3>Coupon</h3>
                                <div class="coupon_inner">
                                    <p>Enter your coupon code if you have one.</p>
                                    <input placeholder="Coupon code" type="text">
                                    <button type="submit">Apply coupon</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>Cart Totals</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>Subtotal</p>
                                        <p class="cart_amount">$<?=  $total ?></p>
                                    </div>
                                    <div class="cart_subtotal ">
                                        <p>Shipping</p>
                                        <p class="cart_amount"><span>Flat Rate:</span> $255.00</p>
                                    </div>
                                    <a href="#">Calculate shipping</a>

                                    <div class="cart_subtotal">
                                        <p>Total</p>
                                        <p class="cart_amount">$<?=  $total - 255 ?></p>
                                    </div>
                                    <div class="checkout_btn">
                                        <a href="<?= BASE_URL ?>page/checkout">Proceed to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end-->
            </form>
    </div>
</div>
<?php else:?>
    <h2 class=" text-center p-2 bg-warning"> cart Item not Exists</h2>
<?php endif;?>
<!--shopping cart area end -->