
<?php
// Authorisation details.
send_sms("Test","972569447954");
function send_sms($msg,$phone = 0){
    $username = "saadalsaad00@gmail.com";
    $hash = "c42c43fceaa02e54fb9f93fb3d544dbc01e7a0cc8722054b29466bf86cc09e7a";

// Config variables. Consult http://api.txtlocal.com/docs for more info.
    $test = "0";

// Data for text message. This is the text message data.
    $sender = "EasyDeals"; // This is who the message appears to be from.
    $numbers = $phone; // A single number or a comma-seperated list of numbers
    $message = "EasyDeals \n ".$msg;
// 612 chars or less
// A single number or a comma-seperated list of numbers
    $message = urlencode($message);
    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
    $ch = curl_init('http://api.txtlocal.com/send/?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch); // This is the result from the API
    curl_close($ch);
}


?>


<?php
/* Send an SMS using Twilio. You can run this file 3 different ways:
 *
 * 1. Save it as sendnotifications.php and at the command line, run
 *         php sendnotifications.php
 *
 * 2. Upload it to a web host and load mywebhost.com/sendnotifications.php
 *    in a web browser.
 *
 * 3. Download a local server like WAMP, MAMP or XAMPP. Point the web root
 *    directory to the folder containing this file, and load
 *    localhost:8888/sendnotifications.php in a web browser.


// Step 1: Get the Twilio-PHP library from twilio.com/docs/libraries/php,
// following the instructions to install it with Composer.
require_once "Twilio/vendor/autoload.php";
use Twilio\Rest\Client;

// Step 2: set our AccountSid and AuthToken from https://twilio.com/console
$AccountSid = "AC5cf0efb18bb84cf84d7cdb8abe6f2bdf";
$AuthToken = "d6eb50262f6a5a1c21dbcbb1dd8f41a6";

// Step 3: instantiate a new Twilio Rest Client
$client = new Client($AccountSid, $AuthToken);

// Step 4: make an array of people we know, to send them a message.
// Feel free to change/add your own phone number and name here.
$people = array(
    "+970569447954" => "Saad",
    "+970595225646" => "Saad"
);

// Step 5: Loop over all our friends. $number is a phone number above, and
// $name is the name next to it
foreach ($people as $number => $name) {

    $sms = $client->account->messages->create(

    // the number we are sending to - Any phone number
        $number,

        array(
            // Step 6: Change the 'From' number below to be a valid Twilio number
            // that you've purchased
            'from' => "+14849017736",

            // the sms body
            'body' => "Hey $name, Monkey Party at 6PM. Bring Bananas!"
        )
    );

    // Display a confirmation message on the screen
    echo "Sent message to $name";
}
 */
