<!DOCTYPE html>
<html class="has-background-black-bis">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="icon" href="images/images2.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
  </head>
  <body>
    <div class="container is-fullhd has-background-black-ter">
      <h1 class="title has-background-black-ter"> ‎
        <a href="index.php"><img src="images/images2.png" width="32" height="32"></a>
        ┆
        <button class="button has-background-grey-dark"><a href="index.php">Home</a></button>
        <button class="button has-background-grey-dark"><a href="student.html">Student</a></button>
        <button class="button has-background-grey-dark"><a href="pass.html">Login -></a></button>
      </h1>
    </div>
    <section class="has-background-black-bis"><br>
      <div class="box has-background-grey-dark has-text-white-ter"><strong>Click on a button at the top to start.</strong></div>
      <div class="columns has-background-grey-dark has-text-white-ter">
        
        <div class="column">
          <div class="box has-background-grey has-text-white-ter">
            <strong>Pending Goals</strong>
            <ul id="pending-goals">
              <?php
              $jsonData = file_get_contents('goals.json');
              $goals = json_decode($jsonData, true);
              foreach ($goals as $goal) {
                  if ($goal['isApproved'] === "pending") {
                      echo "<li><strong>Goal:</strong> " . htmlspecialchars($goal['goalEntry']) . "<br>";
                      echo "<strong>Name:</strong> " . htmlspecialchars($goal['firstName']) . "<br>";
                      echo "<strong>Mentor:</strong> " . htmlspecialchars($goal['studentMentor']) . "<br>";
                      echo "<strong>Class:</strong> " . htmlspecialchars($goal['studentClass']) . "<br>";
                      echo "<strong>Deadline:</strong> " . htmlspecialchars($goal['selectedDate']) . "</li><br>";
                  }
              }
              ?>
            </ul>
          </div>
        </div>

        <div class="column">
          <div class="box has-background-grey has-text-white-ter">
            <strong>Approved Goals</strong>
            <ul id="approved-goals">
              <?php
              foreach ($goals as $goal) {
                  if ($goal['isApproved'] === "true") {
                      echo "<li><strong>Goal:</strong> " . htmlspecialchars($goal['goalEntry']) . "<br>";
                      echo "<strong>Name:</strong> " . htmlspecialchars($goal['firstName']) . "<br>";
                      echo "<strong>Mentor:</strong> " . htmlspecialchars($goal['studentMentor']) . "<br>";
                      echo "<strong>Class:</strong> " . htmlspecialchars($goal['studentClass']) . "<br>";
                      echo "<strong>Deadline:</strong> " . htmlspecialchars($goal['selectedDate']) . "</li><br>";
                  }
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <br>
    <footer class="box has-background-grey-dark has-text-white-ter is-focused">
      <a href="https://curesarcoma.org/ways-to-help/honor-memorial-giving/dedications/technoblade/"><strong>TECHNOBLADE NEVER DIES</strong></a>
      <p>Written and designed by Newton :D</p>
    </footer>
  </body>
</html>