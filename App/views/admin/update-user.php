<?php
use App\Classes\Models\User;

$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: index.php?page=ViewUsers");
    exit;
}

$dataUser = (new User())->getById($id);

if (!$dataUser) {
    header("Location: index.php?page=ViewUsers");
    exit;
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Update User</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php?page=dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Update User</li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Update User</h5>

                <form action="index.php?page=updateusercontroll&id=<?= $dataUser["id"] ?>" method="POST">

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name"
                            value="<?= $dataUser["name"] ?? "" ?>"
                            class="form-control"
                            placeholder="Enter full name">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                            value="<?= $dataUser["email"] ?? "" ?>"
                            class="form-control"
                            placeholder="Enter email">
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone"
                            value="<?= $dataUser["phone"] ?? "" ?>"
                            class="form-control"
                            placeholder="Enter phone">
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>

                        <select name="role" class="form-select">
                            <option value="">-- Select Role --</option>

                            <option value="superadmin"
                                <?= ($dataUser["role"] ?? "") == "superadmin" ? "selected" : "" ?>>
                                Superadmin
                            </option>

                            <option value="admin"
                                <?= ($dataUser["role"] ?? "") == "admin" ? "selected" : "" ?>>
                                Admin
                            </option>

                            <option value="user"
                                <?= ($dataUser["role"] ?? "") == "user" ? "selected" : "" ?>>
                                User
                            </option>

                        </select>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">
                        Update User
                    </button>

                </form>

            </div>
        </div>

    </section>

</main>