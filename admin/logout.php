<?php

    session_destroy();
    echo "<script>alert('Anda berhasil logout');</script>";
    echo "<script>location='auth/login.php';</script>";

?>