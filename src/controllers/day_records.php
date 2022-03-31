<?php
session_start();
requireValidSession();

$currentDate = new DateTime();

$user = $_SESSION['user'];
$selectedUserId = $user->id;
$users = null;
if($user->is_admin) {
    $users = User::get();
    $selectedUserId = $_POST['user'] ? $_POST['user'] : $user->id;
}

$date = (new Datetime())->getTimestamp();
$today = strftime('%d de %B de %Y', $date);
loadTemplateView('day_records', ['today' => $today,'users' => $users, 'selectedUserId' => $selectedUserId,]);