<?php
require_once("admin/inputData.php");  

//Check user input data
if(isset($_POST["userName"]) && isset($_POST["time"])){
    //save subjects together
    $subjects = "";
    for ($i=1; $i <= $_POST["subjectsCount"]; $i++) { 
        $subjectName = "subjects".$i;
        if(isset($_POST[$subjectName]) && $_POST[$subjectName] != array_search('אחר', $subjectsArray)  && $_POST[$subjectName] != ""){
            $subjects .= $subjectsArray[$_POST[$subjectName]] .", ";
        }
    }
    if($_POST["subjectsOtherCount"] > 0){
        for ($i=1; $i <= $_POST["subjectsOtherCount"]; $i++) { 
            $otherName = "other".$i;
            if(isset($_POST[$otherName])){
                $subjects .= $_POST[$otherName] .", ";
            }
        }
    }
    if($subjects !=""){
       // rtrim($subjects, " ");
       $subjects = substr($subjects, 0, -2);
    }
    echo $subjects;
    echo $_POST["scheduled"];
    //save new data to array
   $newData = [($userNamesArray[$_POST["userName"]]), $_POST["date"], $_POST["project"], $_POST["subProject"], $_POST["instructorName"], $_POST["time"],  $_POST["reason"], $_POST["scheduled"], $subjects];
    // $newData = [($userNamesArray[$_POST["userName"]]), $_POST["date"], $_POST["project"], $_POST["subProject"], $_POST["instructorName"], $_POST["time"],  $_POST["reason"], "", $subjects];//$_POST["scheduled"]
    //add to csv
    addInfo($newData);
}

function addInfo($newData){
    global $excelHeaders;
    $file = fopen('Timeless.csv', 'a+');
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