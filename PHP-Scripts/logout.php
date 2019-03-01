<?php
   session_start();
   session_destroy();
   header('Refresh: 0; URL = https://turing.plymouth.edu/~jac1065/StatCounter/Pages/KyleCounter.php');
?>