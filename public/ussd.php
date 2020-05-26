<?php
//8f971ccbbd8fbd78fcef0709e3b03a3954f13da85d810a604df9f595b3ba1424

//*384*5729#
// Reads the variables sent via POST

$text = $_GET['USSD_STRING'];
$phonenumber = $_GET['MSISDN'];
$serviceCode = $_GET['serviceCode'];
$sessionid = 'a2wos2dscvmmytmougf';
$level = explode("*", $text);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=test", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
//check for fraud
//TODO: Add time to they query to check whether the time it was logged was less than 30mins
$fraud_sql = $pdo->prepare("SELECT * FROM fraud_check WHERE phone = ? AND updated_at > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 30 minute) LIMIT 1");
$fraud_sql->execute([$phonenumber]);
while ($row = $fraud_sql->fetch(PDO::FETCH_ASSOC)) {
    $updated_at = $row['updated_at'];
    $fraud_status = (int) $row['fraud_status'];
}
//if(!$arr) exit('No rows');
// var_export($arr);
// $stmt = null;
// $fraud_sql = "";
// $fraud_result = $conn->query($fraud_sql);

// If the phone number is found
// if($fraud_result->num_rows !== 0){
//     while($row = $fraud_result->fetch_assoc()) {
//         $updated_at = $row['updated_at'];
//         $fraud_status = (int) $row['fraud_status'];
//     }

// }

if(isset($fraud_status) && $fraud_status == 1){
    // if($fraud_status == 1){
    //if($updated_at < time() - (60 * 30)){
    // die('Here should br working');
    // It means we the record has been created less than 30minutes ago
    $response = "END You've been barred from using this service. Try again in 30mins";
    //}
}

