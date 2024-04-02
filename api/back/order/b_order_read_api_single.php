<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["PoNo"]) && isset($mydata["WebName"]) && isset($mydata["SearchType"]) && ($mydata["PoNo"]!="") && ($mydata["WebName"]!="") && ($mydata["SearchType"]!="")){
                $p_PoNo = $mydata["PoNo"];
                $p_WebName = $mydata["WebName"];
                $p_SearchType =$mydata["SearchType"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';

                $sql ="";
                switch($p_SearchType)
                {
                    case "PoNo":  $sql = "SELECT * From orderP WHERE PoNo='$p_PoNo' ORDER BY ID DESC"; break;
                    case "WebName": $sql = "SELECT * From orderP WHERE WebName='$p_WebName' ORDER BY ID DESC"; break;
                }
            
                // 資料庫查詢                
                // $sql = "SELECT * From orderP WHERE PoNo='$p_PoNo'";
                $result = mysqli_query($conn, $sql);    
                if(mysqli_num_rows($result)>0){
                    $mydata = array();
                    while($row = mysqli_fetch_assoc($result)){
                        $mydata[] = $row;
                    }
                    echo '{"state":true, "data":'.json_encode($mydata).', "message":"查詢指定訂單成功!"}';
                }else{
                    echo '{"state":false, "message":"查詢指定訂單失敗!"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
