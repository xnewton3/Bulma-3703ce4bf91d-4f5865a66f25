<?php
// Assuming you have the functions for logging and reading files
$logFile = 'actions.log';
$homeDir = '/home/xnewton/Documents/nexed/deepdives/css-frameworks/Bulma-3703ce4bf91d-4f5865a66f25/';
$goalsFile = 'goals.json';

// Load the goals data
if (file_exists($goalsFile)) {
    $goalsData = json_decode(file_get_contents($goalsFile), true);
} else {
    $goalsData = [];
}

// Load the last 100 actions from the log file
$lastActions = [];
if (file_exists($logFile) && is_readable($logFile)) {
    $logLines = file($logFile, FILE_IGNORE_NEW_LINES);
    $lastActions = array_slice($logLines, -100);
}

// Read the files in the home directory
$files = scandir($homeDir);
?>

<!DOCTYPE html>
<html class="has-background-black-bis">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Control Panel</title>
    <link rel="icon" href="images/images2.png" type="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
  </head>
  <body>
    <div class="container is-fullhd has-background-black-ter">
      <h1 class="title has-background-black-ter"> ‎
        <a href="index.php"><img src="images/images2.png" width="32" height="32"></a>
        ┆
        <button class="button has-background-grey-dark"><a href="index.php">Home</a></button>
        <button class="button has-background-grey-dark"><a href="student.html">Student</a></button>
        <button class="button has-background-grey-dark"><a href="pass.html">Coach</a></button>
      </h1>
    </div>
    <section class="has-background-black-bis"><br>
      <div class="box has-background-grey-dark has-text-white-ter">
        <strong>Admin Control Panel</strong>

        <div class="box has-background-grey has-text-white-ter">
          <strong>All Goals</strong>
          <div class="columns is-multiline">
            <?php
            foreach ($goalsData as $goal) {
                if ($goal['isApproved'] == 'pending') {
                    
                    echo "<div class='column is-one-third'>";
                    echo "<strong>Entry Name: </strong>" . htmlspecialchars($goal['entryName']) . "<br>";
                    echo "<strong>Goal: </strong>" . htmlspecialchars($goal['goalEntry']) . "<br>";
                    echo "<strong>Name: </strong>" . htmlspecialchars($goal['firstName']) . "<br>";
                    echo "<strong>Mentor: </strong>" . htmlspecialchars($goal['studentMentor']) . "<br>";
                    echo "<strong>Class: </strong>" . htmlspecialchars($goal['studentClass']) . "<br>";
                    echo "<strong>Date: </strong>" . htmlspecialchars($goal['selectedDate']) . "<br>";

                    echo "<input type='checkbox' id='approve-{$goal['entryName']}'> Approve ";
                    echo "<input type='checkbox' id='disapprove-{$goal['entryName']}'> Disapprove <br><br>";
                    echo "</div>";
                }
            }
            ?>
          </div>
        </div>

        <div class="box has-background-grey has-text-white-ter">
          <strong>Files in Home Directory</strong>
          <pre><?php echo implode("\n", $files); ?></pre>
        </div>

        <?php if (!empty($lastActions)): ?>
          <div class="box has-background-grey has-text-white-ter">
            <strong>Last 100 Actions</strong>
            <ul>
              <?php foreach ($lastActions as $action): ?>
                <li><?php echo htmlspecialchars($action); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <div class="box has-background-grey has-text-white-ter">
          <strong>Change Coach and Admin Password</strong>
          <form action="change_password.php" method="post">
            <div class="field">
              <label class="label">Coach Password</label>
              <div class="control">
                <input class="input" type="password" name="coachPassword" placeholder="Enter new coach password">
              </div>
            </div>
            <div class="field">
              <label class="label">Admin Password</label>
              <div class="control">
                <input class="input" type="password" name="adminPassword" placeholder="Enter new admin password">
              </div>
            </div>
            <div class="control">
              <button class="button is-primary" type="submit">Save Changes</button>
            </div>
          </form>
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
