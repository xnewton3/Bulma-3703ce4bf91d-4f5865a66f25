<?php
$goalsFile = 'goals.json';
$goals = json_decode(file_get_contents($goalsFile), true);

$pendingGoals = array_filter($goals, function($goal) {
    return $goal['isApproved'] === 'pending';
});

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($pendingGoals as $key => $goal) {
        if (isset($_POST["approve_$key"])) {
            $goals[$key]['isApproved'] = 'true';
        }
        if (isset($_POST["disapprove_$key"])) {
            $goals[$key]['isApproved'] = 'false';
        }
    }
    file_put_contents($goalsFile, json_encode($goals, JSON_PRETTY_PRINT));
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html class="has-background-black-bis">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coach</title>
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
        <button class="button has-background-grey-dark"><a href="pass.html">Login -></a></button>
      </h1>
    </div>

    <section class="has-background-black-bis"><br>
      <div class="box has-background-grey-dark has-text-white-ter">
        <strong>Current goals available for review</strong>
        <form method="POST" action="">
          <?php if (!empty($pendingGoals)): ?>
            <?php foreach ($pendingGoals as $key => $goal): ?>
              <div class="notification has-background-grey has-text-white-ter">
                <strong>Goal: </strong><?php echo htmlspecialchars($goal['goalEntry']); ?><br>
                <strong>Name: </strong><?php echo htmlspecialchars($goal['firstName']); ?><br>
                <strong>Mentor: </strong><?php echo htmlspecialchars($goal['studentMentor']); ?><br>
                <strong>Class: </strong><?php echo htmlspecialchars($goal['studentClass']); ?><br>
                <strong>Date: </strong><?php echo htmlspecialchars($goal['selectedDate']); ?><br><br>

                <label class="checkbox">
                  <input type="checkbox" name="approve_<?php echo $key; ?>"> Approve
                </label>
                <label class="checkbox">
                  <input type="checkbox" name="disapprove_<?php echo $key; ?>"> Disapprove
                </label>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No pending goals available.</p>
          <?php endif; ?>
          
          <button class="button is-success" type="submit">Save Changes</button>
        </form>
      </div>
    </section>
    <br>
    <footer class="box has-background-grey-dark has-text-white-ter is-focused">
      <a href="https://curesarcoma.org/ways-to-help/honor-memorial-giving/dedications/technoblade/"><strong>TECHNOBLADE NEVER DIES</strong></a>
      <p>Written and designed by Newton :D</p>
    </footer>
  </body>
</html>