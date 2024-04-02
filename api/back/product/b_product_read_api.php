<?php
    require_once "../../conn.php";

    $sql = "SELECT * From product ORDER BY ID";
     

    $result = mysqli_query($conn, $sql);    
    if(mysqli_num_rows($result)>0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        echo '{"state":true, "data":'.json_encode($mydata).', "message":"查詢產品成功!"}';
    }else{
        echo '{"state":false, "message":"查詢產品失敗!"}';
    }
    mysqli_close($conn);
?>
