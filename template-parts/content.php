<article id="post-<?php the_ID(); ?>" <?php post_class('blog_post'); ?>>
    <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h4>

    <div class="blog_category">
        <ul>
            <li> <?php the_category(', '); ?> </li>
        </ul>
    </div>

    <div class="blog_text">
        <ul>
            <li> | </li>
            <li>Posted by: <?php the_author_posts_link(); ?></li>
            <li> | </li>
            <li>  On : <?php the_time('j F Y'); ?> </li>
        </ul>
    </div>

    <div class="blog_post_img">
        <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
    </div>

    <?php the_excerpt(); ?>

    <a href="<?php the_permalink(); ?>"> Continue reading <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>

</article>