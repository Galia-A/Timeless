<?php
require_once("inputData.php");  

//Check user input data
if(isset($_POST["userName"]) && isset($_POST["time"])){
    //save new data
    $newData = [($userNamesArray[$_POST["userName"]]), $_POST["date"], $_POST["project"], $_POST["subProject"], $_POST["instructorName"], $_POST["time"],  $_POST["reason"], $_POST["scheduled"], $_POST["subjects"]];
    //add to csv
    addInfo($newData);
}

function addInfo($newData){
    global $excelHeaders;
    $file = fopen('myTime.csv', 'a+');
    if($data = fgetcsv($file, 1000, ",") == FALSE) {
        //csv is empty
        // save the column headers
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));//for hebrew
        fputcsv($file, $excelHeaders); //headlines
    }
    
    //write new data
    fputcsv($file, $newData);
    
    fclose($file);
    header("location:index.php");
}
?>