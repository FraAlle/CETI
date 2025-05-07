<?php
session_start();
session_destroy();
header("Location: /CETI/dana1/index.php");
exit();
?>