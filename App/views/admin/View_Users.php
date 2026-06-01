<main id="main" class="main">

    <div class="pagetitle">
        <h1>Users</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php?page=dashboard">Dashboard</a>
                </li>

                <li class="breadcrumb-item active">
                    View Users
                </li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mt-3 mb-3">

                    <h5 class="card-title m-0">
                        Users List
                    </h5>

                    <a href="index.php?page=AddUsers" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i>
                        Add User
                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table table-striped table-hover align-middle text-center">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            use App\Classes\Models\User;

                            $users = (new User())->getAll();

                            $id = 1;

                            foreach ($users as $user):

                                ?>

                                <tr>

                                    <td><?= $id++ ?></td>

                                    <td><?= $user["name"] ?></td>

                                    <td><?= $user["email"] ?></td>

                                    <td><?= $user["phone"] ?? "" ?></td>
                                    
                                    <td>
                                        
                                        <?php if ($user["role"] === "user"): ?>
                                            
                                            <span class="badge bg-primary">
                                                <?= $user["role"] ?>
                                            </span>
                                            
                                            <?php else: ?>
                                                
                                                <span class="badge bg-danger">
                                                    <?= $user["role"] ?>
                                                </span>
                                                
                                                <?php endif; ?>
                                                
                                            </td>
                                            
                                            <td><?= $user["created_at"] ?? "" ?></td>
                                            <td><?= $user["updated_at"] ?? "" ?></td>
                                    <td>

                                        <a href="index.php?page=infousercontroll&id=<?= $user["id"] ?></a>"
                                            class="btn btn-sm btn-warning"
                                            onclick="return confirm('Are you sure you want to update this user?')">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="index.php?page=deleteusercontroll&id=<?= $user["id"] ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </section>

</main>
