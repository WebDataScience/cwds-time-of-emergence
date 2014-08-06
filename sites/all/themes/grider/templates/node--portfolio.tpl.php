<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php
  $blog_author = theme('username', array('account' => $node));
  if (!$page) {
    include 'blog/blog_teaser.tpl.php';
  } else {
    include 'portfolio/portfolio_full.tpl.php';
  }
  ?>

</div>
