<?php include(dirname(__FILE__)."/html-head.php"); ?>
<script type="text/javascript">
<!-- Script courtesy of http://www.web-source.net - Your Guide to Professional Web Site Design and Development
function regoto(form) {
	var index=form.select.selectedIndex
	if (form.select.options[index].value != "0") {
		location=form.select.options[index].value;
	}
}
//-->
</script>
<div class="manga_list">
	<table class="list">
		<tr>
			<td>
				<h1><a href="<?php echo _W_ROOT_; ?>read/<?php echo $manga; ?>"><?php echo $manga; ?></a> : <?php echo $chapter; ?></h1>
			</td>
		</tr>
		<tr>
			<td class="page_control_up">
				<form name="form1" action="">
					<input type="button" value="<?php echo lang("front_prev_page"); ?>" onclick="window.location='<?php echo @$previous_page; ?>';" /> &nbsp;
					<select name="select" onchange="regoto(this.form)">
						<option value="<?php echo _W_ROOT_.$this->uri->segment(1)."/".$manga."/".$chapter; ?>"> </option>
<?php if ( isset($pages) && is_array($pages) ): ?>
	<?php foreach ( $pages as $key => $item ) : ?>
						<option value="<?php echo _W_ROOT_.$this->uri->segment(1)."/".$manga."/".$chapter."/".($key+1); ?>"<?php if ( current_url() == base_url().$this->uri->segment(1)."/".$manga."/".$chapter."/".($key+1) ) {echo " selected=\"selected\"";} ?>><?php echo $item; ?></option>
	<?php endforeach; ?>
<?php endif; ?>
					</select> &nbsp;
					<input type="button" value="<?php echo lang("front_next_page"); ?>" onclick="window.location='<?php echo @$next_page; ?>';" />
				&nbsp; <?php echo $current_page; ?> of <?php echo $total_page; ?>
				</form>
			</td>
		</tr>
		<tr>
			<td class="manga_image">
				<a href="<?php echo @$next_page; ?>">
					<img src="<?php echo _W_ROOT_.$this->config->item("manga_dir").$manga."/".$chapter."/".$file_name; ?>" alt="" />
				</a>
			</td>
		</tr>
		<tr>
			<td class="page_control_dn">
				<input type="button" value="<?php echo lang("front_prev_page"); ?>" onclick="window.location='<?php echo @$previous_page; ?>';" /> &nbsp;
				<input type="button" value="<?php echo lang("front_next_page"); ?>" onclick="window.location='<?php echo @$next_page; ?>';" />
			</td>
		</tr>
	</table>
</div><!--.manga_list-->
<?php include(dirname(__FILE__)."/html-foot.php"); ?>