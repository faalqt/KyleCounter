<?php
  include 'credentials.php';
  include 'buttons.php';
  
  function updateDB($sign, $id, $dbCon){
    $updateDB = "update KyleHintCounter set timesUsed= greatest(0, timesUsed ". $sign ." 1) where stateId = '$id';";
    mysqli_query($dbCon, $updateDB);
  }

  function buttonPress($stateID, $conn){
      if(isset($_GET['add' . $stateID])){
        updateDB('+', $stateID, $conn);
      }else if(isset($_GET['sub'. $stateID])){
        updateDB('-', $stateID, $conn);
  }
  }

  $choice = "stateSize DESC";
  if(isset($_GET['sort'])){
    if($_GET['sort'] == 'stateId'){
      $choice = "stateId";
    }else if($_GET['sort'] == 'stateName'){
      $choice = "stateName";
    }else if($_GET['sort'] == 'stateSize'){
      $choice = "stateSize DESC";
    }else if($_GET['sort'] == 'NHTimes'){
      $choice = "NHTimes DESC";
    }else if($_GET['sort'] == 'hintFactor'){
      $choice = "hintFactor DESC";
    }else if($_GET['sort'] == 'timesUsed'){
      $choice = "timesUsed DESC";
    }
  }

  //buttons($phraseID, $connection);

  $query = "select * from KyleHintCounter order by $choice";
  $result = mysqli_query($connection, $query);
  $rows = mysqli_num_rows($result);

  $getUsersQuery = "select * from KyleHintCounterUsers";
  $users = mysqli_query($connection, $getUsersQuery);
  $userRows = mysqli_num_rows($users);


?>
