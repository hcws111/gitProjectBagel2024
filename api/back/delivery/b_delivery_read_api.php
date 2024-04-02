<?php
    require_once "../../conn.php";

    $sql = "SELECT ID, Name, Created_at From delivery ORDER BY ID";
     

    $result = mysqli_query($conn, $sql);    
    if(mysqli_num_rows($result)>0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        echo '{"state":true, "data":'.json_encode($mydata).', "message":"查詢交貨方式成功!"}';
    }else{
        echo '{"state":false, "message":"查詢年齡層資料失敗!"}';
    }
    mysqli_close($conn);
?>
