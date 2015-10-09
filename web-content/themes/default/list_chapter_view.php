<?php include(dirname(__FILE__)."/html-head.php"); ?>
<div class="manga_list">
	<table class="list">
		<tr>
			<td>
				<h1><a href="<?php echo _W_ROOT_; ?>read/<?php echo $manga; ?>"><?php echo $manga; ?></a></h1>
				<?php if ( isset($preview_image) ): ?>
				<img src="<?php echo _W_ROOT_.$this->config->item("manga_dir").$manga."/".$preview_image; ?>" alt="" class="preview_image" />
				<?php endif; ?>
			</td>
		</tr>
<?php if ( isset($chapters) && is_array($chapters) ): ?>
	<?php foreach ( $chapters as $key ) : ?>
		<tr>
			<td><a href="<?php echo _W_ROOT_; ?>read/<?php echo $manga."/".$key; ?>"><?php echo $key; ?></a></td>
		</tr>
	<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td class="nomanga"><?php echo lang("front_no_manga"); ?></td>
		</tr>
<?php endif; ?>
	</table>
</div><!--.manga_list-->
<?php include(dirname(__FILE__)."/html-foot.php"); ?>