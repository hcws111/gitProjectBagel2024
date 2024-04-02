<?php
    require_once "../../conn.php";

    $sql = "SELECT ID, WebName, FullName, Mobile, Email, Age_ID, Photo, MemberType_ID, UIDMP, Active, Created_at, Updated_at From member ORDER BY ID DESC";
     
    // switch($value)
    // {
    //     case 0: {
    //         $sql = "SELECT ID, WebName, FullName, Mobile,  From member ORDER BY ID DESC";
    //     }break;
    //     case 1: {
        
    //     }break;
    //     case 2: break;
    // }
    
    $result = mysqli_query($conn, $sql);    
    if(mysqli_num_rows($result)>0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        echo '{"state":true, "data":'.json_encode($mydata).', "message":"查詢會員資料成功!"}';
    }else{
        echo '{"state":false, "message":"查詢會員資料失敗!"}';
    }
    mysqli_close($conn);
?>
