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

<?php include 'header.php';  ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">


            <div class="blog-post">
                <h2 class="blog-post-title">Create New Author</h2>
            </div><!-- /.blog-post -->

            <form method="post" action="" id="usrform">
            <input type="text" name="ime" placeholder="Your name">
            <br><br>
            <input type="text" name="prezime" placeholder="Your lastname">
            <br><br>
            <input type="radio" name="pol" value="M">
            <label for="">Muski pol</label>
            <br>
            <input type="radio" name="pol" value="Z">
            <label for="">Zenski pol</label>
            <br><br>
            <input type="submit" name="submit" value="Create Author">

            <?php 
                    if (isset($_POST['submit']))
                    {
                        echo createAuthor($connection);
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