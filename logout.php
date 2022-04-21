<?php
session_start();
unset($_SESSION["name"]);
unset($_SESSION["userid"]);

?>

<script>
    location.href = '/index.php'
</script>