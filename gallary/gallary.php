<!DOCTYPE html>
<?php 
if (isset($_POST['submit'])){
    $file = $FILES['file'];
    $fileName = $_FILES['file']['name'];
    $filetmpname = $_FILES['file']['tmp_name'];
    $filesize = $_FILES['file']['size'];
    $fileerror = $_FILES['file']['error'];
    $filetype = $_FILES['file']['type'];

    print_r($file);
    echo "ll";

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    
    $allowed = array('jpg','jpeg','png');
   

    if (in_array($fileActualExt, $allowed))
    {
        if ($fileerror === 0)
        {
            if ($filesize < 1000000)
            {                
                print_r ($file);

                $fileNamenew = uniqid('', true).".".$fileActualExt;
                $fileDestination = './gallary/'.$fileNamenew;
                move_uploaded_file($filetmpname, $fileDestination);    

            }
            else
                echo "Your file is to big";
        }
        else 
            echo "there was an error uploading this file";
    }
    else
        echo "you cannot allow files of this type";
?>
    <head>
        <!-- <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./uploads.php"> -->
    </head>
    <body>
        <form  method="POST" enctype="multipart/form-data">
        <input  type="file" name="file">
        <button type="submit" name="submit">uploads</button>

        </form>
        
        <script src="" async defer></script>
    </body>
</html>