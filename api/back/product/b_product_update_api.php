<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["ID"]) && ($mydata["ID"]!="")){
                $p_ID = $mydata["ID"];
                $p_Name = $mydata["Name"];
                $p_Pno = $mydata["PNO"];
                $p_Price = $mydata["Price"];
                $p_Content = $mydata["Content"];
                $p_TypeID = $mydata["Type_ID"];
                $p_OpenOrder = $mydata["OpenOrder"];
                $p_Active = $mydata["Active"];
                $p_SaleTitleID = $mydata["SaleTitle_ID"];
                $p_Photo = $mydata["Photo"];
            
                require_once '../../conn.php';

                // 照片不是空白的
                if($p_Photo !=""){
                    // $sql = "SELECT Photo FROM product WHERE ID='$p_ID'";
                    // $result = mysqli_query($conn, $sql);  
        
                    // while($row = $result->fetch_assoc()){
                    //     if($row["Photo"]!="")
                    //     {
                    //         $p_folderPath = "/var/www/html/ProjectBagel/upload/images/product";
                    //         $filename = $p_folderPath."/".$row["Photo"];
                    //         if (file_exists($filename)) 
                    //             unlink($filename);
                    //     }
                    // }  
                    $sql = "UPDATE product SET Photo='$p_Photo' WHERE ID='$p_ID'";
                    mysqli_query($conn, $sql);
                }
            
                // 資料庫查詢
                $sql = "UPDATE product SET Name='$p_Name', PNO='$p_Pno', Price='$p_Price', Content='$p_Content', Type_ID='$p_TypeID', OpenOrder='$p_OpenOrder', Active='$p_Active', SaleTitle_ID='$p_SaleTitleID' WHERE ID='$p_ID'";
                
                if(mysqli_query($conn, $sql)){
                    echo '{"state":true, "message":"更新產品成功"}';
                }else{
                    echo '{"state":false, "message":"更新產品失敗"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
