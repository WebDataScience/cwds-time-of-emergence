<article class="article-post">
  <div class="title-post">
    <h5><?php print $title; ?></h5>
    <a href="#"><span class="comment">18</span></a>
  </div>
  <?php print render($content['field_image']); ?>
  <?php if ($display_submitted): ?>
    <div class="blog-meta">
      <span class="author left"><?php print t('Posted by'); ?> : <?php print $blog_author; ?></span>	
      <?php if (!empty($content['field_tags'])): ?>
        <span class="meta-tag right"><?php print t('tags'); ?> : <?php print grider_format_comma_field('field_tags', $node); ?></span>	
      <?php endif; ?>
    </div>							
    <div class="date-post">
      <div class="date"><?php print format_date($node->created, 'custom', 'd'); ?></div>
      <div class="month"><?php print format_date($node->created, 'custom', 'M'); ?></div>
    </div>
  <?php endif; ?>

  <?php
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);
  hide($content['field_tags']);
  print render($content);
  ?>

</article>

<div class="clear"></div>

<div class="comment-wrapper about-author">
   <?php print $user_picture; ?>
  <?php
  $user = user_load($node->uid);
  $user_view = user_view($user);
  ?>
  <div class="comment-post">
    <div class="comment-info">
      <a href="<?php print url('user/' . $node->uid); ?>"><?php print t('About author'); ?>: <?php print $user->name; ?></a>
    </div>							
    <?php print render($user_view['field_about']); ?>
    <span class="right"><a href="<?php print url('blog/' . $user->uid); ?>" class="textlink"><?php print t('View all posts by'); ?> <?php print $user->name; ?></a></span>
    <div class="clear"></div>
  </div>						
</div>

<!-- divider -->
<div class="clear"></div>
<div class="divider spacer10"></div>
<!-- End divider -->
<?php 
print render($content['links']);
print render($content['comments']);
?>