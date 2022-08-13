<?php
include "conn.php";
include "function.php";
$output='';
?>

<?php

    if(isset($_GET['r'])){

        $shortLink = $_GET['r'];   

        // function calling   
        
        validateShortLink($shortLink);
    }

?>

<?php
    ob_start();
    // form submit ----
    if(isset($_POST['submit'])){
        $link = $_POST['link'];           
        
        // function calling   

        getAndCheck($link);
        $output = getData($link);

    }
?>


<!doctype html>
<html lang="en">

<head>
    <title>Short_URL</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
    <form method="POST" onsubmit = "return validate()">
        <div class="form-group">
            <label for="">Your full Link</label>
            <input type="text" name="link" id='link' class="form-control"  placeholder="Pest your link" >
        </div>
        <div class="form-group">
            <button type="submit" name='submit' class='form-control btn btn-primary'>Get your link</button>  
        </div>
    </form>
    <div class="output">
    <div class="form-group">
            <label for="">Your Short Link</label>
            <input type="text" id='output' name='output' class="form-control"  placeholder="Your Short link" value='<?php echo $output; ?>'>
        </div>
    </div>
    </div>

    <script>
        function validate(){
            var link = document.getElementById('link').value;

            error=[];
            
            if(link!=''){
                return true;
            }else{
                alert("Please Enter valid Link");
                return false;
            }
        }
        
    </script> 

</body>

</html>