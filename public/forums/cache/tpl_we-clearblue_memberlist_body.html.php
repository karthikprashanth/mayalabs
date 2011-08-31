<?php if (!defined('IN_PHPBB')) exit; if ($this->_rootref['S_IN_SEARCH_POPUP']) {  $this->_tpl_include('simple_header.html'); $this->_tpl_include('memberlist_search.html'); ?>

	<form method="post" id="results" action="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>" onsubmit="insert_marked(this.user); return false">
<?php } else if ($this->_rootref['S_SEARCH_USER']) {  $this->_tpl_include('overall_header.html'); $this->_tpl_include('memberlist_search.html'); ?>

	<form method="post" action="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>">
<?php } else { $this->_tpl_include('overall_header.html'); ?>

	<form method="post" action="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>">
<?php } if ($this->_rootref['S_SHOW_GROUP']) {  ?>

		<h2<?php if ($this->_rootref['GROUP_COLOR']) {  ?> style="color:#<?php echo (isset($this->_rootref['GROUP_COLOR'])) ? $this->_rootref['GROUP_COLOR'] : ''; ?>;"<?php } ?>><?php echo (isset($this->_rootref['GROUP_NAME'])) ? $this->_rootref['GROUP_NAME'] : ''; ?></h2>
		<p><?php echo (isset($this->_rootref['GROUP_DESC'])) ? $this->_rootref['GROUP_DESC'] : ''; ?> <?php echo (isset($this->_rootref['GROUP_TYPE'])) ? $this->_rootref['GROUP_TYPE'] : ''; ?></p>
	<?php } else { ?>

		<h2><?php echo (isset($this->_rootref['PAGE_TITLE'])) ? $this->_rootref['PAGE_TITLE'] : ''; if ($this->_rootref['SEARCH_WORDS']) {  ?>: <a href="<?php echo (isset($this->_rootref['U_SEARCH_WORDS'])) ? $this->_rootref['U_SEARCH_WORDS'] : ''; ?>"><?php echo (isset($this->_rootref['SEARCH_WORDS'])) ? $this->_rootref['SEARCH_WORDS'] : ''; ?></a><?php } ?></h2>

		<div class="panel">
			<div class="inner"><span class="corners-top"><span></span></span>

			<ul class="linklist">
				<li>
					<?php if ($this->_rootref['U_FIND_MEMBER'] && ! $this->_rootref['S_SEARCH_USER']) {  ?><a href="<?php echo (isset($this->_rootref['U_FIND_MEMBER'])) ? $this->_rootref['U_FIND_MEMBER'] : ''; ?>"><?php echo ((isset($this->_rootref['L_FIND_USERNAME'])) ? $this->_rootref['L_FIND_USERNAME'] : ((isset($user->lang['FIND_USERNAME'])) ? $user->lang['FIND_USERNAME'] : '{ FIND_USERNAME }')); ?></a> &bull; <?php } else if ($this->_rootref['S_SEARCH_USER'] && $this->_rootref['U_HIDE_FIND_MEMBER'] && ! $this->_rootref['S_IN_SEARCH_POPUP']) {  ?><a href="<?php echo (isset($this->_rootref['U_HIDE_FIND_MEMBER'])) ? $this->_rootref['U_HIDE_FIND_MEMBER'] : ''; ?>"><?php echo ((isset($this->_rootref['L_HIDE_MEMBER_SEARCH'])) ? $this->_rootref['L_HIDE_MEMBER_SEARCH'] : ((isset($user->lang['HIDE_MEMBER_SEARCH'])) ? $user->lang['HIDE_MEMBER_SEARCH'] : '{ HIDE_MEMBER_SEARCH }')); ?></a> &bull; <?php } ?>

					<strong style="font-size: 0.95em;"><a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char="><?php echo ((isset($this->_rootref['L_ALL'])) ? $this->_rootref['L_ALL'] : ((isset($user->lang['ALL'])) ? $user->lang['ALL'] : '{ ALL }')); ?></a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=a#memberlist">A</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=b#memberlist">B</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=c#memberlist">C</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=d#memberlist">D</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=e#memberlist">E</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=f#memberlist">F</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=g#memberlist">G</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=h#memberlist">H</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=i#memberlist">I</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=j#memberlist">J</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=k#memberlist">K</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=l#memberlist">L</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=m#memberlist">M</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=n#memberlist">N</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=o#memberlist">O</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=p#memberlist">P</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=q#memberlist">Q</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=r#memberlist">R</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=s#memberlist">S</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=t#memberlist">T</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=u#memberlist">U</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=v#memberlist">V</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=w#memberlist">W</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=x#memberlist">X</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=y#memberlist">Y</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=z#memberlist">Z</a>&nbsp; 
					<a href="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>&amp;first_char=other">#</a></strong>
				</li>
				<li class="rightside pagination">
					<?php echo (isset($this->_rootref['TOTAL_USERS'])) ? $this->_rootref['TOTAL_USERS'] : ''; ?> &bull; 
					<?php if ($this->_rootref['PAGINATION']) {  ?><a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } ?>

				</li>
			</ul>

			<span class="corners-bottom"><span></span></span></div>
		</div>
	<?php } if ($this->_rootref['S_LEADERS_SET'] || ! $this->_rootref['S_SHOW_GROUP'] || ! sizeof($this->_tpldata['memberrow'])) {  ?>

		<div class="forums-wrapper">
			<table class="forums">
				<thead>
					<tr>
						<th class="name"><a href="<?php echo (isset($this->_rootref['U_SORT_USERNAME'])) ? $this->_rootref['U_SORT_USERNAME'] : ''; ?>"><?php if ($this->_rootref['S_SHOW_GROUP'] && sizeof($this->_tpldata['memberrow'])) {  echo ((isset($this->_rootref['L_GROUP_LEADER'])) ? $this->_rootref['L_GROUP_LEADER'] : ((isset($user->lang['GROUP_LEADER'])) ? $user->lang['GROUP_LEADER'] : '{ GROUP_LEADER }')); } else { echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); } ?></a></th>
						<th class="posts"><a href="<?php echo (isset($this->_rootref['U_SORT_POSTS'])) ? $this->_rootref['U_SORT_POSTS'] : ''; ?>"><?php echo ((isset($this->_rootref['L_POSTS'])) ? $this->_rootref['L_POSTS'] : ((isset($user->lang['POSTS'])) ? $user->lang['POSTS'] : '{ POSTS }')); ?></a></th>
						<th class="location"><a href="<?php echo (isset($this->_rootref['U_SORT_LOCATION'])) ? $this->_rootref['U_SORT_LOCATION'] : ''; ?>"><?php echo ((isset($this->_rootref['L_LOCATION'])) ? $this->_rootref['L_LOCATION'] : ((isset($user->lang['LOCATION'])) ? $user->lang['LOCATION'] : '{ LOCATION }')); ?></a></th>
						<th><?php echo ((isset($this->_rootref['L_ABOUT_USER'])) ? $this->_rootref['L_ABOUT_USER'] : ((isset($user->lang['ABOUT_USER'])) ? $user->lang['ABOUT_USER'] : '{ ABOUT_USER }')); ?></th>
						<th class="joined"><a href="<?php echo (isset($this->_rootref['U_SORT_JOINED'])) ? $this->_rootref['U_SORT_JOINED'] : ''; ?>"><?php echo ((isset($this->_rootref['L_JOINED'])) ? $this->_rootref['L_JOINED'] : ((isset($user->lang['JOINED'])) ? $user->lang['JOINED'] : '{ JOINED }')); ?></a></th>
						<?php if ($this->_rootref['U_SORT_ACTIVE']) {  ?><th class="active"><a href="<?php echo (isset($this->_rootref['U_SORT_ACTIVE'])) ? $this->_rootref['U_SORT_ACTIVE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_LAST_ACTIVE'])) ? $this->_rootref['L_LAST_ACTIVE'] : ((isset($user->lang['LAST_ACTIVE'])) ? $user->lang['LAST_ACTIVE'] : '{ LAST_ACTIVE }')); ?></a></th><?php } ?>

					</tr>
				</thead>
				<tbody>
	<?php } $_memberrow_count = (isset($this->_tpldata['memberrow'])) ? sizeof($this->_tpldata['memberrow']) : 0;if ($_memberrow_count) {for ($_memberrow_i = 0; $_memberrow_i < $_memberrow_count; ++$_memberrow_i){$_memberrow_val = &$this->_tpldata['memberrow'][$_memberrow_i]; if ($this->_rootref['S_SHOW_GROUP']) {  if (! $_memberrow_val['S_GROUP_LEADER'] && ! $this->_tpldata['DEFINE']['.']['S_MEMBER_HEADER']) {  if ($this->_rootref['S_LEADERS_SET']) {  ?>

							</tbody>
						</table>
					</div>
				<?php } ?>

				
				<div class="forums-wrapper">
					<table class="forums">
						<thead>
							<tr>
								<?php if (! $this->_rootref['S_LEADERS_SET']) {  ?>

									<th class="name"><a href="<?php echo (isset($this->_rootref['U_SORT_USERNAME'])) ? $this->_rootref['U_SORT_USERNAME'] : ''; ?>"><?php if ($this->_rootref['S_SHOW_GROUP']) {  echo ((isset($this->_rootref['L_GROUP_MEMBERS'])) ? $this->_rootref['L_GROUP_MEMBERS'] : ((isset($user->lang['GROUP_MEMBERS'])) ? $user->lang['GROUP_MEMBERS'] : '{ GROUP_MEMBERS }')); } else { echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); } ?></a></th>
								<?php } else if ($this->_rootref['S_SHOW_GROUP']) {  ?>

									<th class="name"><a href="<?php echo (isset($this->_rootref['U_SORT_USERNAME'])) ? $this->_rootref['U_SORT_USERNAME'] : ''; ?>"><?php echo ((isset($this->_rootref['L_GROUP_MEMBERS'])) ? $this->_rootref['L_GROUP_MEMBERS'] : ((isset($user->lang['GROUP_MEMBERS'])) ? $user->lang['GROUP_MEMBERS'] : '{ GROUP_MEMBERS }')); ?></a></th>
								<?php } ?>

								<th class="posts"><a href="<?php echo (isset($this->_rootref['U_SORT_POSTS'])) ? $this->_rootref['U_SORT_POSTS'] : ''; ?>"><?php echo ((isset($this->_rootref['L_POSTS'])) ? $this->_rootref['L_POSTS'] : ((isset($user->lang['POSTS'])) ? $user->lang['POSTS'] : '{ POSTS }')); ?></a></th>
								<th class="location"><a href="<?php echo (isset($this->_rootref['U_SORT_LOCATION'])) ? $this->_rootref['U_SORT_LOCATION'] : ''; ?>"><?php echo ((isset($this->_rootref['L_LOCATION'])) ? $this->_rootref['L_LOCATION'] : ((isset($user->lang['LOCATION'])) ? $user->lang['LOCATION'] : '{ LOCATION }')); ?></a></th>
								<th><?php echo ((isset($this->_rootref['L_ABOUT_USER'])) ? $this->_rootref['L_ABOUT_USER'] : ((isset($user->lang['ABOUT_USER'])) ? $user->lang['ABOUT_USER'] : '{ ABOUT_USER }')); ?></th>
								<th class="joined"><a href="<?php echo (isset($this->_rootref['U_SORT_JOINED'])) ? $this->_rootref['U_SORT_JOINED'] : ''; ?>"><?php echo ((isset($this->_rootref['L_JOINED'])) ? $this->_rootref['L_JOINED'] : ((isset($user->lang['JOINED'])) ? $user->lang['JOINED'] : '{ JOINED }')); ?></a></th>
								<?php if ($this->_rootref['U_SORT_ACTIVE']) {  ?><th class="active"><a href="<?php echo (isset($this->_rootref['U_SORT_ACTIVE'])) ? $this->_rootref['U_SORT_ACTIVE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_LAST_ACTIVE'])) ? $this->_rootref['L_LAST_ACTIVE'] : ((isset($user->lang['LAST_ACTIVE'])) ? $user->lang['LAST_ACTIVE'] : '{ LAST_ACTIVE }')); ?></a></th><?php } ?>

							</tr>
						</thead>
						<tbody>	
							
						<?php $this->_tpldata['DEFINE']['.']['S_MEMBER_HEADER'] = 1; } } ?>

		
		<tr class="<?php if (($_memberrow_val['S_ROW_COUNT'] & 1)  ) {  ?>bg2<?php } else { ?>bg1<?php } ?>">
			<td>
				<p><?php echo $_memberrow_val['USERNAME_FULL']; ?></p>
				<p><?php if ($_memberrow_val['RANK_IMG']) {  echo $_memberrow_val['RANK_IMG']; } else { echo $_memberrow_val['RANK_TITLE']; } ?></p>
				<p>
					<?php if ($this->_rootref['S_IN_SEARCH_POPUP'] && ! $this->_rootref['S_SELECT_SINGLE']) {  ?><input type="checkbox" name="user" value="<?php echo $_memberrow_val['USERNAME']; ?>" /><?php } if ($this->_rootref['S_SELECT_SINGLE']) {  ?>[ <a href="#" onclick="insert_single('<?php echo $_memberrow_val['A_USERNAME']; ?>'); return false;"><?php echo ((isset($this->_rootref['L_SELECT'])) ? $this->_rootref['L_SELECT'] : ((isset($user->lang['SELECT'])) ? $user->lang['SELECT'] : '{ SELECT }')); ?></a> ]<?php } ?>

				</p>
			</td>
			<td class="bg2"><p><?php if ($_memberrow_val['POSTS'] && $this->_rootref['S_DISPLAY_SEARCH']) {  ?><a href="<?php echo $_memberrow_val['U_SEARCH_USER']; ?>" title="<?php echo ((isset($this->_rootref['L_SEARCH_USER_POSTS'])) ? $this->_rootref['L_SEARCH_USER_POSTS'] : ((isset($user->lang['SEARCH_USER_POSTS'])) ? $user->lang['SEARCH_USER_POSTS'] : '{ SEARCH_USER_POSTS }')); ?>"><?php echo $_memberrow_val['POSTS']; ?></a><?php } else { echo $_memberrow_val['POSTS']; } ?></p></td>
			<td><p><?php if ($_memberrow_val['LOCATION']) {  echo $_memberrow_val['LOCATION']; } else { ?>-<?php } ?></p></td>
			<td class="profile bg2">
				<?php if ($_memberrow_val['U_PM'] || $_memberrow_val['U_EMAIL'] || $_memberrow_val['U_WWW'] || $_memberrow_val['U_MSN'] || $_memberrow_val['U_ICQ'] || $_memberrow_val['U_YIM'] || $_memberrow_val['U_AIM'] || $_memberrow_val['U_JABBER']) {  ?>

					<ul class="profile-icons">
						<?php if ($_memberrow_val['U_PM']) {  ?><li class="pm-icon"><a href="<?php echo $_memberrow_val['U_PM']; ?>" title="<?php echo ((isset($this->_rootref['L_PRIVATE_MESSAGE'])) ? $this->_rootref['L_PRIVATE_MESSAGE'] : ((isset($user->lang['PRIVATE_MESSAGE'])) ? $user->lang['PRIVATE_MESSAGE'] : '{ PRIVATE_MESSAGE }')); ?>"><span><?php echo ((isset($this->_rootref['L_PRIVATE_MESSAGE'])) ? $this->_rootref['L_PRIVATE_MESSAGE'] : ((isset($user->lang['PRIVATE_MESSAGE'])) ? $user->lang['PRIVATE_MESSAGE'] : '{ PRIVATE_MESSAGE }')); ?></span></a></li><?php } if ($_memberrow_val['U_EMAIL']) {  ?><li class="email-icon"><a href="<?php echo $_memberrow_val['U_EMAIL']; ?>" title="<?php echo ((isset($this->_rootref['L_SEND_EMAIL_USER'])) ? $this->_rootref['L_SEND_EMAIL_USER'] : ((isset($user->lang['SEND_EMAIL_USER'])) ? $user->lang['SEND_EMAIL_USER'] : '{ SEND_EMAIL_USER }')); ?> <?php echo $_memberrow_val['POST_AUTHOR']; ?>"><span><?php echo ((isset($this->_rootref['L_SEND_EMAIL_USER'])) ? $this->_rootref['L_SEND_EMAIL_USER'] : ((isset($user->lang['SEND_EMAIL_USER'])) ? $user->lang['SEND_EMAIL_USER'] : '{ SEND_EMAIL_USER }')); ?> <?php echo $_memberrow_val['POST_AUTHOR']; ?></span></a></li><?php } if ($_memberrow_val['U_WWW']) {  ?><li class="web-icon"><a href="<?php echo $_memberrow_val['U_WWW']; ?>" title="<?php echo ((isset($this->_rootref['L_VISIT_WEBSITE'])) ? $this->_rootref['L_VISIT_WEBSITE'] : ((isset($user->lang['VISIT_WEBSITE'])) ? $user->lang['VISIT_WEBSITE'] : '{ VISIT_WEBSITE }')); ?>: <?php echo $_memberrow_val['U_WWW']; ?>"><span><?php echo ((isset($this->_rootref['L_WEBSITE'])) ? $this->_rootref['L_WEBSITE'] : ((isset($user->lang['WEBSITE'])) ? $user->lang['WEBSITE'] : '{ WEBSITE }')); ?></span></a></li><?php } if ($_memberrow_val['U_MSN']) {  ?><li class="msnm-icon"><a href="<?php echo $_memberrow_val['U_MSN']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_MSNM'])) ? $this->_rootref['L_MSNM'] : ((isset($user->lang['MSNM'])) ? $user->lang['MSNM'] : '{ MSNM }')); ?>"><span><?php echo ((isset($this->_rootref['L_MSNM'])) ? $this->_rootref['L_MSNM'] : ((isset($user->lang['MSNM'])) ? $user->lang['MSNM'] : '{ MSNM }')); ?></span></a></li><?php } if ($_memberrow_val['U_ICQ']) {  ?><li class="icq-icon"><a href="<?php echo $_memberrow_val['U_ICQ']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_ICQ'])) ? $this->_rootref['L_ICQ'] : ((isset($user->lang['ICQ'])) ? $user->lang['ICQ'] : '{ ICQ }')); ?>"><span><?php echo ((isset($this->_rootref['L_ICQ'])) ? $this->_rootref['L_ICQ'] : ((isset($user->lang['ICQ'])) ? $user->lang['ICQ'] : '{ ICQ }')); ?></span></a></li><?php } if ($_memberrow_val['U_YIM']) {  ?><li class="yahoo-icon"><a href="<?php echo $_memberrow_val['U_YIM']; ?>" onclick="popup(this.href, 780, 550); return false;" title="<?php echo ((isset($this->_rootref['L_YIM'])) ? $this->_rootref['L_YIM'] : ((isset($user->lang['YIM'])) ? $user->lang['YIM'] : '{ YIM }')); ?>"><span><?php echo ((isset($this->_rootref['L_YIM'])) ? $this->_rootref['L_YIM'] : ((isset($user->lang['YIM'])) ? $user->lang['YIM'] : '{ YIM }')); ?></span></a></li><?php } if ($_memberrow_val['U_AIM']) {  ?><li class="aim-icon"><a href="<?php echo $_memberrow_val['U_AIM']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_AIM'])) ? $this->_rootref['L_AIM'] : ((isset($user->lang['AIM'])) ? $user->lang['AIM'] : '{ AIM }')); ?>"><span><?php echo ((isset($this->_rootref['L_AIM'])) ? $this->_rootref['L_AIM'] : ((isset($user->lang['AIM'])) ? $user->lang['AIM'] : '{ AIM }')); ?></span></a></li><?php } if ($_memberrow_val['U_JABBER']) {  ?><li class="jabber-icon"><a href="<?php echo $_memberrow_val['U_JABBER']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_JABBER'])) ? $this->_rootref['L_JABBER'] : ((isset($user->lang['JABBER'])) ? $user->lang['JABBER'] : '{ JABBER }')); ?>"><span><?php echo ((isset($this->_rootref['L_JABBER'])) ? $this->_rootref['L_JABBER'] : ((isset($user->lang['JABBER'])) ? $user->lang['JABBER'] : '{ JABBER }')); ?></span></a></li><?php } ?>

					</ul>
				<?php } else { ?>

					<p>-</p>
				<?php } ?>

			</td>
			<td><p><?php echo $_memberrow_val['JOINED']; ?></p></td>
			<?php if ($this->_rootref['S_VIEWONLINE']) {  ?><td class="bg2"><p><?php echo $_memberrow_val['VISITED']; ?></p></td><?php } ?>

		</tr>
	<?php }} else { ?>

		<tr class="bg1">
			<td colspan="<?php if ($this->_rootref['S_VIEWONLINE']) {  ?>6<?php } else { ?>5<?php } ?>"><?php echo ((isset($this->_rootref['L_NO_MEMBERS'])) ? $this->_rootref['L_NO_MEMBERS'] : ((isset($user->lang['NO_MEMBERS'])) ? $user->lang['NO_MEMBERS'] : '{ NO_MEMBERS }')); ?></td>
		</tr>
	<?php } ?>

	
				</tbody>
			</table>
		</div>

