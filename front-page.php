<?php get_header(); ?>

<?php
$do_not_duplicate = array();
$values_carousel = array(
    'post_type' => 'Carousel',
    //'orderby'=>'date',
    //'order'=>'DESC',    
    'meta_key' => 'meta-box-carousel-orden',
    'orderby' => 'meta_value',
    'order' => 'ASC'
);
$query_carousel = new WP_Query($values_carousel);
?>

<div id="homeCarousel" class="carousel slide block-ancla" data-bs-ride="carousel">

    <div class="carousel-indicators">
        <?php if (have_posts()):
            while ($query_carousel->have_posts()):
                $query_carousel->the_post(); ?>


                <button type="button" data-bs-target="#homeCarousel"
                    data-bs-slide-to="<?php echo $query_carousel->current_post; ?>"
                    class="<?php if ($query_carousel->current_post == 0): ?>active <?php endif; ?>"></button>
            <?php endwhile; endif; ?>

    </div>
    <?/*php dynamic_sidebar('evento_home'); */?>
    <div class="carousel-inner">
        <?php if (have_posts()):
            while ($query_carousel->have_posts()):
                $query_carousel->the_post(); ?>
                <?php
                $thumbnail_id_carousel = get_post_thumbnail_id();
                $thumbnail_url_carousel = wp_get_attachment_image_src($thumbnail_id_carousel, 'foto-carousel', true);
                $thumbnail_meta_carousel = get_post_meta($thumbnail_id_carousel, '_wp_attachment_image_alt', true);
                ?>
                <?php $color_fondo = get_post_meta(get_the_ID(), 'meta_box_carousel_fondo', true); ?>
                <div class="carousel-item <?php if ($query_carousel->current_post == 0): ?>active <?php endif; ?> <?php if ($color_fondo == "blanco"): ?>fondo-blanco<?php endif; ?>"
                    style="background-image: url(<?php echo $thumbnail_url_carousel[0]; ?>); background-size:cover;background-position: center center">

                    <div class="carousel-caption">


                        <div class="cont-carousel">
                            <?php
                            $currentlang = get_bloginfo('language');
                            if ($currentlang == "eu"):
                                ?>
                                <?php $carousel_subtitu = get_post_meta($post->ID, 'meta-box-carousel-subtitu', true);
                                if (!empty($carousel_subtitu)): ?>
                                    <p class="carousel-subtitu mb-2">
                                        <?php echo get_post_meta(get_the_ID(), 'meta-box-carousel-subtitu', true); ?></p>
                                <?php endif; ?>
                                <h1 class="mb-0"><?php the_title(); ?></h1>
                            <?php else: ?>
                                <h1><?php the_title(); ?></h1>
                                <?php $carousel_subtitu = get_post_meta($post->ID, 'meta-box-carousel-subtitu', true);
                                if (!empty($carousel_subtitu)): ?>
                                    <p class="carousel-subtitu">
                                        <?php echo get_post_meta(get_the_ID(), 'meta-box-carousel-subtitu', true); ?></p>
                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="mt-2 mb-0 mb-sm-4"><?php the_content(); ?></div>
                            <p class="mb-0">
                                <?php
                                $url_enlace_carousel01 = get_post_meta($post->ID, 'meta-box-carousel-url-bt-01', true);
                                $url_enlace_carousel02 = get_post_meta($post->ID, 'meta-box-carousel-url-bt-02', true);
                                if (!empty($url_enlace_carousel01)): ?>
                                    <a class="btn btn-lg mb-2 mb-sm-0 btn-primary smoothScroll"
                                        href="<?php echo get_post_meta(get_the_ID(), 'meta-box-carousel-url-bt-01', true); ?>"><i class="bi bi-arrow-right me-2"></i><?php echo get_post_meta(get_the_ID(), 'meta-box-carousel-texto-bt-01', true); ?></a>
                                <?php endif;
                                if (!empty($url_enlace_carousel02)): ?>
                                    <a class="btn btn-lg mb-0 mb-sm-0 btn-white-outline text-white smoothScroll"
                                        href="<?php echo get_post_meta(get_the_ID(), 'meta-box-carousel-url-bt-02', true); ?>"><?php echo get_post_meta(get_the_ID(), 'meta-box-carousel-texto-bt-02', true); ?></a>
                                <?php endif; ?>
                            </p>
                        </div>

                        <?php
                        $urlcarousel02 = get_post_meta($post->ID, 'meta-box-url', true);
                        if (!empty($urlcarousel02)): ?>
                            <p><a href="<?php echo get_post_meta(get_the_ID(), 'meta-box-url', true); ?>" title="+ Info"
                                    class="btn btn-lg btn-danger mt-0 mb-0 center-block"><?php echo get_post_meta(get_the_ID(), 'meta-box-texto-bt', true); ?></a>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="overlay-carousel"></div>
                </div>
                <?php $do_not_duplicate[] = $post->ID; ?>
            <?php endwhile; endif;
            wp_reset_postdata(); ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- fin carousel -->
<?php the_content(); ?>


<div class="container">

    <div class="row listado-posts mt-5">
        <?php
        $args = array(
            'posts_per_page' => '3',
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $three_blog_posts = new WP_Query($args);

        if ($three_blog_posts->have_posts()):
            while ($three_blog_posts->have_posts()):
                $three_blog_posts->the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-lg-4'); ?>>
                    <div class="card texto-sobre-foto">
                        <a href="<?php the_permalink() ?>" title="Leer más">
                            <div class="overlay-min-blog"></div>
                            <?php if (has_post_thumbnail($post->ID)): ?>
                                <?php the_post_thumbnail('min-blog', array('class' => 'card-img-top img-fluid')); ?>                            
                            <?php endif; ?>
                        </a>
                        <div class="card-body">

                            <p class="datos-noticia">
                                <!--<i class="fa fa-user"></i> <?php the_author(); ?> | -->
                                <?php the_time('j, F Y'); ?>
                            </p>
                            <div class="text-min">
                                <h2><a href="<?php the_permalink(); ?>" class="stretched-link"><?php the_title(); ?></a></h2>
                                <p>
                                    <?php the_excerpt(); ?>
                                </p>
                            </div>


                        </div>
                    </div> <!-- /.col -->
                </article><!-- /#post-<?php the_ID(); ?> -->
                <?php
            endwhile; endif;
        wp_reset_postdata();
        ?>

    </div>
    

</div>


<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>




<?php get_footer(); ?>