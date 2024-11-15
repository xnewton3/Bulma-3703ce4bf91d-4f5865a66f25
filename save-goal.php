<?php

$mentor;
$sclass;

$goalEntry = $_POST['goalEntry'];
$deadlineDate = $_POST['deadlineDate'];
$mentorGroup = $_POST['mentorGroup'];
$firstName = $_POST['firstName'];

$goalsFile = 'goals.json';
$goals = json_decode(file_get_contents($goalsFile), true);

$nextKey = 'entry' . (count($goals) + 1);

if ($mentorGroup == "Artemis 13 (Henk)") {
    $mentor = "Henk";
    $sclass = "Artemis13";
} elseif ($mentorGroup == "Artemis 13 (Paul)") {
    $mentor = "Paul";
    $sclass = "Artemis13";
} elseif ($mentorGroup == "Artemis 13 (Rob)") {
    $mentor = "Rob";
    $sclass = "Artemis13";
}

$newGoal = [
    'entryName' => $nextKey,
    'goalEntry' => $goalEntry,
    'firstName' => $firstName,
    'studentMentor' => $mentor,
    'studentClass' => $sclass,
    'isApproved' => 'pending',
    'isCompleted' => 'false',
    'selectedDate' => $deadlineDate
];

$goals[$nextKey] = $newGoal; 

file_put_contents($goalsFile, json_encode($goals, JSON_PRETTY_PRINT));

header("Location: success.html");
exit();
?>