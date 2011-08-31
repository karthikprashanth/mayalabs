<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>


<h2><?php if ($this->_rootref['SEARCH_TITLE']) {  echo (isset($this->_rootref['SEARCH_TITLE'])) ? $this->_rootref['SEARCH_TITLE'] : ''; } else { echo (isset($this->_rootref['SEARCH_MATCHES'])) ? $this->_rootref['SEARCH_MATCHES'] : ''; } if ($this->_rootref['SEARCH_WORDS']) {  ?>: <a href="<?php echo (isset($this->_rootref['U_SEARCH_WORDS'])) ? $this->_rootref['U_SEARCH_WORDS'] : ''; ?>"><?php echo (isset($this->_rootref['SEARCH_WORDS'])) ? $this->_rootref['SEARCH_WORDS'] : ''; ?></a><?php } ?></h2>
<?php if ($this->_rootref['IGNORED_WORDS']) {  ?> <p><?php echo ((isset($this->_rootref['L_IGNORED_TERMS'])) ? $this->_rootref['L_IGNORED_TERMS'] : ((isset($user->lang['IGNORED_TERMS'])) ? $user->lang['IGNORED_TERMS'] : '{ IGNORED_TERMS }')); ?>: <strong><?php echo (isset($this->_rootref['IGNORED_WORDS'])) ? $this->_rootref['IGNORED_WORDS'] : ''; ?></strong></p><?php } if ($this->_rootref['SEARCH_TOPIC']) {  ?>

	<p><a class="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_BEGIN'])) ? $this->_rootref['S_CONTENT_FLOW_BEGIN'] : ''; ?>" href="<?php echo (isset($this->_rootref['U_SEARCH_TOPIC'])) ? $this->_rootref['U_SEARCH_TOPIC'] : ''; ?>"><?php echo ((isset($this->_rootref['L_RETURN_TO'])) ? $this->_rootref['L_RETURN_TO'] : ((isset($user->lang['RETURN_TO'])) ? $user->lang['RETURN_TO'] : '{ RETURN_TO }')); ?>: <?php echo (isset($this->_rootref['SEARCH_TOPIC'])) ? $this->_rootref['SEARCH_TOPIC'] : ''; ?></a></p>
<?php } else { ?>

	<p><a class="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_BEGIN'])) ? $this->_rootref['S_CONTENT_FLOW_BEGIN'] : ''; ?>" href="<?php echo (isset($this->_rootref['U_SEARCH'])) ? $this->_rootref['U_SEARCH'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_SEARCH_ADV'])) ? $this->_rootref['L_SEARCH_ADV'] : ((isset($user->lang['SEARCH_ADV'])) ? $user->lang['SEARCH_ADV'] : '{ SEARCH_ADV }')); ?>"><?php echo ((isset($this->_rootref['L_RETURN_TO_SEARCH_ADV'])) ? $this->_rootref['L_RETURN_TO_SEARCH_ADV'] : ((isset($user->lang['RETURN_TO_SEARCH_ADV'])) ? $user->lang['RETURN_TO_SEARCH_ADV'] : '{ RETURN_TO_SEARCH_ADV }')); ?></a></p>
<?php } if ($this->_rootref['PAGINATION'] || $this->_rootref['SEARCH_MATCHES'] || $this->_rootref['PAGE_NUMBER']) {  ?>

	<form method="post" action="<?php echo (isset($this->_rootref['S_SEARCH_ACTION'])) ? $this->_rootref['S_SEARCH_ACTION'] : ''; ?>">

	<div class="topic-actions">

	<?php if ($this->_rootref['SEARCH_MATCHES']) {  ?>

		<div class="search-box">
			<form method="post" id="forum-search" action="<?php echo (isset($this->_rootref['S_SEARCHBOX_ACTION'])) ? $this->_rootref['S_SEARCHBOX_ACTION'] : ''; ?>">
			<fieldset>
				<input class="inputbox search tiny" type="text" name="add_keywords" id="add_keywords" size="20" value="<?php echo ((isset($this->_rootref['L_SEARCH_IN_RESULTS'])) ? $this->_rootref['L_SEARCH_IN_RESULTS'] : ((isset($user->lang['SEARCH_IN_RESULTS'])) ? $user->lang['SEARCH_IN_RESULTS'] : '{ SEARCH_IN_RESULTS }')); ?>" onclick="if (this.value == '<?php echo ((isset($this->_rootref['L_SEARCH_IN_RESULTS'])) ? $this->_rootref['L_SEARCH_IN_RESULTS'] : ((isset($user->lang['SEARCH_IN_RESULTS'])) ? $user->lang['SEARCH_IN_RESULTS'] : '{ SEARCH_IN_RESULTS }')); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php echo ((isset($this->_rootref['L_SEARCH_IN_RESULTS'])) ? $this->_rootref['L_SEARCH_IN_RESULTS'] : ((isset($user->lang['SEARCH_IN_RESULTS'])) ? $user->lang['SEARCH_IN_RESULTS'] : '{ SEARCH_IN_RESULTS }')); ?>';" />
				<input class="button2" type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" />
			</fieldset>
			</form>
		</div>
	<?php } ?>


		<div class="rightside pagination">
			<?php echo (isset($this->_rootref['SEARCH_MATCHES'])) ? $this->_rootref['SEARCH_MATCHES'] : ''; if ($this->_rootref['PAGINATION']) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { ?> &bull; <?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } ?>

		</div>
	</div>

	</form>
<?php } if ($this->_rootref['S_SHOW_TOPICS']) {  if (sizeof($this->_tpldata['searchresults'])) {  ?>

		<div class="forums-wrapper">
			<table class="forums">
				<thead>
					<tr>
						<th colspan="2"><?php echo ((isset($this->_rootref['L_TOPICS'])) ? $this->_rootref['L_TOPICS'] : ((isset($user->lang['TOPICS'])) ? $user->lang['TOPICS'] : '{ TOPICS }')); ?></th>
						<th class="statistics"><?php echo ((isset($this->_rootref['L_STATISTICS'])) ? $this->_rootref['L_STATISTICS'] : ((isset($user->lang['STATISTICS'])) ? $user->lang['STATISTICS'] : '{ STATISTICS }')); ?></th>
						<th class="last-post"><?php echo ((isset($this->_rootref['L_LAST_POST'])) ? $this->_rootref['L_LAST_POST'] : ((isset($user->lang['LAST_POST'])) ? $user->lang['LAST_POST'] : '{ LAST_POST }')); ?></th>
					</tr>
				</thead>
				<tbody>

		<?php $_searchresults_count = (isset($this->_tpldata['searchresults'])) ? sizeof($this->_tpldata['searchresults']) : 0;if ($_searchresults_count) {for ($_searchresults_i = 0; $_searchresults_i < $_searchresults_count; ++$_searchresults_i){$_searchresults_val = &$this->_tpldata['searchresults'][$_searchresults_i]; ?>

			<tr class="<?php if (!($_searchresults_val['S_ROW_COUNT'] & 1)  ) {  ?>bg1<?php } else { ?>bg2<?php } if ($_searchresults_val['S_POST_ANNOUNCE']) {  ?> announce<?php } if ($_searchresults_val['S_POST_STICKY']) {  ?> sticky<?php } if ($_searchresults_val['S_TOPIC_REPORTED']) {  ?> reported<?php } ?>">
				<td class="icon bg2" style="background-image: url(<?php echo $_searchresults_val['TOPIC_FOLDER_IMG_SRC']; ?>);" title="<?php echo $_searchresults_val['TOPIC_FOLDER_IMG_ALT']; ?>">
					<?php if ($_searchresults_val['TOPIC_ICON_IMG']) {  ?><img src="<?php echo (isset($this->_rootref['T_ICONS_PATH'])) ? $this->_rootref['T_ICONS_PATH'] : ''; echo $_searchresults_val['TOPIC_ICON_IMG']; ?>" alt="" title="" /><?php } ?>

				</td>
				<td class="topic">
					<h4><?php if ($_searchresults_val['ATTACH_ICON_IMG']) {  echo $_searchresults_val['ATTACH_ICON_IMG']; } ?> <a href="<?php echo $_searchresults_val['U_VIEW_TOPIC']; ?>" class="topictitle"><?php echo $_searchresults_val['TOPIC_TITLE']; ?></a></h4>
					<?php if ($_searchresults_val['PAGINATION']) {  ?><strong class="pagination"><span><?php echo $_searchresults_val['PAGINATION']; ?></span></strong><?php } ?>

					<p><?php echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_searchresults_val['TOPIC_AUTHOR_FULL']; ?> &raquo; <?php echo $_searchresults_val['FIRST_POST_TIME']; ?></p>
				</td>
				<td class="bg2">
					<p><?php echo ((isset($this->_rootref['L_REPLIES'])) ? $this->_rootref['L_REPLIES'] : ((isset($user->lang['REPLIES'])) ? $user->lang['REPLIES'] : '{ REPLIES }')); ?>: <strong><?php echo $_searchresults_val['TOPIC_REPLIES']; ?></strong></p>
					<p><?php echo ((isset($this->_rootref['L_VIEWS'])) ? $this->_rootref['L_VIEWS'] : ((isset($user->lang['VIEWS'])) ? $user->lang['VIEWS'] : '{ VIEWS }')); ?>: <strong><?php echo $_searchresults_val['TOPIC_VIEWS']; ?></strong></p>
				</td>
				<td>
					<p><?php echo $_searchresults_val['LAST_POST_TIME']; ?></p>
					<p><?php echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_searchresults_val['LAST_POST_AUTHOR_FULL']; ?> <?php if (! $this->_rootref['S_IS_BOT']) {  ?><a href="<?php echo $_searchresults_val['U_LAST_POST']; ?>"><?php echo (isset($this->_rootref['LAST_POST_IMG'])) ? $this->_rootref['LAST_POST_IMG'] : ''; ?></a><?php } ?></p>
				</td>
			</tr>
		<?php }} ?>

		
			</tbody>
			</table>
		</div>
	<?php } else { ?>

		<div class="panel">
			<div class="inner"><span class="corners-top"><span></span></span>
			<strong><?php echo ((isset($this->_rootref['L_NO_SEARCH_RESULTS'])) ? $this->_rootref['L_NO_SEARCH_RESULTS'] : ((isset($user->lang['NO_SEARCH_RESULTS'])) ? $user->lang['NO_SEARCH_RESULTS'] : '{ NO_SEARCH_RESULTS }')); ?></strong>
			<span class="corners-bottom"><span></span></span></div>
		</div>
	<?php } } else { $_searchresults_count = (isset($this->_tpldata['searchresults'])) ? sizeof($this->_tpldata['searchresults']) : 0;if ($_searchresults_count) {for ($_searchresults_i = 0; $_searchresults_i < $_searchresults_count; ++$_searchresults_i){$_searchresults_val = &$this->_tpldata['searchresults'][$_searchresults_i]; ?>

		<div class="search post <?php if (($_searchresults_val['S_ROW_COUNT'] & 1)  ) {  ?>bg1<?php } else { ?>bg2<?php } if ($_searchresults_val['S_POST_REPORTED']) {  ?> reported<?php } ?>">
			<div class="inner"><span class="corners-top"><span></span></span>

	<?php if ($_searchresults_val['S_IGNORE_POST']) {  ?>

		<div class="postbody">
			<?php echo $_searchresults_val['L_IGNORE_POST']; ?>

		</div>
	<?php } else { ?>

		<div class="postbody">
			<h3><a href="<?php echo $_searchresults_val['U_VIEW_POST']; ?>"><?php echo $_searchresults_val['POST_SUBJECT']; ?></a></h3>
			<div class="content"><?php echo $_searchresults_val['MESSAGE']; ?></div>
		</div>

		<dl class="postprofile">
			<dt class="author"><?php echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_searchresults_val['POST_AUTHOR_FULL']; ?></dt>
			<dd><?php echo $_searchresults_val['POST_DATE']; ?></dd>
			<dd>&nbsp;</dd>
			<?php if ($_searchresults_val['FORUM_TITLE']) {  ?>

				<dd><?php echo ((isset($this->_rootref['L_FORUM'])) ? $this->_rootref['L_FORUM'] : ((isset($user->lang['FORUM'])) ? $user->lang['FORUM'] : '{ FORUM }')); ?>: <a href="<?php echo $_searchresults_val['U_VIEW_FORUM']; ?>"><?php echo $_searchresults_val['FORUM_TITLE']; ?></a></dd>
				<dd><?php echo ((isset($this->_rootref['L_TOPIC'])) ? $this->_rootref['L_TOPIC'] : ((isset($user->lang['TOPIC'])) ? $user->lang['TOPIC'] : '{ TOPIC }')); ?>: <a href="<?php echo $_searchresults_val['U_VIEW_TOPIC']; ?>"><?php echo $_searchresults_val['TOPIC_TITLE']; ?></a></dd>
			<?php } else { ?>

				<dd><?php echo ((isset($this->_rootref['L_GLOBAL'])) ? $this->_rootref['L_GLOBAL'] : ((isset($user->lang['GLOBAL'])) ? $user->lang['GLOBAL'] : '{ GLOBAL }')); ?>: <a href="<?php echo $_searchresults_val['U_VIEW_TOPIC']; ?>"><?php echo $_searchresults_val['TOPIC_TITLE']; ?></a></dd>
			<?php } ?>

			<dd><?php echo ((isset($this->_rootref['L_REPLIES'])) ? $this->_rootref['L_REPLIES'] : ((isset($user->lang['REPLIES'])) ? $user->lang['REPLIES'] : '{ REPLIES }')); ?>: <strong><?php echo $_searchresults_val['TOPIC_REPLIES']; ?></strong></dd>
			<dd><?php echo ((isset($this->_rootref['L_VIEWS'])) ? $this->_rootref['L_VIEWS'] : ((isset($user->lang['VIEWS'])) ? $user->lang['VIEWS'] : '{ VIEWS }')); ?>: <strong><?php echo $_searchresults_val['TOPIC_VIEWS']; ?></strong></dd>
		</dl>
	<?php } if (! $_searchresults_val['S_IGNORE_POST']) {  ?>

		<ul class="searchresults">
			<li><p style="margin-bottom: 2px;"><a href="<?php echo $_searchresults_val['U_VIEW_POST']; ?>" class="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>"><?php echo ((isset($this->_rootref['L_JUMP_TO_POST'])) ? $this->_rootref['L_JUMP_TO_POST'] : ((isset($user->lang['JUMP_TO_POST'])) ? $user->lang['JUMP_TO_POST'] : '{ JUMP_TO_POST }')); ?></a></p></li>
		</ul>
	<?php } ?>


			<span class="corners-bottom"><span></span></span></div>
		</div>
	<?php }} else { ?>

		<div class="panel">
			<div class="inner"><span class="corners-top"><span></span></span>
			<strong><?php echo ((isset($this->_rootref['L_NO_SEARCH_RESULTS'])) ? $this->_rootref['L_NO_SEARCH_RESULTS'] : ((isset($user->lang['NO_SEARCH_RESULTS'])) ? $user->lang['NO_SEARCH_RESULTS'] : '{ NO_SEARCH_RESULTS }')); ?></strong>
			<span class="corners-bottom"><span></span></span></div>
		</div>
	<?php } } if ($this->_rootref['PAGINATION'] || sizeof($this->_tpldata['searchresults']) || $this->_rootref['S_SELECT_SORT_KEY'] || $this->_rootref['S_SELECT_SORT_DAYS']) {  ?>

	<form method="post" action="<?php echo (isset($this->_rootref['S_SEARCH_ACTION'])) ? $this->_rootref['S_SEARCH_ACTION'] : ''; ?>">

	<fieldset class="display-options">
		<?php if ($this->_rootref['PREVIOUS_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['PREVIOUS_PAGE'])) ? $this->_rootref['PREVIOUS_PAGE'] : ''; ?>" class="left-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_BEGIN'])) ? $this->_rootref['S_CONTENT_FLOW_BEGIN'] : ''; ?>"><?php echo ((isset($this->_rootref['L_PREVIOUS'])) ? $this->_rootref['L_PREVIOUS'] : ((isset($user->lang['PREVIOUS'])) ? $user->lang['PREVIOUS'] : '{ PREVIOUS }')); ?></a><?php } if ($this->_rootref['NEXT_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['NEXT_PAGE'])) ? $this->_rootref['NEXT_PAGE'] : ''; ?>" class="right-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>"><?php echo ((isset($this->_rootref['L_NEXT'])) ? $this->_rootref['L_NEXT'] : ((isset($user->lang['NEXT'])) ? $user->lang['NEXT'] : '{ NEXT }')); ?></a><?php } if ($this->_rootref['S_SELECT_SORT_DAYS'] || $this->_rootref['S_SELECT_SORT_KEY']) {  ?>

			<label><?php if ($this->_rootref['S_SHOW_TOPICS']) {  echo ((isset($this->_rootref['L_DISPLAY_POSTS'])) ? $this->_rootref['L_DISPLAY_POSTS'] : ((isset($user->lang['DISPLAY_POSTS'])) ? $user->lang['DISPLAY_POSTS'] : '{ DISPLAY_POSTS }')); } else { echo ((isset($this->_rootref['L_SORT_BY'])) ? $this->_rootref['L_SORT_BY'] : ((isset($user->lang['SORT_BY'])) ? $user->lang['SORT_BY'] : '{ SORT_BY }')); ?></label><label><?php } ?> <?php echo (isset($this->_rootref['S_SELECT_SORT_DAYS'])) ? $this->_rootref['S_SELECT_SORT_DAYS'] : ''; if ($this->_rootref['S_SELECT_SORT_KEY']) {  ?></label> <label><?php echo (isset($this->_rootref['S_SELECT_SORT_KEY'])) ? $this->_rootref['S_SELECT_SORT_KEY'] : ''; ?></label>
			<label><?php echo (isset($this->_rootref['S_SELECT_SORT_DIR'])) ? $this->_rootref['S_SELECT_SORT_DIR'] : ''; } ?> <input type="submit" name="sort" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" class="button2" /></label>
		<?php } ?>

	</fieldset>

	</form>

	<hr />
<?php } if ($this->_rootref['PAGINATION'] || sizeof($this->_tpldata['searchresults']) || $this->_rootref['PAGE_NUMBER']) {  ?>

	<ul class="linklist">
		<li class="rightside pagination">
			<?php echo (isset($this->_rootref['SEARCH_MATCHES'])) ? $this->_rootref['SEARCH_MATCHES'] : ''; if ($this->_rootref['PAGINATION']) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { ?> &bull; <?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } ?>

		</li>
	</ul>
<?php } $this->_tpl_include('jumpbox.html'); $this->_tpl_include('overall_footer.html'); ?>