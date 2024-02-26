<?php
    $array = array("firstname" => "", "name" => "", "email" => "phone", "message" => "", "firstnameERR" => "", "nameERR" => "", "emailERR" => "", "phoneERR" => "", "messageERR" => "", "isSuccess" => "false", );
    $emailTo = "pmedkhair@gmail.com";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $array["firstname"] = verifyinput($_POST['firstname']);
        $array["name"] = verifyinput($_POST['name']);
        $array["email"] = verifyinput($_POST['email']);
        $array["phone"] = verifyinput($_POST['phone']);
        $array["message"] = verifyinput($_POST['message']);
        $array["isSuccess"] = true;
        $emailText = "";
        if (empty($array["firstname"])) {
            $array["firstnameERR"] = "i want to know your first name !";
            $array["isSuccess"] = false;
        }else
            $emailText .= "firstname : {$array["firstname"]} \n";
        if (empty($array["name"])) {
            $array["nameERR"] = "i want to know your name !";
            $array["isSuccess"] = false;
        }else
            $emailText .= "name : {$array["name"]} \n";
        
        if (!isEmail($array["email"])) {
            $array["emailERR"]= "that's not an email";
            $array["isSuccess"] = false;
        }else
            $emailText .= "email : {$array["email"]}\n";
        if (!isPhone($array["phone"])) { 
            $array["phoneERR"] = "that's not a phone number";
            $array["isSuccess"] = false;
        }else
            $emailText .= "phone : {$array["phone"]}\n";
        if (empty($array["message"])) {
            $array["messageERR"] = "i want to know what do you want to say !";
            $array["isSuccess"] = false;
        }else
            $emailText .= "message : {$array["message"]}\n";
        if ($array["isSuccess"]) {
            $headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReplay-To : {$array["email"]}";
            mail($emailTo, "message", $emailText,$headers);
           
        }
        echo json_encode($array);

    }
    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
    function isPhone($var){
        return preg_match("/^[0-9 ]*$/",$var);
    }
    function verifyinput($var){
        $var = trim($var);
        $var = stripcslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }
?>