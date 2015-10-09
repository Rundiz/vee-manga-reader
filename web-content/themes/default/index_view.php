<?php include(dirname(__FILE__)."/html-head.php"); ?>
<div class="manga_list">
<?php if ( isset($manga) && is_array($manga) ): ?>
	<table class="list">
	<?php foreach ( $manga as $key ) : ?>
		<tr>
			<td><a href="<?php echo _W_ROOT_; ?>read/<?php echo $key; ?>"><?php echo $key; ?></a></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>
	<div class="nomanga">
		<?php echo lang("front_no_manga"); ?>
	</div>
<?php endif; ?>
</div><!--.manga_list-->
<?php include(dirname(__FILE__)."/html-foot.php"); ?>