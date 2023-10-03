<?php

include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM tb_task WHERE id = ?";
    $statement = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($statement, "i", $id);

    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    if (mysqli_num_rows($result) == 1) {
        $task = mysqli_fetch_array($result);
        $title = $task['title'];
        $desc = $task['description'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];

    try {
        $query = "UPDATE tb_task SET title = ?, description = ? WHERE id = ?";
        $statement = mysqli_prepare($con, $query);

        mysqli_stmt_bind_param($statement, "ssi", $title, $desc, $id);

        mysqli_stmt_execute($statement);

        $_SESSION['message'] = "Task Update Succesfully";
        $_SESSION['message_type'] = "success";

        header("Location: index.php");
    } catch (Exception $ex) {
        die("Update Failed: " . $ex->getMessage());
    }
}

?>

<?php include("includes/header.php") ?>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <form action="edit_task.php?id=<?= $_GET['id'] ?>" method="POST">
                        <div class="form-group">
                            <input type="text" name="title" value="<?= $title ?>" class="form-control" placeholder="Update Title">
                        </div>
                        <div class="form-group">
                            <textarea name="description" rows="2" class="form-control" placeholder="Update Description"><?= $desc ?></textarea>
                        </div>
                        <button class="btn btn-success btn-block" name="update">
                            Update Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>