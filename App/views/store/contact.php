<?php
use App\Classes\Models\User;
use App\Classes\Core\Session;


if (Session::check("contact")) {
    $datauser = Session::get("contact");
} elseif (Session::check("user")) {
    $datauser = (new User())->getById($_SESSION["user"]["id"]);
}
?>
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index-2.html">home</a></li>
                        <li>Contact</li>
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
            <div class="col-lg-12">
                <div class="account-contents"
                    style="background: url('public/assets/store/assets/img/about/about2.jpg'); background-size: cover;">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                            <div class="account-thumb">
                                <h2>Contact us</h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis consectetur similique
                                    deleniti pariatur enim cumque eum</p>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                            <div class="account-content">
                                <form action="index.php?page=contactcontroller" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="single-acc-field">
                                                <label for="name">Name</label>
                                                <input type="text" placeholder="Name" id="name"
                                                    value="<?= $datauser["name"] ?? "" ?>" name="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-acc-field">
                                                <label for="email">Email</label>
                                                <input type="text" placeholder="Email" id="email"
                                                    value="<?= $datauser["email"] ?? "" ?>" name="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single-acc-field">
                                                <label for="msg">Message</label>
                                                <textarea name="message" id="msg" rows="4"><?= $datauser["message"] ?? "" ?></textarea>
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-acc-field">
                                        <button type="submit">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>