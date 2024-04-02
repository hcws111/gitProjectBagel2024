<?php   
    require_once '../../conn.php';

    $sql = "SELECT County, COUNT(County) cityNum, sum(Money) cityMoney FROM orderP GROUP BY County;";
    $result = mysqli_query($conn, $sql);  
    $dataCityMoney = array();
    if(mysqli_num_rows($result)>0){       
        while($row = mysqli_fetch_assoc($result)){
            $dataCityMoney[] = $row;
        }
    }
    
    $sql = "SELECT Pay_ID, COUNT(Pay_ID) Num FROM `orderP` GROUP BY Pay_ID ORDER BY Pay_ID;";
    $result = mysqli_query($conn, $sql);  
    $dataPay = array();
    if(mysqli_num_rows($result)>0){       
        while($row = mysqli_fetch_assoc($result)){
            $dataPay[] = $row;
        }
    }

    $sql = "SELECT Delivery_ID, COUNT(Delivery_ID) Num FROM `orderP` GROUP BY Delivery_ID;";
    $result = mysqli_query($conn, $sql);  
    $dataDelivery = array();
    if(mysqli_num_rows($result)>0){       
        while($row = mysqli_fetch_assoc($result)){
            $dataDelivery[] = $row;
        }
    }

    $sql = "SELECT OrderState, COUNT(OrderState) Num FROM orderP GROUP BY OrderState";
    $result = mysqli_query($conn, $sql);  
    $dataState = array();
    if(mysqli_num_rows($result)>0){       
        while($row = mysqli_fetch_assoc($result)){
            $dataState[] = $row;
        }
    }

    echo '{"state":true, "dataCityMoney":'.json_encode($dataCityMoney).', "dataPay":'.json_encode($dataPay).', "dataDelivery":'.json_encode($dataDelivery).', "dataState":'.json_encode($dataState).', "message":"查詢分析資料成功!"}';
    mysqli_close($conn);

?>
