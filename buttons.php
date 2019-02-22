<?php
  if(isset($_GET['addAK'])){
    updateDB('+', 'AK', $connection);
  }else if(isset($_GET['subAK'])){
    updateDB('-', 'AK', $connection);
  }
 
 ?>
