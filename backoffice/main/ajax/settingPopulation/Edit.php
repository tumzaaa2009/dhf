<?php
    session_start();
    include("../../../../config/connect.php");
    include("../../../../config/func.php");
    include("../../../../config/jwt.php");
    date_default_timezone_set("Asia/Bangkok");


    $year = $_POST["year"];
    $population = $_POST["population"];

    $datetime = date('Y-m-d H:i:s');
    $sql_edit = "UPDATE dhf_population_lvl1 SET 
        population = '$population'
        WHERE year = '$year'";

    $result_update = $db_saraburi->exec($sql_edit);
    if($result_update == "1"){
        $result = 1;
    } elseif($result_update == "0") {
        $result = 2;
    } elseif($result_update == "") {
        $result = 0;
    }    
    $arr['result'] = $result;
    echo json_encode($arr);
?>
