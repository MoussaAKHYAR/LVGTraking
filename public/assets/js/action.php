<?php

$position = new \App\Entity\Position();
$position->setId($_REQUEST['id']);
$position->setLat($_REQUEST['lat']);
$position->setLng($_REQUEST['lng']);
$status = $position->updateCollegesWithLatLngById();

if($status == true) {
    echo "Updated..";
}else{
    echo "failed";
}
