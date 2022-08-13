<?php

if (isset($_POST['submit'])) {
    $temp_file = $_FILES['a']['tmp_name'];
    $dest = "sound/" . $_FILES['a']['name'];
    if (move_uploaded_file($temp_file, $dest)) {
        $audio = $dest;
    } else {
        echo "upload fail";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>


</head>

<body>
    <header class="TitleBox">
        <div class="textBeside">
            A/S to Texting
        </div>
    </header>
    <div class="container">
        <form name="f1" method="POST" enctype="multipart/form-data">
            <div class="uploadBox">
                <input type="file" name="a" class="text-High">
                <input type="submit" name="submit" value="Upload" class="btn">
                <br>
                <?php
                if (isset($_POST["submit"])) {
                ?>
                    <audio controls>
                        <source src="<?php echo $audio ?>" type="audio/mp4  ">
                    </audio>
                <?php
                }
                ?>

            </div>
            
            <textarea type="text" id="transcript" name="q" placeholder="Speak or upload a file" class="TextInput "></textarea>

            <input class="btn startS" type="button" value="Start Recording" />
            <input class="btn stopS" type="button" value="Stop Recording" />

            
            <?php
            @$retCook = $_COOKIE['text'];
            $fname = substr($retCook, 0, 6);

            $file = fopen($fname . '.txt', "w");
            if (is_writeable($fname . '.txt')) {
                fwrite($file, $retCook);
                setcookie('text', "", time() - 3600);
            }
            else{
                echo "File not opened";
            }
            ?>
            <a href="<?php echo $fname . '.txt' ?>" class="btnLink" download>Download Generated Notes</a>
        </form>
        <!-- <div class="msg">Converted audio to text successfully.</div> -->
    </div>
</body>

</html>