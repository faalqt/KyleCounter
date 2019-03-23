<script>
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

<?php
  include '../PHP-Scripts/credentials.php';
  include '../PHP-Scripts/scripts.php';

  ob_start();
  session_start();

?>
<html>
    <head>
        <title>Phrase Count</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="../Layout/style.css">
        <script src="../Javascript/table.js"></script>
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="https://turing.plymouth.edu/~jac1065/">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <ul class="navbar-nav mr-auto">
                  <a class="nav-link" href="https://github.com/imjstn/KyleCounter">GitHub</a>
              </ul>
              
                <?php
                  if(isset($_SESSION['valid']) && $_SESSION['valid'] == true){
                    echo '<form class="form-inline" action="../PHP-Scripts/logout.php">';
                    echo '<button class="btn btn-sm btn-outline-primary my-2 my-sm-0" type="submit">Logout</button>';
                    echo '</form>';
                  }else{
                    echo '<form class="form-inline" method="post">';
                    echo '<input class="form-control-sm mr-sm-1 bg-light text-dark" name="username" type="username" placeholder="Username" aria-label="Username">';
                    echo '<input class="form-control-sm mr-sm-1 bg-light text-dark" name="password" type="password" placeholder="Password" aria-label="Password">';
                    echo '<button class="btn btn-sm btn-outline-primary my-2 my-sm-0" type="submit">Login</button>';
                    echo '</form>';
                  }
                ?>
              <?php
                if(isset($_POST['username']) && isset($_POST['password'])){
                  $username = $_POST['username'];
                  $password = $_POST['password'];
                  while($userRows = $users->fetch_assoc()){
                    if(($userRows['username'] == $username && $userRows['password']==$password)){
                      $_SESSION['valid'] = true;
                      $_SESSION['timeout'] = time();
                      $_SESSION['username'] = $username;
                      header("Refresh:0");
                    }
                  }
                }
              ?>
            </div>

        </nav>

        <br>

        <div class="text">
          <h1>A guide to Kyle's hint scale</h1>
          <h6> You can click on the column headers to sort each row </h6>
        </div>

        <br>

        <div class="col-sm-3 " style="margin: 0 auto;">
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text bg-dark text-light" id="inputGroup-sizing-sm">Filter</span>
            </div>
            <input type="text" id="searchInput" onkeyup="searchTable()" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
          </div>
        </div>
        <div class="sortLinks">
          <div class="container ">
              <table class="table" id="stateTable">
                  <thead class="thead-dark">
                      <th scope="col"><a href="KyleCounter.php?sort=stateId">ID</a></th>
                      <th scope="col"><a href="KyleCounter.php?sort=stateName">Name</a></th>
                      <th scope="col"><a href="KyleCounter.php?sort=stateSize">Size</a></th>
                      <th scope="col"><a href="KyleCounter.php?sort=NHTimes">x NH</a></th>
                      <th scope="col"><a href="KyleCounter.php?sort=hintFactor">Hint Scale</a></th>
                      <th scope="col"><a href="KyleCounter.php?sort=timesUsed">Usage</a></th>
                      <?php
                        if(isset($_SESSION['valid']) && ($_SESSION['valid'] == true)){
                          echo '<th colspan="2" scope="col"></th>';
                        }
                      ?>
                  </thead>

              <?php
                  while($rows = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td> " . $rows["stateId"] . "</td>";
                      $phraseID = $rows["stateId"];
                      echo "<td> " . $rows["stateName"] . "</td>";
                      echo "<td> " . $rows["stateSize"] . "</td>";
                      echo "<td>" . $rows["NHTimes"] . "x</td>";
                      echo "<td>" . $rows["hintFactor"] . "</td>";
                      echo "<td>" . $rows["timesUsed"] . "</td>";
                      if(isset($_SESSION['valid']) && $_SESSION['valid']==true){
                        echo '<td><form method="get"><button name="add'. $phraseID . '" type="submit" class="btn btn-primary">+1</button></form></td>';
                        echo '<td><form method="get"><button name="sub'. $phraseID . '" type="submit" class="btn btn-danger">-1</button></form></td>';
                      }
                      echo "</tr>";
                  }
              ?>
              </table>
          </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
