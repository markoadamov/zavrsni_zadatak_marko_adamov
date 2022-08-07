<?php include 'work-with-database.php';  ?>

<!doctype html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>

<?php include 'header.php';

$sql = "SELECT Ime, Prezime, Pol, Id FROM author";

$authors = getData($connection, $sql);

?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div class="blog-post">
                <h2 class="blog-post-title">Create Post</h2>
            </div><!-- /.blog-post -->

            <form method="post" action="" id="usrform"> <!--Forma za kreiranje novog posta-->
            <textarea rows="15" cols="50" name="body" form="usrform" placeholder="Write your post here..." style="width: 100%;"></textarea>
            <br><br>
            <input type="text" name="title" placeholder="Your post title">
            
            <select name="chosen-author">
                <?php  
                    foreach($authors as $author)
                    {
                        $author['Pol'] === 'Z'? $boja = 'roze' : $boja = 'plava';

                        echo "<option value='{$author['Id']}' class=$boja>{$author['Ime']} {$author['Prezime']}</option>";
                    }
                ?>
            </select>

            <input type="submit" name="submit" value="Submit Post">

            <?php 
                    if (isset($_POST['submit']))
                    {
                        createPost($connection);
                    }
            ?>
            
            </form>

        </div><!-- /.blog-main -->

        <?php include 'sidebar.php';  ?>

    </div><!-- /.row -->

</main><!-- /.container -->

</body>

<?php include 'footer.php';  ?>

</html>