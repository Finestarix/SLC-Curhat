<?php
if (isset($_SESSION['ERROR'])) {
    ?>
    <div id="snackbar" style="background-color: hsl(354, 70%, 54%); color: white">
        <?= $_SESSION['ERROR'] ?>
    </div>
    <?php
}
?>

<?php
if (isset($_SESSION['SUCCESS'])) {
    ?>
    <div id="snackbar" style="background-color: hsl(134, 61%, 41%); color: white">
        <?= $_SESSION['SUCCESS'] ?>
    </div>
    <?php
}
?>