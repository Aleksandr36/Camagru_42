<?php ob_start(); ?>
    <div>
        <table class="header">
          <td><h2><a style=" font-weight: bold; transform: scale(1.3); text-decoration: none;" href="../camera.php">Сделать фото</a></h2></td>
          <td><h2><a style=" font-weight: bold; transform: scale(1.3); text-decoration: none;" href="../camera1.php">Загрузить фото</a></h2></td>  
        </table> 
    </div>
    <hr id="hr_title"/>
    <div id="camera">
        <div id='div_video'>
            <div id='overlay'>
                <p id="overlay_msg">Загрузить фото</p>
                <img id='id_sticker' style="width:100%"  />
            </div>
            <video id='video'></video>
            <img id='camera_img'/>
        </div>
        <div id='div_stickers'>
            <?php
            while ($sticker = $stickers->fetch())
            {
                echo "<img src='".$sticker['img_stickers']."' alt='".$sticker['id_stickers']."'>";
            }
            echo "<img src='".$day['img_stickers']."' alt='".$sticker['id_stickers']."'>";
            ?>
        </div>
        </br>
       <form method="POST" enctype="multipart/form-data" id="picture_up" action="../model/addWebcam.php">
            <label for="fileToUpload" >Выберите фото</label>
            <input style="display: none" type="file" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)">
            <input type="text" name="sticker" value="" id="sticker_id" style="display: none">
            <input type="text" name="src" value="coucou" style="display: none;">
            <input type="submit" value="Подтвердить" id="uploadbutton" name="submit" >
        </form>
        </br>
       
        <div id='camera_gallery'>
            <img style="display:none" id="photo" alt="photo">
        </div>
    </div>
 

<script src="./public/js/camera1.js"></script> 

<script>
    var loadFile = function(event) {
    var output = document.getElementById('camera_img');
    output.src = URL.createObjectURL(event.target.files[0]);
    document.querySelector('#overlay_msg').style.display="none";
    document.querySelector('#video').style.display="none";
    output.style.display="block";
  };
</script>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>

