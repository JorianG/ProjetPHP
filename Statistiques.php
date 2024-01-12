<?php
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/StatsService.php";
$statsService = new service\StatService();
echo $statsService->getNbPatientBetweenAge(0, 10);
?>