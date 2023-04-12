<?php

    session_start();

    // Menghancurkan $_SESSION['pelangganm'];
    session_destroy();

    echo "<script>alert('Anda berhasil logout);</script>";
    echo "<script>location='auth/login.php';</script>";

?>