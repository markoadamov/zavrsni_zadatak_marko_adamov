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

            <?php var_dump($_GET); ?>

            <?php
                        // pripremamo upit
            $sql = "SELECT Id, Title, Body, Author, Created_at
            FROM posts";
            $posts = getData($connection, $sql);

            $sql = "SELECT Id, Author, Text, Post_id
            FROM comments";

            $comments = getData($connection, $sql);

            ?>

            <div class="blog-post">
                <h2 class="blog-post-title"><a href="single-post.php"><?php echo ($posts[$_GET['post-id']]['Title']);?></a></h2>
                <p class="blog-post-meta"><?php echo ($posts[$_GET['post-id']]['Created_at']);?> by <a href="#"><?php echo ($posts[$_GET['post-id']]['Author']);?></a></p>

                <p><?php echo ($posts[$_GET['post-id']]['Body']);?></p>
            </div><!-- /.blog-post -->

            <form action="/action_page.php" id="usrform">
            <input type="text" name="usrname" placeholder="Your name">
            <input type="submit">
            </form>
            <br>
            <textarea rows="4" cols="50" name="comment" form="usrform" placeholder="Enter comment here..."></textarea>

            <hr>
            <h4>Comments</h4>
            <br>

            <div>
                <p>Test</p>
            </div>

        </div><!-- /.blog-main -->

        <?php include 'sidebar.php';  ?>

    </div><!-- /.row -->

</main><!-- /.container -->

</body>

<?php include 'footer.php';  ?>

</html>