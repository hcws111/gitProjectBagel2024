<?php
    require_once "../conn.php";

    $sql = "SELECT ID, Name, Tag, Created_at From memberType ORDER BY ID";
     

    $result = mysqli_query($conn, $sql);    
    if(mysqli_num_rows($result)>0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        echo '{"state":true, "data":'.json_encode($mydata).', "message":"查詢會員分類成功!"}';
    }else{
        echo '{"state":false, "message":"查詢會員分類失敗!"}';
    }
    mysqli_close($conn);
?>
