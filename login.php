<?php
/**
 * contributed by: Art of WiFi
 * description: example basic PHP script to auth a guest device and attach a note to it, this requires the device to be connected to the WLAN/LAN at moment of authorization
 */
require_once('src/Client.php');

$userCaptivePassword = ""; // the password for your captive portal
$controlleruser      = ""; // the user name for access to the UniFi Controller
$controllerpassword  = ""; // the password for access to the UniFi Controller
$controllerurl       = ""; // full url to the UniFi Controller, eg. 'https://22.22.11.11:8443', for UniFi OS-based controllers a port suffix isn't required, no trailing slashes should be added
$controllerversion   = ""; // the version of the UniFi Controller, e.g. '4.6.6' (must be at least 4.0.0)
$controllersite       = ""; // the site ID of your site in the UniFi Controller.
$debug               = false; // set to true (without quotes) to enable debug output to the browser and the PHP error log

header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if ($_POST["password"] == $userCaptivePassword) {
} else {
    $output = array(
        "error" => true,
        "message" => "The password provided is incorrect"
    );
    echo json_encode($output);
    die();
}
$d = date("Y-m-d h:i:sa");
if (isset($_POST["client"])) {
    $mac = $_POST["client"];
} else {
    $output = array(
        "error" => true,
        "message" => "No client MAC address was provided"
    );
    echo json_encode($output);
    die();
}
$duration         = 2000;
$site_id          = $controllersite;
$note             = "This client was authorized via the captive portal at " . $d;
$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();
$auth_result      = $unifi_connection->authorize_guest($mac, $duration);
$getid_result     = $unifi_connection->stat_client($mac);
$user_id          = $getid_result[0]->_id;
$note_result      = $unifi_connection->set_sta_note($user_id, $note);
$result           = json_encode($auth_result, JSON_PRETTY_PRINT);
if ($result == true) {
    $output = array(
        "error" => false,
        "message" => "Success"
    );
    echo json_encode($output);
    die();
} else {
    $output = array(
        "error" => true,
        "message" => "Unable to authenticate with the UniFi controller"
    );
    echo json_encode($output);
    die();
}
