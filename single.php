<?php get_header(); ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <?php if( have_posts () ) : while (have_posts () ) : the_post(); ?>
      <div class="mw-57 mx-auto">          
          <div class="clearfix"></div>
          
          <div class="page-header">
            <h2> <?php the_title(); ?> </h2>
            <p class="datos-noticia">
              <!--<i class="fa fa-user"></i> <?php the_author(); ?> | -->
              <i class="far fa-calendar-alt"></i> <?php the_time('j, F Y'); ?> | <a href="<?php the_permalink() ?>#comments" title="Ver comentarios" class="mr-15">
              
            </p>                    
          </div>        
          <?php
           //the_post_thumbnail('single-principal', array('class'=>'img-fluid mb-3 float-right'));
            ?>
          <?php the_content(); ?>        
          
        <div class="clearfix"></div>
        <div>
          <p class="mt-30 mb-0"><?php echo 'Comparte este artículo:' ?></p>         
          <?php get_template_part('content', 'share');?>
        </div>
        
        </div>
        <?php endwhile; else : ?>                 
      <?php endif; ?>
      </div>
	  <?php get_sidebar(); ?>

       
      
  </div>
</div>
    
<?php get_footer(); ?>