<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="<?= BASE_URL ?>home">home</a></li>
                        <li>Login</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<section class="account">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="account-contents"
                    style="background: url('assets/img/about/about1.jpg'); background-size: cover;">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="account-thumb">
                                <h2>Login now</h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis consectetur similique
                                    deleniti pariatur enim cumque eum</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="account-content">
                                <?= showMessage() ?>
                                
                                <form action="<?= BASE_URL ?>auth/login" method="POST">
                                    <div class="single-acc-field">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" value="<?= $_SESSION["data"] ["email"]?? "" ?>"
                                            placeholder="Enter your Email">
                                            <?= showErrorField("email") ?>
                                        </div>
                                        
                                        <div class="single-acc-field">
                                            <label for="password">Password</label>
                                            <input type="text" name="password" id="password"
                                            placeholder="Enter your password">
                                            <?= showErrorField("pass") ?>
                                    </div>
                                    <div class="single-acc-field boxes">
                                        <input type="checkbox" id="checkbox" name="remember">
                                        <label for="checkbox">Remember me</label>
                                    </div>
                                    <div class="single-acc-field">
                                        <button type="submit">Login Account</button>
                                    </div>
                                    <a href="<?= BASE_URL ?>forget_password">Forget Password?</a>
                                    <a href="<?= BASE_URL ?>register">Not Account Yet?</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>