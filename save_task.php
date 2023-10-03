<?php

include("db.php");

if (isset($_POST['save_task'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];

    $query = "INSERT INTO tb_task(title, description) VALUES (?, ?)";
    $statement = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($statement, "ss", $title, $desc);

    $result = mysqli_stmt_execute($statement);

    if (!$result) {
        die("Insert Failed");
    }

    $_SESSION['message'] = "Task Save Succesfully";
    $_SESSION['message_type'] = "success";

    header("Location: index.php");
}

?>
