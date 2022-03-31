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

$selectedPeriod = $_POST['period'] ? $_POST['period'] : $currentDate->format('Y-m');
$periods = [];
for($yearDiff = 0; $yearDiff <= 2; $yearDiff++) {
    $year = date('Y') - $yearDiff;
    for($month = 12; $month >= 1; $month--) {
        $date = new DateTime("{$year}-{$month}-1");
        $periods[$date->format('Y-m')] = strftime('%B de %Y', $date->getTimestamp());
    }
}


$exception = null;
if(isset($_GET['delete'])) {
    try {
        Activity::deleteById($_GET['delete']);
        addSuccessMsg('Produtividade excluída com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir a produtividade.');
        } else {
            $exception = $e;
        }
    }
}

$activities = Activity::get();
foreach($activities as $activity) {
    $activity->date = (new DateTime($activity->date))->format('d/m/Y');    
    
}


loadTemplateView('activity', [
    'activities' => $activities,
    'exception' => $exception,
    'report' => $report,
    'sumOfWorkedTime' => getTimeStringFromSeconds($sumOfWorkedTime),
    'balance' => "{$sign}{$balance}",
    'selectedPeriod' => $selectedPeriod,
    'periods' => $periods,
    'selectedUserId' => $selectedUserId,
    'users' => $users,
    'selectedActivityId' => $selectedActivityId,
]);