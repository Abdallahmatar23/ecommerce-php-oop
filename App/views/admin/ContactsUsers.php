<?php if (empty($contacts)): ?>

    <div class="alert alert-info">
        No messages found.
    </div>


<?php endif; ?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Contact Messages</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php?page=dashboard">Dashboard</a>
                </li>

                <li class="breadcrumb-item active">
                    Contact Messages
                </li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                    <h5 class="card-title m-0">
                        Messages List
                    </h5>
                </div>

                <?php

                use App\Models\Contact;

                $allContact = (new Contact())->getAllContact();

                foreach ($contacts as $contact): ?>

                    <div class="border rounded p-3 mb-3">

                        <h5><?= $contact["name"] ?></h5>

                        <p class="mb-1">
                            <strong>Email:</strong>
                            <?= $contact["email"] ?>
                        </p>

                        <p class="mb-2">
                            <strong>Message:</strong><br>
                            <?= $contact["message"] ?>
                        </p>

                        <p class="mb-2">
                            <strong>Created At:</strong>
                            <?= $contact["created_at"] ?>
                        </p>

                        <?php if ($contact["is_read"] == 0): ?>

                            <a href="index.php?page=readcontactcontroll&id=<?= $contact["id"] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Have you read this message?')">

                                Unread

                            </a>

                        <?php else: ?>

                            <button class="btn btn-success btn-sm">
                                Read
                            </button>

                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>

    </section>

</main>