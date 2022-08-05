
            <hr>
            <h4>Comments</h4>
            <br>


            <?php
            
            $check_comment_exist = false;

            foreach($comments as $comment) {
                
                // echo ((((int)($_GET['post-id']))+1).' i '. $comment['Post_id'].'-------');

                // var_dump(((int)($_GET['post-id']))+1 === (int)$comment['Post_id'].'-------');

                if((int)$_GET['post-id'] === (int)$comment['Post_id'])
                {
                    
                    if($check_comment_exist === false)
                    {
                        echo "<ul>";
                    }

                    echo "<li> <label class='comment-author'>Author: {$comment['Author']}</label> <p class='comment-box'>{$comment['Text']}</p> </li><br>";

                    $check_comment_exist = true;
                }
            }

            if($check_comment_exist === true)
            {
                echo "</ul>";
            }

            if($check_comment_exist === false)
            {
                echo "<p> No comments yet! </p>";
            }
            ?>