<?php if ($this->_rootref['S_IN_SEARCH_POPUP'] && ! $this->_rootref['S_SELECT_SINGLE']) {  ?>

	<fieldset class="display-actions">
		<input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SELECT_MARKED'])) ? $this->_rootref['L_SELECT_MARKED'] : ((isset($user->lang['SELECT_MARKED'])) ? $user->lang['SELECT_MARKED'] : '{ SELECT_MARKED }')); ?>" class="button2" />
		<div><a href="#" onclick="marklist('results', 'user', true); return false;"><?php echo ((isset($this->_rootref['L_MARK_ALL'])) ? $this->_rootref['L_MARK_ALL'] : ((isset($user->lang['MARK_ALL'])) ? $user->lang['MARK_ALL'] : '{ MARK_ALL }')); ?></a> &bull; <a href="#" onclick="marklist('results', 'user', false); return false;"><?php echo ((isset($this->_rootref['L_UNMARK_ALL'])) ? $this->_rootref['L_UNMARK_ALL'] : ((isset($user->lang['UNMARK_ALL'])) ? $user->lang['UNMARK_ALL'] : '{ UNMARK_ALL }')); ?></a></div>
	</fieldset>
<?php } if ($this->_rootref['S_IN_SEARCH_POPUP']) {  ?>

	</form>
	<form method="post" id="sort-results" action="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>">
<?php } if ($this->_rootref['S_IN_SEARCH_POPUP'] && ! $this->_rootref['S_SEARCH_USER']) {  ?>

	<fieldset class="display-options">
		<?php if ($this->_rootref['PREVIOUS_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['PREVIOUS_PAGE'])) ? $this->_rootref['PREVIOUS_PAGE'] : ''; ?>" class="left-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_BEGIN'])) ? $this->_rootref['S_CONTENT_FLOW_BEGIN'] : ''; ?>"><?php echo ((isset($this->_rootref['L_PREVIOUS'])) ? $this->_rootref['L_PREVIOUS'] : ((isset($user->lang['PREVIOUS'])) ? $user->lang['PREVIOUS'] : '{ PREVIOUS }')); ?></a><?php } if ($this->_rootref['NEXT_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['NEXT_PAGE'])) ? $this->_rootref['NEXT_PAGE'] : ''; ?>" class="right-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>"><?php echo ((isset($this->_rootref['L_NEXT'])) ? $this->_rootref['L_NEXT'] : ((isset($user->lang['NEXT'])) ? $user->lang['NEXT'] : '{ NEXT }')); ?></a><?php } ?>

		<label for="sk"><?php echo ((isset($this->_rootref['L_SELECT_SORT_METHOD'])) ? $this->_rootref['L_SELECT_SORT_METHOD'] : ((isset($user->lang['SELECT_SORT_METHOD'])) ? $user->lang['SELECT_SORT_METHOD'] : '{ SELECT_SORT_METHOD }')); ?>: <select name="sk" id="sk"><?php echo (isset($this->_rootref['S_MODE_SELECT'])) ? $this->_rootref['S_MODE_SELECT'] : ''; ?></select></label> 
		<label for="sd"><?php echo ((isset($this->_rootref['L_ORDER'])) ? $this->_rootref['L_ORDER'] : ((isset($user->lang['ORDER'])) ? $user->lang['ORDER'] : '{ ORDER }')); ?> <select name="sd" id="sd"><?php echo (isset($this->_rootref['S_ORDER_SELECT'])) ? $this->_rootref['S_ORDER_SELECT'] : ''; ?></select> <input type="submit" name="sort" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" class="button2" /></label>
	</fieldset>
<?php } ?>


</form>

<ul class="linklist">
	<li class="rightside pagination"><?php echo (isset($this->_rootref['TOTAL_USERS'])) ? $this->_rootref['TOTAL_USERS'] : ''; ?> &bull; <?php if ($this->_rootref['PAGINATION']) {  ?><a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } ?></li>
</ul>

<?php if ($this->_rootref['S_IN_SEARCH_POPUP']) {  $this->_tpl_include('simple_footer.html'); } else { $this->_tpl_include('jumpbox.html'); $this->_tpl_include('overall_footer.html'); } ?>