<?php
$sekarang = date('Y-m-d H:i:s');
echo 'tanggal sekarang : '.$sekarang.'<br>';
//$datetime1 = new DateTime('2009-10-11 12:00:00');
$datetime1 = new DateTime($sekarang);
$datetime2 = new DateTime('1984-8-13 13:30:00');
$interval = $datetime1->diff($datetime2);
echo $interval->format('%R%a days').'<br>';
echo $interval->format('%Ytahun %Mbulan %Dhari %H:%i:%s');

//SELECT ADDTIME(`MenuDate`, '1 0:0:0') FROM `menu` WHERE 1 