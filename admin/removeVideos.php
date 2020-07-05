<?php
    require "../backValidation\dbConnection.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: ../logOut.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminCss/removeVideos.css">
    <title>Document</title>
</head>
<body>
<header>
        <?php
        if($_SESSION['admin'] == 1){
          include "adminHeader.php";
          
        }else{
            header("location: ../logOut.php");
        }
          ?>
    </header>
    <div>
    <?php
    if($_SESSION['admin'] == 1){
          include "adminOptions.php";
    }
    ?>
    </div>
    <div>
    <a href="removeVideos.php?type=FullBody">FullBody</a>
    <a href="removeVideos.php?type=UpperBody">UpperBody</a>
    <a href="removeVideos.php?type=LowerBody">LowerBody</a>
    <a href="removeVideos.php?type=Cardio">Cardio</a>
    </div>
    <section>

                       <?php
                            

                            $type = $_GET['type'];
                            $query = "SELECT * FROM $type ORDER BY ID DESC;";
                            $result = $DB->query($query);

                            while($row = mysqli_fetch_assoc($result)){
                                $videoName = basename($row['videopath'],".mp4");
                                ?>
                                <form action="removeSpecifikVideoDB.php" method="POST">
                                <div class="videos">  
                                    <h1 style="letter-spacing: 1px; margin-top: 5px"><?php echo $videoName?></h1>
                                    <video controls poster="<?php echo $row['photopath']?>"  src="<?php echo $row['videopath']?>" type="video/mp4"></video> 

                                    <!--the files needed info-->
                                    <input type="number" name="ID" id="" value="<?php echo $row['ID']?>" style="display: none;">
                                    <input type="text" name="type" id="" value="<?php echo $type?>" style="display: none;">
                                    <input type="text" name="videoname" id="" value="<?php echo $videoName?>" style="display: none;">
                                    <input type="text" name="videopath" id="" value="<?php echo $row['videopath']?>" style="display: none;">
                                    <input type="text" name="photopath" id="" value="<?php echo $row['photopath']?>" style="display: none;">
                                    <br>
                                    <!---------------------------->


                                    <input type="submit" name="submit" id="" value="Remove Video">
                                </div>
                                </form>
                                <?php
                                }
                                ?>
                        
                            <?php
                           
                            ?>
                        
            </div>

         
               
            
            
        </section>
</body>
</html>