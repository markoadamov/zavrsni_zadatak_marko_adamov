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

            <?php
            
            // pripremamo upit
            $sql = "SELECT posts.Id, posts.Title, posts.Body, posts.Created_at, author.Ime, author.Prezime, author.Pol 
            FROM posts JOIN author ON posts.Author_id = author.Id HAVING Id={$_GET['post-id']}";
            $post = getData($connection, $sql)[0];

            // echo "<pre>";
            // var_dump($post);
            // echo "</pre>";

            // $sql = "SELECT Id, Title, Body, Author, Created_at
            // FROM posts WHERE Id={$_GET['post-id']}";
            // $post = getData($connection, $sql)[0];

            // $sql = "SELECT Id, Author, Text, Post_id
            // FROM comments";
            // $comments = getData($connection, $sql);

            $sql = "SELECT comments.Id, comments.Text, comments.Post_id, author.Ime, author.Prezime, author.Pol 
            FROM comments JOIN author ON comments.Author_id = author.Id";
            $comments = getData($connection, $sql);

            $sql = "SELECT Ime, Prezime, Pol, Id FROM author";
            $authors = getData($connection, $sql);
            ?>

            <?php $post['Pol'] === 'Z' ? $boja = 'roze' : $boja = 'plava';?>

            <div class="blog-post">
                <h2 class="blog-post-title"><?php echo ($post['Title']);?></h2>
                <p class="blog-post-meta"><?php echo ($post['Created_at']);?> by <label <?php echo "class= $boja"; ?> ><?php echo ($post['Ime']." ".$post['Prezime']);?></label></p>

                <p><?php echo ($post['Body']);?></p>
            </div><!-- /.blog-post -->

            <form method="post" action="" id="usrform">
                <textarea rows="4" cols="50" name="comment" form="usrform" placeholder="Enter comment here..." style="width: 100%;"></textarea>
                <br><br>
                <!-- <input type="text" name="author" placeholder="Your name"> -->
                <select name="chosen-author">
                    <?php  
                        foreach($authors as $author)
                        {
                            $author['Pol'] === 'Z'? $boja = 'roze' : $boja = 'plava';

                            echo "<option value='{$author['Id']}' class=$boja>{$author['Ime']} {$author['Prezime']}</option>";
                        }
                    ?>
                </select>

                <input type="submit" name="submit" value="Submit Comment">

                <?php 
                    if (isset($_POST['submit']))
                    {
                        submitComment($connection);
                    }
                ?>    
            </form>

            <?php include 'comments.php';  ?>

        </div><!-- /.blog-main -->

        <?php include 'sidebar.php';  ?>

    </div><!-- /.row -->

</main><!-- /.container -->

</body>

<?php include 'footer.php';  ?>

</html>