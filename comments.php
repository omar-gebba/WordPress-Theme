<?php
if (comments_open())
{
    if (comments_open() && get_comments_number() != 0)
    {
        $comments_args = array(
            'max_depth'     => '4',
            'style'         => 'ul',
        );
        echo "<div class='container comments-cont'>";
            comments_number();
            echo "<ul class='my-comments'>";
            
                wp_list_comments($comments_args);
            echo "</ul>";
            echo "<hr>";
    }
    elseif (get_comments_number() == 0)
    {
        echo 'No Comments';
    }
        $form_arrgs = array(
            'fields' => array(
                'author'    => '<div class="form-group">
                                    <label class="controle-lable col-md-2 col-sm-6">Your Name</label>
                                    <input type="text" id="author" name="author" class="form-controle col-sm-6" />
                                </div>',

                'email'      => '<div class="form-group">
                                    <label class="controle-lable col-md-2 col-sm-6"">Your Email</label>
                                    <input type="email" id="email" name="email" class="form-controle col-sm-6" />
                                </div>',

                'url'       => '<div class="form-group">
                                    <label class="controle-lable col-md-2 col-sm-6"">Your Website</label>
                                    <input type="url" id="url" name="url" class="form-controle col-sm-6" />
                                </div>'
                ),
            'comment_field' => '<div class="form-group">
                                    <label class="controle-lable col-md-2 col-sm-6"">Your Comment</label>
                                    <textarea id="comment" class="form-controle col-sm-6" name="comment"></textarea>
                                </div>',
            'title_reply'   => 'Type Your Comment',
            'label_submit'  => 'Comment',
            'class_submit'  => 'btn btn-primary',
            'title_reply_to'=> 'Replay To %s',
            'logged_in_as'  =>  '<p class="logged-in-as">' . sprintf( __('Comment as <a href="%1$s">%2$s</a>
                                Or <a href="%3$s" title="Log out of this account">Log out?</a>' ),
                                admin_url( 'profile.php' ), $user_identity,
                                wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            // '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>
            //. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
            // admin_url( 'profile.php' ), $user_identity,
            // wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>'
            );


        echo "<div class='com-form'>";
                comment_form($form_arrgs);
              //  echo the_avatar();  // <= uses custom function here
        echo "</div>";
    echo "</div>";
        
}
elseif (get_comments_number() == 0)
{
    //echo 'No Comments';
}
else
{
    echo 'Comments Disabled';
}
