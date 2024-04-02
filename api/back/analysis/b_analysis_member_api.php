<?php   
    require_once '../../conn.php';

    // 資料庫查詢                
    $sql = "SELECT Age_ID, COUNT(Age_ID) Num FROM `member` GROUP BY Age_ID Order BY Age_ID;";
    $result = mysqli_query($conn, $sql);  
    $dataAge = array();
    if(mysqli_num_rows($result)>0){       
        while($row = mysqli_fetch_assoc($result)){
            $dataAge[] = $row;
        }
    }

    $sql = "SELECT MemberType_ID, COUNT(MemberType_ID) Num FROM `member` GROUP BY MemberType_ID Order BY MemberType_ID;";
    $result = mysqli_query($conn, $sql);  
    $dataType = array();
    if(mysqli_num_rows($result)>0){       
        while($row = mysqli_fetch_assoc($result)){
            $dataType[] = $row;
        }
    }
    echo '{"state":true, "dataAge":'.json_encode($dataAge).', "dataType":'.json_encode($dataType).', "message":"查詢分析資料成功!"}';
    mysqli_close($conn);

?>
