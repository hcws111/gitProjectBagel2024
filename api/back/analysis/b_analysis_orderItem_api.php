<?php
    require_once '../../conn.php';

    $sql = "SELECT PNO, COUNT(PNO) Num FROM `orderItem` GROUP BY PNO ORDER BY PNO";
    $result = mysqli_query($conn, $sql);  
    $dataPNO = array();
    if(mysqli_num_rows($result)>0){       
        while($row = mysqli_fetch_assoc($result)){
            $dataPNO[] = $row;
        }
    }
    echo '{"state":true, "dataPNO":'.json_encode($dataPNO).', "message":"查詢分析資料成功!"}';
    mysqli_close($conn);

?>