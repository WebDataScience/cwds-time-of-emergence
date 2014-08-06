<h5><?php print $title; ?></h5>
<?php print render($content['field_image']); ?>
<?php
// We hide the comments and links now so that we can render them later.
hide($content['comments']);
hide($content['links']);
hide($content['field_tags']);
hide($content['field_portfolio_category']);
hide($content['field_file']);
print render($content);
?>				

<?php if (!empty($content['field_file'])): ?>
  <?php
  $file_uri = $node->field_file[LANGUAGE_NONE][0]['uri'];
  $file = file_create_url($file_uri);
  ?>
  <a class="smallbtn2 left" href="<?php print $file; ?>"><span><?php print t('Download item'); ?></span></a>	
<?php endif; ?>

<!-- divider -->
<div class="clear"></div>
<div class="divider spacer10"></div>
<!-- End divider -->	

<?php
print render($content['links']);
print render($content['comments']);
?>

