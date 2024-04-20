<?php
session_start();

if (!$_SESSION['login']) {
    header('Location: ../index.php');
    exit();
}
?>

<div class="DataUser">
    <p>Hola! <?= $_SESSION['userName'] ?></p>
    <p><?= $_SESSION['userCargo'] ?></p>
</div>