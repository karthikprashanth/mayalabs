<?php if (!defined('IN_PHPBB')) exit; if (sizeof($this->_tpldata['draftrow'])) {  ?>

	<div class="panel">
		<div class="inner"><span class="corners-top"><span></span></span>

		<h3><?php echo ((isset($this->_rootref['L_LOAD_DRAFT'])) ? $this->_rootref['L_LOAD_DRAFT'] : ((isset($user->lang['LOAD_DRAFT'])) ? $user->lang['LOAD_DRAFT'] : '{ LOAD_DRAFT }')); ?></h3>
		<p><?php echo ((isset($this->_rootref['L_LOAD_DRAFT_EXPLAIN'])) ? $this->_rootref['L_LOAD_DRAFT_EXPLAIN'] : ((isset($user->lang['LOAD_DRAFT_EXPLAIN'])) ? $user->lang['LOAD_DRAFT_EXPLAIN'] : '{ LOAD_DRAFT_EXPLAIN }')); ?></p>

		<span class="corners-bottom"><span></span></span></div>
	</div>

	<div class="forums-wrapper">
		<table class="forums <?php if (! $this->_rootref['S_PRIVMSGS']) {  ?> topics<?php } else { ?> cplist<?php } ?>">
			<thead>
				<tr>
					<th><?php echo ((isset($this->_rootref['L_LOAD_DRAFT'])) ? $this->_rootref['L_LOAD_DRAFT'] : ((isset($user->lang['LOAD_DRAFT'])) ? $user->lang['LOAD_DRAFT'] : '{ LOAD_DRAFT }')); ?></th>
					<th class="last-post"><?php echo ((isset($this->_rootref['L_SAVE_DATE'])) ? $this->_rootref['L_SAVE_DATE'] : ((isset($user->lang['SAVE_DATE'])) ? $user->lang['SAVE_DATE'] : '{ SAVE_DATE }')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $_draftrow_count = (isset($this->_tpldata['draftrow'])) ? sizeof($this->_tpldata['draftrow']) : 0;if ($_draftrow_count) {for ($_draftrow_i = 0; $_draftrow_i < $_draftrow_count; ++$_draftrow_i){$_draftrow_val = &$this->_tpldata['draftrow'][$_draftrow_i]; ?>

					<tr class="<?php if (!($_draftrow_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } ?>">
						<td class="topic">
							<h4><a href="<?php echo $_draftrow_val['U_INSERT']; ?>" title="<?php echo ((isset($this->_rootref['L_LOAD_DRAFT'])) ? $this->_rootref['L_LOAD_DRAFT'] : ((isset($user->lang['LOAD_DRAFT'])) ? $user->lang['LOAD_DRAFT'] : '{ LOAD_DRAFT }')); ?>" class="topictitle"><?php echo $_draftrow_val['DRAFT_SUBJECT']; ?></a></h4>
							<?php if (! $this->_rootref['S_PRIVMSGS']) {  if ($_draftrow_val['S_LINK_TOPIC']) {  ?>

									<p><?php echo ((isset($this->_rootref['L_TOPIC'])) ? $this->_rootref['L_TOPIC'] : ((isset($user->lang['TOPIC'])) ? $user->lang['TOPIC'] : '{ TOPIC }')); ?>: <a href="<?php echo $_draftrow_val['U_VIEW']; ?>"><?php echo $_draftrow_val['TITLE']; ?></a><p>
								<?php } else if ($_draftrow_val['S_LINK_FORUM']) {  ?>

									<p><?php echo ((isset($this->_rootref['L_FORUM'])) ? $this->_rootref['L_FORUM'] : ((isset($user->lang['FORUM'])) ? $user->lang['FORUM'] : '{ FORUM }')); ?>: <a href="<?php echo $_draftrow_val['U_VIEW']; ?>"><?php echo $_draftrow_val['TITLE']; ?></a></p>
								<?php } else { ?>

									<p><?php echo ((isset($this->_rootref['L_NO_TOPIC_FORUM'])) ? $this->_rootref['L_NO_TOPIC_FORUM'] : ((isset($user->lang['NO_TOPIC_FORUM'])) ? $user->lang['NO_TOPIC_FORUM'] : '{ NO_TOPIC_FORUM }')); ?></p>
								<?php } } ?>

						</td>
						<td class="bg2"><p><?php echo $_draftrow_val['DATE']; ?></p></td>
					</tr>
				<?php }} ?>

			</tbody>
		</table>
	</div>
<?php } ?>