<span class="share-post">

    <!--<h4><?php _e('Compartir', 'theme_name');?></h4>-->
aa
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="facebook" target="_blank">
    <i class="fab fa-facebook-f"></i> <!--Facebook-->
    </a>

    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title_attribute(); ?>" class="twitter" target="_blank">
    <i class="fab fa-twitter"></i> <!--Twitter-->
    </a>

    <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="googleplus" target="_blank">
    <i class="fab fa-google-plus-g"></i> <!--Google+-->
    </a>


   <?php //Obtenemos la URL de la imagen destacada
 $pin_imagen = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); ?>
    
    <?/*php echo direct_email('enviar por mail') */?>
    

    <a href="whatsapp://send?text=<?php the_permalink(); ?>" data-action="share/whatsapp/share" class="whatsapp">
    <i class="fab fa-whatsapp"></i> <!--Whatsapp--></a>

    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" class="linkedin" target="_blank">
    <i class="fab fa-linkedin-in"></i>
    </a>
    

</span> <!-- /. share-post -->