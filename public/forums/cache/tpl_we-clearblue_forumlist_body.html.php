<?php if (!defined('IN_PHPBB')) exit; $_forumrow_count = (isset($this->_tpldata['forumrow'])) ? sizeof($this->_tpldata['forumrow']) : 0;if ($_forumrow_count) {for ($_forumrow_i = 0; $_forumrow_i < $_forumrow_count; ++$_forumrow_i){$_forumrow_val = &$this->_tpldata['forumrow'][$_forumrow_i]; if (( $_forumrow_val['S_IS_CAT'] && ! $_forumrow_val['S_FIRST_ROW'] ) || $_forumrow_val['S_NO_CAT']) {  ?>
				</tbody>
			</table>
		</div>
	<?php } if ($_forumrow_val['S_IS_CAT'] || $_forumrow_val['S_FIRST_ROW'] || $_forumrow_val['S_NO_CAT']) {  ?>
		<div class="forums-wrapper">
			<table class="forums">
				<thead>
					<tr>
						<th colspan="2"><?php if ($_forumrow_val['S_IS_CAT']) {  ?><a href="<?php echo $_forumrow_val['U_VIEWFORUM']; ?>"><?php echo $_forumrow_val['FORUM_NAME']; ?></a><?php } else { echo ((isset($this->_rootref['L_FORUM'])) ? $this->_rootref['L_FORUM'] : ((isset($user->lang['FORUM'])) ? $user->lang['FORUM'] : '{ FORUM }')); } ?></th>
						<th class="statistics"><?php echo ((isset($this->_rootref['L_STATISTICS'])) ? $this->_rootref['L_STATISTICS'] : ((isset($user->lang['STATISTICS'])) ? $user->lang['STATISTICS'] : '{ STATISTICS }')); ?></th>
						<th class="last-post"><?php echo ((isset($this->_rootref['L_LAST_POST'])) ? $this->_rootref['L_LAST_POST'] : ((isset($user->lang['LAST_POST'])) ? $user->lang['LAST_POST'] : '{ LAST_POST }')); ?></th>
					</tr>
				</thead>
				<tbody>
	<?php } if (! $_forumrow_val['S_IS_CAT']) {  ?>
		<tr class="<?php if (($_forumrow_val['S_ROW_COUNT'] & 1)  ) {  ?>bg1<?php } else { ?>bg2<?php } ?>">
			<td class="icon bg2" style="background-image: url(<?php echo $_forumrow_val['FORUM_FOLDER_IMG_SRC']; ?>);">
			    <?php if ($_forumrow_val['FORUM_IMAGE']) {  echo $_forumrow_val['FORUM_IMAGE']; } ?>
			</td>
			<td class="forum">
				<?php if ($this->_rootref['S_ENABLE_FEEDS'] && $_forumrow_val['S_FEED_ENABLED']) {  ?><!--<a class="feed-icon-forum" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo $_forumrow_val['FORUM_NAME']; ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?f=<?php echo $_forumrow_val['FORUM_ID']; ?>"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/feed.gif" alt="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo $_forumrow_val['FORUM_NAME']; ?>" /></a>--><?php } ?>
				<h4><a href="<?php echo $_forumrow_val['U_VIEWFORUM']; ?>" class="forumtitle"><?php echo $_forumrow_val['FORUM_NAME']; ?></a> <?php if ($_forumrow_val['U_UNAPPROVED_TOPICS']) {  ?><a href="<?php echo $_forumrow_val['U_UNAPPROVED_TOPICS']; ?>"><?php echo (isset($this->_rootref['UNAPPROVED_IMG'])) ? $this->_rootref['UNAPPROVED_IMG'] : ''; ?></a><?php } ?></h4>
				<p><?php echo $_forumrow_val['FORUM_DESC']; ?></p>
				<?php if ($_forumrow_val['SUBFORUMS'] && $_forumrow_val['S_LIST_SUBFORUMS']) {  ?><p><strong><?php echo $_forumrow_val['L_SUBFORUM_STR']; ?></strong> <?php echo $_forumrow_val['SUBFORUMS']; ?></p><?php } if ($_forumrow_val['MODERATORS']) {  ?><p><strong><?php echo $_forumrow_val['L_MODERATOR_STR']; ?>:</strong> <?php echo $_forumrow_val['MODERATORS']; ?></p><?php } ?>
			</td>
			<?php if ($_forumrow_val['S_IS_LINK'] && ! $_forumrow_val['CLICKS']) {  ?><td colspan="2">&nbsp;</td><?php } if ($_forumrow_val['CLICKS']) {  ?>
				<td colspan="2"><p><?php echo ((isset($this->_rootref['L_REDIRECTS'])) ? $this->_rootref['L_REDIRECTS'] : ((isset($user->lang['REDIRECTS'])) ? $user->lang['REDIRECTS'] : '{ REDIRECTS }')); ?>: <strong><?php echo $_forumrow_val['CLICKS']; ?></strong></p></td>
			<?php } else if (! $_forumrow_val['S_IS_LINK']) {  ?>
				<td class="bg2">
					<p><?php echo ((isset($this->_rootref['L_TOPICS'])) ? $this->_rootref['L_TOPICS'] : ((isset($user->lang['TOPICS'])) ? $user->lang['TOPICS'] : '{ TOPICS }')); ?>: <strong><?php echo $_forumrow_val['TOPICS']; ?></strong></p>
					<p><?php echo ((isset($this->_rootref['L_POSTS'])) ? $this->_rootref['L_POSTS'] : ((isset($user->lang['POSTS'])) ? $user->lang['POSTS'] : '{ POSTS }')); ?>: <strong><?php echo $_forumrow_val['POSTS']; ?></strong></p>
				</td>
				<td>
					<?php if ($_forumrow_val['LAST_POST_TIME']) {  ?>
						<p><?php echo $_forumrow_val['LAST_POST_TIME']; ?></p>
						<p><?php echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_forumrow_val['LAST_POSTER_FULL']; ?> - <strong><?php echo $_forumrow_val['PLANTNAME']; ?></strong></p>
					<?php } else { ?>
						<p><?php echo ((isset($this->_rootref['L_NO_POSTS'])) ? $this->_rootref['L_NO_POSTS'] : ((isset($user->lang['NO_POSTS'])) ? $user->lang['NO_POSTS'] : '{ NO_POSTS }')); ?></p>
					<?php } ?>
				</td>
			<?php } ?>
		</tr>
	<?php } if ($_forumrow_val['S_LAST_ROW']) {  ?>
				</tbody>
			</table>
		</div>
	<?php } }} else { ?>
	<div class="panel">
		<div class="inner"><span class="corners-top"><span></span></span>
			
		<strong><?php echo ((isset($this->_rootref['L_NO_FORUMS'])) ? $this->_rootref['L_NO_FORUMS'] : ((isset($user->lang['NO_FORUMS'])) ? $user->lang['NO_FORUMS'] : '{ NO_FORUMS }')); ?></strong>
		
		<span class="corners-bottom"><span></span></span></div>
	</div>
<?php } ?>