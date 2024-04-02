<?php


    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["PNO"]) && ($mydata["PNO"]!="")){
                $p_Name = $mydata["Name"];
                $p_Pno = $mydata["PNO"];
                $p_Price = $mydata["Price"];
                $p_Content = $mydata["Content"];
                $p_TypeID = $mydata["Type_ID"];
                $p_OpenOrder = $mydata["OpenOrder"];
                $p_Active = $mydata["Active"];
                $p_SaleTitleID = $mydata["SaleTitle_ID"];
                $p_Photo = $mydata["Photo"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
               $sql = "INSERT INTO product(Name, PNO, Price, Content, Type_ID, OpenOrder, Active, SaleTitle_ID, Photo) VALUES (?,?,?,?,?,?,?,?,?)";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("ssisissis", $p_Name, $p_Pno, $p_Price, $p_Content, $p_TypeID, $p_OpenOrder, $p_Active, $p_SaleTitleID, $p_Photo);
               
                if($stmt->execute()){
                    echo '{"state":true, "message":"新增產品成功"}';
                }else{
                    echo '{"state":false, "message":"新增產品失敗"}';
                }
                $stmt->close();
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }

   

    
?>
