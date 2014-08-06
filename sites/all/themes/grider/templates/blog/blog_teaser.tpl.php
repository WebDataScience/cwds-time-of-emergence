<article class="article-post">
  <div class="title-post">
    <h5><?php print $title; ?></h5>
    <a href="<?php print $node_url; ?>#comments"><span class="comment"><?php print $node->comment_count; ?></span></a>
  </div>
  <?php
  if (!empty($content['field_image'])) {
    print render($content['field_image']);
  }
  ?>
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
  <a href="<?php print $node_url; ?>" class="smallbtn2"><span><?php print t('Read more'); ?></span></a>	
</article>

<!-- divider -->
<div class="clear"></div>
<div class="divider"></div>
<!-- End divider -->