//Check to see whether the text string is set and not empty
else if(isset($text)){
    if($text == ''){
        //This means we have to bring up the first menu

        //Insert data into DB and store the last shown menu and progress
        $log_userdata = $pdo->prepare("INSERT INTO logs (phone, sessionid, lastmenu, account, bank, pin, progress, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $log_userdata->execute([$phonenumber, $sessionid, 'acct', '', '', '', 0, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);

        if($log_userdata->rowCount() > 0){

            $response="CON Welcome to Fastrak.\nPlease enter destination account number\n";

        }else{

            $response = "END Cant process this right now. please try again.";

        }

    }else{
        //Check database to know where we are,
        $get_progress = $pdo->prepare("SELECT progress, lastmenu FROM logs WHERE phone = ? AND sessionid = ?");
        $get_progress->execute([$phonenumber, $sessionid]);

        // if results are found
        if($get_progress->rowCount() > 0){
            while($row = $get_progress->fetch(PDO::FETCH_ASSOC)) {
                $progress = $row['progress'];
                $lastmenu = $row['lastmenu'];
            }
            //call this function to check last appended string, store if possible and proceed to the next stage
            $response = save_and_proceed_to_next_menu($pdo, $progress, $lastmenu, $phonenumber, $sessionid);
        }else{
            $response = "END There is a problem with your request" ;
        }

    }
}
function save_and_proceed_to_next_menu($pdo, $progress, $lastmenu, $phonenumber, $sessionid){
    if($progress == 0){
        //This means that the user jus appended their first string with should be the account number

        $acct = check_string($progress);

        //insert the account number into a database
        $log_acct = $pdo->prepare("UPDATE logs SET account=? WHERE phone=? AND sessionid=?");
        $log_acct->execute([$acct, $phonenumber, $sessionid]);
        if($log_acct->rowCount() > 0){
            //Update the log table with the las menu that was shown
            $update_menu = $pdo->prepare("UPDATE logs SET lastmenu=?, progress=? WHERE phone=? AND sessionid=?");
            $update_menu->execute(['bank1', 1, $phonenumber,$sessionid]);
            if($update_menu->rowCount() > 0){
                // Get the banks
                $response = get_bank('bank1');
                return $response;
            }else{
                $response = "END The request couldn't be completed, please try again";
                return $response;
            }
        }else{
            $response = "END Sorry request couldn't be processed";
            return $response;
        }

    }else if($progress == 1){
        // This means that the account number has been stored successfully and the first bank menu has been shown
        // Check to make sure only user is typing in one command at a time without adding *

        $selected_number = check_string($progress);

        // if($arraycount > 2){
        //     // this means that the user appended more than two strings
        //     $response = "END Sorry, this is not allowed";
        // }else{
        //     $selected_number = $level[1];
        // }
        if($lastmenu == 'bank1'){
            // this is the first menu, make sure that  the string appended in not to go to the next stage
            if($selected_number !== '7'){
                $bank_name = get_bank_equivalent_to_number($selected_number);
                // Store the bank in the database
                //Update menu and progress
                $update_bank = $pdo->prepare("UPDATE logs SET bank=?, acct_name=?, progress=? WHERE phone=? AND sessionid=?");
                $update_bank->execute([$bank_name, 'Omesu Chinedu', 2, $phonenumber, $sessionid]);
                if($update_bank->rowCount() > 0){
                    // Get the banks
                    $response = "CON Enter your fastrak pin";
                    return $response;
                }else{
                    $response = "END The request couldn't be completed, please try again";
                    return $response;
                }
            }else{
                $update_menu = $pdo->prepare("UPDATE logs SET lastmenu=? WHERE phone=? AND sessionid=?");
                $update_menu->execute(['bank2', $phonenumber, $sessionid]);
                if($update_menu->rowCount() > 0){
                    // Get the banks
                    $response = get_bank('bank2');
                    return $response;
                }else{
                    $response = "END The request couldn't be completed, please try again";
                    return $response;
                }
            }

        }else if($lastmenu == 'bank2'){
            // this is the secoond menu, make sure that  the string appended in not to go to the next stage
            if($selected_number !== '00'){
                $bank_name = get_bank_equivalent_to_number($selected_number);
                // Store the bank in the database
                //Update menu and progress
                $update_bank = $pdo->prepare("UPDATE logs SET bank='$bank_name', acct_name='Peter Chinedu', progress=2 WHERE phone=$phonenumber AND sessionid=?");
                $update_bank->execute([$bank_name, 'Peter Chinedu', 2, $phonenumber, $sessionid]);
                if($update_bank->rowCount() > 0){
                    // Get the banks
                    $response = get_pin_menu();
                    return $response;
                }else{
                    $response = "END The request couldn't be completed, please try again";
                    return $response;
                }
            }else{
                $update_menu = $pdo->prepare("UPDATE logs SET lastmenu=? WHERE phone=? AND sessionid=?");
                $update_menu->execute(['bank1', $phonenumber, $sessionid]);
                if($update_menu->rowCount() > 0){
                    // Get the banks
                    $response = get_bank('bank1');
                    return $response;
                }else{
                    $response = "END The request couldn't be completed, please try again";
                    return $response;
                }
                //Update the last shown menu
            }
        }

    }else if($progress == 2){
        // This means that the user has selected a bank successfully
        //Let's check the appended string for the latest
        $pin = check_string($progress);
        $response = check_pin($pdo, $pin, $phonenumber, $sessionid);
        return $response;
    }
}

function check_string($progress){
    global $text;
    $level = explode('*', $text);
    $arraycount = count($level);
    if($progress == 0){
        if($arraycount > 1){
            // this means that the user appended more than two strings
            $response = "END Sorry, this is not allowed";
            return $response;
        }else{
            $acct = $level[0];
            return $acct;
        }
    }else if($progress == 1){
        if($arraycount > 2){
            // this means that the user appended more than two strings
            $response = end($level);
            return $response;
        }else{
            $selected_number = $level[1];
            return $selected_number;
        }
    }else if($progress == 2){

        $pin = end($level);
        return $pin;

    }
    // else{
    //     $response = "END Request not understood";
    //     return $response;
    // }
}

function get_bank($bankMenuToShow){

    if($bankMenuToShow == 'bank1'){
        $response="CON Select Destination Bank\n";
        $response .= "1. First Bank\n";
        $response .= "2. Fidelity Bank\n";
        $response .= "3. FCMB\n";
        $response .= "4. Zenith Bank\n";
        $response .= "5. GTBank\n";
        $response .= "6. UBA\n";
        $response .= "7. Next\n";
        return $response;
    }else if($bankMenuToShow == 'bank2'){
        $response="CON Select Destination Bank\n";
        $response .= "8. Access Bank\n";
        $response .= "9. Keystone Bank\n";
        $response .= "10. Wema Bank\n";
        $response .= "11. Union Bank\n";
        $response .= "12. Polaris Bank\n";
        $response .= "13. Eco bank\n";
        $response .= "00. Back\n";
        return $response;
    }else{
        $response = "Request not understood";
        return $response;
    }

}

function get_bank_equivalent_to_number($bankNumber){
    switch ($bankNumber) {
        case 1:
            return 'First Bank';
            break;
        case 2:
            return 'Fidelity Bank';
            break;
        case 3:
            return 'FCMB';
            break;

        case 4:
            return 'Zenith Bank';
            break;

        case 5:
            return 'GT Bank';
            break;

        case 6:
            return 'UBA';
            break;



        case 8:
            return 'Access Bank';
            break;

        case 11:
            return 'Diamond Bank';
            break;
        case 9:
            return 'Keystone Bank';
            break;

        case 10:
            return 'Wema Bank';
            break;

        case 11:
            return 'Union Bank';
            break;

        case 12:
            return 'Polaris Bank';
            break;

        case 13:
            return 'Eco Bank';
            break;
        default:
            return false;
            break;
    }
}

function get_pin_menu(){
    $response = "CON Enter your fastrak pin";
    return $response;
}

function check_pin($pdo, $pin_to_check, $phonenumber, $sessionid){
    //Check the database for the pin info provided
    $check_pin = $pdo->prepare("SELECT * FROM pins WHERE pin =?");
    $check_pin->execute([$pin_to_check]);

    // If the pin number is found
    if($check_pin->rowCount() > 0){
        // Hurrayy! We found our pin. Let's grab information to store in our logs table
        while($row = $check_pin->fetch(PDO::FETCH_ASSOC)) {
            $amount = $row['amount'];
            $condition = $row['condition'];
        }
        if($condition == 'live'){
            $update_pin = $pdo->prepare("UPDATE logs SET pin=?, amount=? WHERE phone=? AND sessionid=?");
            $update_pin->execute([$pin_to_check, $amount, $phonenumber, $sessionid]);
            if($update_pin->rowCount() > 0){
                // After updating the log table, collect the information from the database and use it for confirmation
                $confirm_details = $pdo->prepare("SELECT * FROM logs WHERE phone=? AND sessionid=?");

                $confirm_details->execute([$phonenumber, $sessionid]);

                if($confirm_details->rowCount() > 0){
                    while($row = $confirm_details->fetch(PDO::FETCH_ASSOC)) {
                        $acct_name = $row['acct_name'];
                        $bank = $row['bank'];
                    }
                    $response = "CON Please confirm that you are sending $amount to $acct_name at $bank";
                    return $response;


                }else{
                    $response = "CON Couldn't get complete transaction details, please try again";
                    return $response;
                }
            }else{
                $response = "END Couldn't completed the transaction, please try again";
                return $response;
            }
        }else if($condition == 'generated'){
            $response = "END The PIN entered is not an active PIN";
            return $response;

        }else if($condition == 'pending'){
            $response = "END The PIN processing is on hold. Try again later";
            return $response;

        }else if($condition == 'used'){
            $response = "END The PIN has been used by another customer";
            return $response;

        }


    }else{
        // This might be fraud, check to see if this  user has tried a wrong pin before
        // Update the trial, menu

        // TODO: Check whether the person has tried a wrong pin in the last 15min

        $check_trials = $pdo->prepare("SELECT trials FROM fraud_check WHERE phone =?");
        $check_trials->execute([$phonenumber]);

        // if results are found
        if($check_trials->rowCount() > 0){
            while($row = $check_trials->fetch(PDO::FETCH_ASSOC)) {
                $trial = $row['trials'];
                $trial = (int) $trial;
            }
            if($trial > 2){
                // This means the guy has been here before, it's time for some blocking
                $update_fraud = $pdo->prepare("UPDATE fraud_check SET fraud_status=? WHERE phone=?");
                $update_fraud->execute([1, $phonenumber]);
                if($update_fraud->rowCount() > 0){
                    // Update the log table with the last menu that was shown
                    $response = "END You've been barred from using this service. Try again in 30mins.";
                    return $response;
                }else{
                    $response = "END Sorry request couldn't be processed. update fraud failed";
                    return $response;
                }

            }else{
                // Add one to the already existing trials
                $trial += 1;
                $update_trial_count = $pdo->prepare("UPDATE fraud_check SET trials=? WHERE phone=?");
                $update_trial_count->execute([$trial, $phonenumber]);
                if($update_trial_count->rowCount() > 0){
                    // Update the log table with the last menu that was shown
                    $response = "END Entering the wrong pin 3 times will bar you from using this service.";
                    return $response;
                }else{
                    $response = "END Sorry request couldn't be completed, pleasetry again";
                    return $response;
                }
            }
        }else{

            $log_possible_fraud = $pdo->prepare("INSERT INTO fraud_check (phone, sessionid, trials, fraud_status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)");
            $log_possible_fraud->execute([$phonenumber, $sessionid, 1, 0, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
            if($log_possible_fraud->rowCount() > 0){

                // Update the log table with the last menu that was shown
                $response = "END Wrong pin please try again";
                return $response;

            }else{

                $response = "END Sorry request couldn't be processed. cant log possible fraud";
                return $response;

            }

        }

    }
}

function get_confirmation_menu(){

}

header('Content-type: text/plain');
echo $response;

