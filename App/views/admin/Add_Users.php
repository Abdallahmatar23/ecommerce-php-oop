<?php
use App\Classes\Core\Session;
$dataUser = Session::get("info"); ?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add User</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php?page=dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Add User</li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Create New User</h5>

                <form action="index.php?page=Addusercontroll" method="POST">

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="<?= $dataUser["name"] ?? "" ?>" class="form-control"
                            placeholder="Enter full name">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $dataUser["email"] ?? "" ?> " class="form-control"
                            placeholder="Enter email">
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" value="<?= $dataUser["phone"] ?? "" ?>" class="form-control"
                            placeholder="Enter phone">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="conpassword" class="form-control" placeholder="Enter password">
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="">-- Select Role --</option>

                            <option <?= ($dataUser["role"] == "superadmin") ? "selected" : "" ?> value="superadmin">
                                Superadmin
                            </option>

                            <option <?= ($dataUser["role"] == "admin") ? "selected" : "" ?> value="admin">
                                Admin
                            </option>

                            <option <?= ($dataUser["role"] == "user") ? "selected" : "" ?> value="user">
                                User
                            </option>
                        </select>

                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i>
                        Add User
                    </button>

                </form>

            </div>
        </div>

    </section>

</main>