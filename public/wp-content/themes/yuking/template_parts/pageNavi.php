<div class="p-pageNavi">
	<?php
	$prevpost = get_adjacent_post(false, '', true);
	if ($prevpost) :?>
	<a class="p-pageNavi__link p-pageNavi__link-left" href="<?php echo get_permalink($prevpost->ID); ?>">
		<figure class="p-pageNavi__thum">
			<?php if( get_the_post_thumbnail($prevpost) ) : ?>
				<?php echo get_the_post_thumbnail($prevpost->ID, 'side_column_thumbnail'); ?>
			<?php else: ?>
				<img src="<?php echo get_template_directory_uri(); ?>/img/common/noimg.jpg">
			<?php endif; ?>
		</figure>
		<span class="p-pageNavi__ttl">
			<?php
			if(mb_strlen($prevpost->post_title, 'UTF-8')>30){
				$title= mb_substr($prevpost->post_title, 0, 30, 'UTF-8');
				echo $title.'…';
			}else{
				echo $prevpost->post_title;
			}?>
		</span>
	</a>
<?php else : ?>
	<div class="p-pageNavi__link pc">&nbsp;</div>
<?php endif; ?>

<?php
$nextpost = get_adjacent_post(false, '', false);
if ($nextpost) : ?>
<a class="p-pageNavi__link p-pageNavi__link-right" href="<?php echo get_permalink($nextpost->ID); ?>">
	<span class="p-pageNavi__ttl">
		<?php
		if(mb_strlen($nextpost->post_title, 'UTF-8')>30){
			$title= mb_substr($nextpost->post_title, 0, 30, 'UTF-8');
			echo $title.'…';
		}else{
			echo $nextpost->post_title;
		}?>
	</span>
	<figure class="p-pageNavi__thum">
		<?php if( get_the_post_thumbnail($nextpost->ID) ) : ?>
			<?php echo get_the_post_thumbnail($nextpost->ID, 'side_column_thumbnail'); ?>
		<?php else: ?>
			<img src="<?php echo get_template_directory_uri(); ?>/img/common/noimg.jpg">
		<?php endif; ?>
	</figure>
</a>
<?php else : ?>
	<div class="p-pageNavi__link pc">&nbsp;</div>
<?php endif; ?>
</div>