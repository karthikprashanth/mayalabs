<?php if (!defined('IN_PHPBB')) exit; ?><script type="text/javascript">
// <![CDATA[
	var form_name = 'postform';
	var text_name = <?php if ($this->_tpldata['DEFINE']['.']['SIG_EDIT']) {  ?>'signature'<?php } else { ?>'message'<?php } ?>;
	var load_draft = false;
	var upload = false;

	// Define the bbCode tags
	var bbcode = new Array();
	var bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]','[flash=]', '[/flash]','[size=]','[/size]'<?php $_custom_tags_count = (isset($this->_tpldata['custom_tags'])) ? sizeof($this->_tpldata['custom_tags']) : 0;if ($_custom_tags_count) {for ($_custom_tags_i = 0; $_custom_tags_i < $_custom_tags_count; ++$_custom_tags_i){$_custom_tags_val = &$this->_tpldata['custom_tags'][$_custom_tags_i]; ?>, <?php echo $_custom_tags_val['BBCODE_NAME']; }} ?>);
	var imageTag = false;

	// Helpline messages
	var help_line = {
		b: '<?php echo ((isset($this->_rootref['LA_BBCODE_B_HELP'])) ? $this->_rootref['LA_BBCODE_B_HELP'] : ((isset($this->_rootref['L_BBCODE_B_HELP'])) ? addslashes($this->_rootref['L_BBCODE_B_HELP']) : ((isset($user->lang['BBCODE_B_HELP'])) ? addslashes($user->lang['BBCODE_B_HELP']) : '{ BBCODE_B_HELP }'))); ?>',
		i: '<?php echo ((isset($this->_rootref['LA_BBCODE_I_HELP'])) ? $this->_rootref['LA_BBCODE_I_HELP'] : ((isset($this->_rootref['L_BBCODE_I_HELP'])) ? addslashes($this->_rootref['L_BBCODE_I_HELP']) : ((isset($user->lang['BBCODE_I_HELP'])) ? addslashes($user->lang['BBCODE_I_HELP']) : '{ BBCODE_I_HELP }'))); ?>',
		u: '<?php echo ((isset($this->_rootref['LA_BBCODE_U_HELP'])) ? $this->_rootref['LA_BBCODE_U_HELP'] : ((isset($this->_rootref['L_BBCODE_U_HELP'])) ? addslashes($this->_rootref['L_BBCODE_U_HELP']) : ((isset($user->lang['BBCODE_U_HELP'])) ? addslashes($user->lang['BBCODE_U_HELP']) : '{ BBCODE_U_HELP }'))); ?>',
		q: '<?php echo ((isset($this->_rootref['LA_BBCODE_Q_HELP'])) ? $this->_rootref['LA_BBCODE_Q_HELP'] : ((isset($this->_rootref['L_BBCODE_Q_HELP'])) ? addslashes($this->_rootref['L_BBCODE_Q_HELP']) : ((isset($user->lang['BBCODE_Q_HELP'])) ? addslashes($user->lang['BBCODE_Q_HELP']) : '{ BBCODE_Q_HELP }'))); ?>',
		c: '<?php echo ((isset($this->_rootref['LA_BBCODE_C_HELP'])) ? $this->_rootref['LA_BBCODE_C_HELP'] : ((isset($this->_rootref['L_BBCODE_C_HELP'])) ? addslashes($this->_rootref['L_BBCODE_C_HELP']) : ((isset($user->lang['BBCODE_C_HELP'])) ? addslashes($user->lang['BBCODE_C_HELP']) : '{ BBCODE_C_HELP }'))); ?>',
		l: '<?php echo ((isset($this->_rootref['LA_BBCODE_L_HELP'])) ? $this->_rootref['LA_BBCODE_L_HELP'] : ((isset($this->_rootref['L_BBCODE_L_HELP'])) ? addslashes($this->_rootref['L_BBCODE_L_HELP']) : ((isset($user->lang['BBCODE_L_HELP'])) ? addslashes($user->lang['BBCODE_L_HELP']) : '{ BBCODE_L_HELP }'))); ?>',
		o: '<?php echo ((isset($this->_rootref['LA_BBCODE_O_HELP'])) ? $this->_rootref['LA_BBCODE_O_HELP'] : ((isset($this->_rootref['L_BBCODE_O_HELP'])) ? addslashes($this->_rootref['L_BBCODE_O_HELP']) : ((isset($user->lang['BBCODE_O_HELP'])) ? addslashes($user->lang['BBCODE_O_HELP']) : '{ BBCODE_O_HELP }'))); ?>',
		p: '<?php echo ((isset($this->_rootref['LA_BBCODE_P_HELP'])) ? $this->_rootref['LA_BBCODE_P_HELP'] : ((isset($this->_rootref['L_BBCODE_P_HELP'])) ? addslashes($this->_rootref['L_BBCODE_P_HELP']) : ((isset($user->lang['BBCODE_P_HELP'])) ? addslashes($user->lang['BBCODE_P_HELP']) : '{ BBCODE_P_HELP }'))); ?>',
		w: '<?php echo ((isset($this->_rootref['LA_BBCODE_W_HELP'])) ? $this->_rootref['LA_BBCODE_W_HELP'] : ((isset($this->_rootref['L_BBCODE_W_HELP'])) ? addslashes($this->_rootref['L_BBCODE_W_HELP']) : ((isset($user->lang['BBCODE_W_HELP'])) ? addslashes($user->lang['BBCODE_W_HELP']) : '{ BBCODE_W_HELP }'))); ?>',
		a: '<?php echo ((isset($this->_rootref['LA_BBCODE_A_HELP'])) ? $this->_rootref['LA_BBCODE_A_HELP'] : ((isset($this->_rootref['L_BBCODE_A_HELP'])) ? addslashes($this->_rootref['L_BBCODE_A_HELP']) : ((isset($user->lang['BBCODE_A_HELP'])) ? addslashes($user->lang['BBCODE_A_HELP']) : '{ BBCODE_A_HELP }'))); ?>',
		s: '<?php echo ((isset($this->_rootref['LA_BBCODE_S_HELP'])) ? $this->_rootref['LA_BBCODE_S_HELP'] : ((isset($this->_rootref['L_BBCODE_S_HELP'])) ? addslashes($this->_rootref['L_BBCODE_S_HELP']) : ((isset($user->lang['BBCODE_S_HELP'])) ? addslashes($user->lang['BBCODE_S_HELP']) : '{ BBCODE_S_HELP }'))); ?>',
		f: '<?php echo ((isset($this->_rootref['LA_BBCODE_F_HELP'])) ? $this->_rootref['LA_BBCODE_F_HELP'] : ((isset($this->_rootref['L_BBCODE_F_HELP'])) ? addslashes($this->_rootref['L_BBCODE_F_HELP']) : ((isset($user->lang['BBCODE_F_HELP'])) ? addslashes($user->lang['BBCODE_F_HELP']) : '{ BBCODE_F_HELP }'))); ?>',
		e: '<?php echo ((isset($this->_rootref['LA_BBCODE_E_HELP'])) ? $this->_rootref['LA_BBCODE_E_HELP'] : ((isset($this->_rootref['L_BBCODE_E_HELP'])) ? addslashes($this->_rootref['L_BBCODE_E_HELP']) : ((isset($user->lang['BBCODE_E_HELP'])) ? addslashes($user->lang['BBCODE_E_HELP']) : '{ BBCODE_E_HELP }'))); ?>',
		d: '<?php echo ((isset($this->_rootref['LA_BBCODE_D_HELP'])) ? $this->_rootref['LA_BBCODE_D_HELP'] : ((isset($this->_rootref['L_BBCODE_D_HELP'])) ? addslashes($this->_rootref['L_BBCODE_D_HELP']) : ((isset($user->lang['BBCODE_D_HELP'])) ? addslashes($user->lang['BBCODE_D_HELP']) : '{ BBCODE_D_HELP }'))); ?>'
		<?php $_custom_tags_count = (isset($this->_tpldata['custom_tags'])) ? sizeof($this->_tpldata['custom_tags']) : 0;if ($_custom_tags_count) {for ($_custom_tags_i = 0; $_custom_tags_i < $_custom_tags_count; ++$_custom_tags_i){$_custom_tags_val = &$this->_tpldata['custom_tags'][$_custom_tags_i]; ?>

			,cb_<?php echo $_custom_tags_val['BBCODE_ID']; ?>: '<?php echo $_custom_tags_val['A_BBCODE_HELPLINE']; ?>'
		<?php }} ?>

	}

	var panels = new Array('options-panel', 'attach-panel', 'poll-panel');
	var show_panel = 'options-panel';


