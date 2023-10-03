<?php

include("db.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM tb_task WHERE id = ?";
    $statement = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($statement, "i", $id);

    $result = mysqli_stmt_execute($statement);

    if(!$result) {
        die("Delete Failed");
    }

    $_SESSION['message'] = "Task Delete Succesfully";
    $_SESSION['message_type'] = "success";

    header("Location: index.php");
}

?>