<?php
// randome string generate function
function randomString($link,$length=8){
    $characters='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $car_length=strlen($characters);
    
    $randomString='';
    for($i=0;$i<$length;$i++){
        $randomString.= $characters[rand(0,$car_length-1)];
    }
    return $randomString;
}
    // echo substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyz-',ceil(5/strlen($x)))),1,5);
    // function randomString($length=8){
    //     $characters='0123456789abcdefghijklmnopqrstuvwxyz-';
    //     $car_length=strlen($characters);
    
    //     $randomString='';
    //     for($i=0;$i<$length;$i++){
    //         $randomString.= $characters[rand(0,$car_length-1)];
    //     }
    //     return $randomString;
    // }


function validateShortLink($shortLink){
    include "conn.php";
    $query = mysqli_query($conn,"SELECT * FROM  url WHERE status = 1 AND short_link = '$shortLink' ") ;
    if(mysqli_num_rows($query)){
        
        $data = mysqli_fetch_array($query);
        $link = $data['link'];
        header('location:'.$link);
    }else{
        echo "This link is expair or invalid";
    }
}


function getAndCheck($link){
    include "conn.php";
        // short url function calling.........
     
    $shortLink =randomString(8);
    echo "<br>";
    $check_shortLink= mysqli_query($conn,"SELECT * FROM url WHERE status=1 AND short_link='$shortLink'");
    if(mysqli_num_rows($check_shortLink)){
        getAndCheck($link);
    }else{
            // insert data into  database.........
        $check_fullLink= mysqli_query($conn,"SELECT * FROM url WHERE status=1 AND link='$link'");
        if(mysqli_num_rows($check_fullLink)){
            ?>
            <script> alert("This link is Already Shorten") </script>
            <?php
            
        }else{
            $sql="INSERT INTO url (link,short_link,status) VALUES ('$link','$shortLink','1')";
            $run = mysqli_query($conn,$sql);
        }                
    }
}



function getData($link){
    include "conn.php";
        // fetch data from database.......
    $get= mysqli_query($conn,"SELECT * FROM url WHERE status=1 AND link ='$link' ");
    $fetch=mysqli_fetch_array($get);
    $addUrl = '?r=';
    return $addUrl.$fetch['short_link'];
}    

?>