// ]]>
</script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/editor.js"></script>

<?php if ($this->_rootref['S_BBCODE_ALLOWED']) {  ?>

<div id="colour_palette" style="display: none;">
	<dl style="clear: left;">
		<dt><label><?php echo ((isset($this->_rootref['L_FONT_COLOR'])) ? $this->_rootref['L_FONT_COLOR'] : ((isset($user->lang['FONT_COLOR'])) ? $user->lang['FONT_COLOR'] : '{ FONT_COLOR }')); ?>:</label></dt>
		<dd>
		<script type="text/javascript">
		// <![CDATA[
			function change_palette()
			{
				dE('colour_palette');
				e = document.getElementById('colour_palette');
				
				if (e.style.display == 'block')
				{
					document.getElementById('bbpalette').value = '<?php echo ((isset($this->_rootref['LA_FONT_COLOR_HIDE'])) ? $this->_rootref['LA_FONT_COLOR_HIDE'] : ((isset($this->_rootref['L_FONT_COLOR_HIDE'])) ? addslashes($this->_rootref['L_FONT_COLOR_HIDE']) : ((isset($user->lang['FONT_COLOR_HIDE'])) ? addslashes($user->lang['FONT_COLOR_HIDE']) : '{ FONT_COLOR_HIDE }'))); ?>';
				}
				else
				{
					document.getElementById('bbpalette').value = '<?php echo ((isset($this->_rootref['LA_FONT_COLOR'])) ? $this->_rootref['LA_FONT_COLOR'] : ((isset($this->_rootref['L_FONT_COLOR'])) ? addslashes($this->_rootref['L_FONT_COLOR']) : ((isset($user->lang['FONT_COLOR'])) ? addslashes($user->lang['FONT_COLOR']) : '{ FONT_COLOR }'))); ?>';
				}
			}

			colorPalette('h', 15, 10);
		// ]]>
		</script>
		</dd>
	</dl>
</div>

<div id="format-buttons">
	<input type="button" class="button2" accesskey="b" name="addbbcode0" value=" B " style="font-weight:bold; width: 30px" onclick="bbstyle(0)" title="<?php echo ((isset($this->_rootref['L_BBCODE_B_HELP'])) ? $this->_rootref['L_BBCODE_B_HELP'] : ((isset($user->lang['BBCODE_B_HELP'])) ? $user->lang['BBCODE_B_HELP'] : '{ BBCODE_B_HELP }')); ?>" />
	<input type="button" class="button2" accesskey="i" name="addbbcode2" value=" i " style="font-style:italic; width: 30px" onclick="bbstyle(2)" title="<?php echo ((isset($this->_rootref['L_BBCODE_I_HELP'])) ? $this->_rootref['L_BBCODE_I_HELP'] : ((isset($user->lang['BBCODE_I_HELP'])) ? $user->lang['BBCODE_I_HELP'] : '{ BBCODE_I_HELP }')); ?>" />
	<input type="button" class="button2" accesskey="u" name="addbbcode4" value=" u " style="text-decoration: underline; width: 30px" onclick="bbstyle(4)" title="<?php echo ((isset($this->_rootref['L_BBCODE_U_HELP'])) ? $this->_rootref['L_BBCODE_U_HELP'] : ((isset($user->lang['BBCODE_U_HELP'])) ? $user->lang['BBCODE_U_HELP'] : '{ BBCODE_U_HELP }')); ?>" />
	<?php $_custom_tags_count = (isset($this->_tpldata['custom_tags'])) ? sizeof($this->_tpldata['custom_tags']) : 0;if ($_custom_tags_count) {for ($_custom_tags_i = 0; $_custom_tags_i < $_custom_tags_count; ++$_custom_tags_i){$_custom_tags_val = &$this->_tpldata['custom_tags'][$_custom_tags_i]; ?>

		<input type="button" class="button2" name="addbbcode<?php echo $_custom_tags_val['BBCODE_ID']; ?>" value="<?php echo $_custom_tags_val['BBCODE_TAG']; ?>" onclick="bbstyle(<?php echo $_custom_tags_val['BBCODE_ID']; ?>)" title="<?php echo $_custom_tags_val['BBCODE_HELPLINE']; ?>" />
	<?php }} ?>

</div>
<?php } ?>