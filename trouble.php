<?php

/**
* Template Name: Troubleshoot
*/

get_header(); ?>
<script src="dev_troubleshoot/trouble.js" type="text/javascript"></script>
<div class="container <?php if (get_field('pageSize') == '600') echo "w-600"; ?>">
<?php 
$bgImg = get_post_meta($post->ID, '_tdCore-galleryCount', true);
$showContent = get_post_meta($post->ID, '_tdCore-showContent', true);
if($showContent != 'no') {
?>

<div class="content<?php if ($bgImg) { echo " haveBgIMG"; } ?>">
<div class="breadcrumbs">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
  <h1 class="entry-title">
    <?php the_title(); ?>
  </h1>
  <div class="main-content">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     
      <div class="entry-content">
        <div class="entry-content-text">
          <?php the_content(); 
		  
wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tdCore' ), 'after' => '</div>' ) ); 
edit_post_link( __( '(Edit)', 'tdCore' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
                <div id="mainEnvelopeArea" style="margin-right: 90px;">

<?php
get_troubleshoot()
?>

        <div class="clearAll"></div>
      </div>
    </div>
  </div>
</div>
<div class="contentShadowBottom"></div>
<?php } ?>
</div>
<?php get_footer(); ?>