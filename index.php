<?php include("db.php") ?>

<?php include("includes/header.php") ?>

    <div class="container p-4">
        <div class="row">
            <div class="cold-md-4">

                <?php if (isset($_SESSION['message'])) { ?>

                    <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <?php session_unset(); ?>

                <?php } ?>

                <div class="card card-body">
                    <form action="save_task.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Task Title" autofocus />
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" rows="2" placeholder="Task Description"></textarea>
                        </div>
                        <input type="submit" name="save_task" class="btn btn-success btn-block" value="Save Task" />
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Create At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM tb_task";
                        $result_tasks = mysqli_query($con, $query);

                        while ($task = mysqli_fetch_array($result_tasks)) {
                        ?>

                            <tr>
                                <td><?= $task['title'] ?></td>
                                <td><?= $task['description'] ?></td>
                                <td><?= $task['created_at'] ?></td>
                                <td>
                                    <a href="edit_task.php?id=<?= $task['id'] ?>" class="btn btn-warning text-white">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a href="delete_task.php?id=<?= $task['id'] ?>" class="btn btn-danger text-white">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>