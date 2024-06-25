<?php
session_start();
session_destroy();
echo "<script>
        localStorage.removeItem('user_id');
        window.location.href = 'index.php';
      </script>";
?>
