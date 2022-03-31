<?php
session_start();
requireValidSession();

$currentDate = new DateTime();

$process = $_SESSION['process'];
$selectedProcessId = $process->id;
$lawsuit = null;
$lawsuit = Process::get();
$selectedProcessId = $_POST['process'] ? $_POST['process'] : $process->id;

$user = $_SESSION['user'];
$selectedUserId = $user->id;
$users = null;
$users = User::get();
$selectedUserId = $_POST['user'] ? $_POST['user'] : $user->id;


$exception = null;
$activityData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
    $activity = Activity::getOne(['id' => $_GET['update']]);
    $activityData = $activity->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbActivity = new Activity($_POST);
        if($dbActivity->id) {
            $dbActivity->update();
            addSuccessMsg('Produtividade alterada com sucesso!');
            header('Location: activity.php');
            exit();
        } else {
            $dbActivity->insert();
            addSuccessMsg('Produtividade cadastrada com sucesso!');
        }
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $activityData = $_POST;
    }
}

loadTemplateView('save_activity',
$activityData + ['process' => $process, 'lawsuit' => $lawsuit, 'selectedUserId' => $selectedUserId,
'users' => $users,
'selectedProcessId' => $selectedProcessId, 'exception' => $exception]);