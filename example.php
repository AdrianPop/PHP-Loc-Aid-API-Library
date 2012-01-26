<?php
require_once 'locaid.class.php';

try {
    $mobile = new Locaid($username, $password, $classid, $mobile_num);

    if ($mobile->ReistrationApi()->getIsOptedIn()) {

        // lat/long
        $res = $mobile->GetXYApi()->getLocation();

        // show the coords:
        echo "found $mobile_num at {$res->Y}, {$res->X} using {$res->technology} technology on {$res->datetime} (unix time: {$res->timestamp})\n";


    } else {

        // request registration via SMS message
        echo "$mobile_num was not registered, sending registration SMS message: ";

        $res = $mobile->ReistrationApi()->Register();

        echo $res->status . "\n";

    }

} catch (Exception $e) {
    echo "Cannot complete request: {$e->getMessage()}";
}

?>

