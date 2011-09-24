<?php if (!defined('IN_PHPBB')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo (isset($this->_rootref['S_CONTENT_ENCODING'])) ? $this->_rootref['S_CONTENT_ENCODING'] : ''; ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="copyright" content="2000, 2002, 2005, 2007 phpBB Group" />
	<?php echo (isset($this->_rootref['META'])) ? $this->_rootref['META'] : ''; ?>
	
	<title><?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?> - Forums</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/print.css" rel="stylesheet" type="text/css" media="print" title="printonly" />
	<link href="<?php echo (isset($this->_rootref['T_STYLESHEET_LINK'])) ? $this->_rootref['T_STYLESHEET_LINK'] : ''; ?>" rel="stylesheet" type="text/css" media="screen, projection" />
	<?php if ($this->_rootref['S_CONTENT_DIRECTION'] == ('rtl')) {  ?><link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/bidi.css" rel="stylesheet" type="text/css" media="screen, projection" /><?php } if ($this->_rootref['S_ENABLE_FEEDS']) {  if ($this->_rootref['S_ENABLE_FEEDS_OVERALL']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_NEWS']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FEED_NEWS'])) ? $this->_rootref['L_FEED_NEWS'] : ((isset($user->lang['FEED_NEWS'])) ? $user->lang['FEED_NEWS'] : '{ FEED_NEWS }')); ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?mode=news" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_FORUMS']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_ALL_FORUMS'])) ? $this->_rootref['L_ALL_FORUMS'] : ((isset($user->lang['ALL_FORUMS'])) ? $user->lang['ALL_FORUMS'] : '{ ALL_FORUMS }')); ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?mode=forums" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_TOPICS']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FEED_TOPICS_NEW'])) ? $this->_rootref['L_FEED_TOPICS_NEW'] : ((isset($user->lang['FEED_TOPICS_NEW'])) ? $user->lang['FEED_TOPICS_NEW'] : '{ FEED_TOPICS_NEW }')); ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?mode=topics" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_TOPICS_ACTIVE']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FEED_TOPICS_ACTIVE'])) ? $this->_rootref['L_FEED_TOPICS_ACTIVE'] : ((isset($user->lang['FEED_TOPICS_ACTIVE'])) ? $user->lang['FEED_TOPICS_ACTIVE'] : '{ FEED_TOPICS_ACTIVE }')); ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?mode=topics_active" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_FORUM'] && $this->_rootref['S_FORUM_ID']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FORUM'])) ? $this->_rootref['L_FORUM'] : ((isset($user->lang['FORUM'])) ? $user->lang['FORUM'] : '{ FORUM }')); ?> - <?php echo (isset($this->_rootref['FORUM_NAME'])) ? $this->_rootref['FORUM_NAME'] : ''; ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?f=<?php echo (isset($this->_rootref['S_FORUM_ID'])) ? $this->_rootref['S_FORUM_ID'] : ''; ?>" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_TOPIC'] && $this->_rootref['S_TOPIC_ID']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_TOPIC'])) ? $this->_rootref['L_TOPIC'] : ((isset($user->lang['TOPIC'])) ? $user->lang['TOPIC'] : '{ TOPIC }')); ?> - <?php echo (isset($this->_rootref['TOPIC_TITLE'])) ? $this->_rootref['TOPIC_TITLE'] : ''; ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?f=<?php echo (isset($this->_rootref['S_FORUM_ID'])) ? $this->_rootref['S_FORUM_ID'] : ''; ?>&amp;t=<?php echo (isset($this->_rootref['S_TOPIC_ID'])) ? $this->_rootref['S_TOPIC_ID'] : ''; ?>" /><?php } } ?>

	<link href="../css/ddsmoothmenu.css" media="screen" rel="stylesheet" type="text/css" >
	<script type = "text/javascript" src = "../js/jquery/js/jquery-1.5.1.min.js"></script>
	<script type = "text/javascript" src = "../js/ddsmoothmenu.js"></script>
	<script type="text/javascript">
	// <![CDATA[
		var jump_page = '<?php echo ((isset($this->_rootref['LA_JUMP_PAGE'])) ? $this->_rootref['LA_JUMP_PAGE'] : ((isset($this->_rootref['L_JUMP_PAGE'])) ? addslashes($this->_rootref['L_JUMP_PAGE']) : ((isset($user->lang['JUMP_PAGE'])) ? addslashes($user->lang['JUMP_PAGE']) : '{ JUMP_PAGE }'))); ?>:';
		var on_page = '<?php echo (isset($this->_rootref['ON_PAGE'])) ? $this->_rootref['ON_PAGE'] : ''; ?>';
		var per_page = '<?php echo (isset($this->_rootref['PER_PAGE'])) ? $this->_rootref['PER_PAGE'] : ''; ?>';
		var base_url = '<?php echo (isset($this->_rootref['A_BASE_URL'])) ? $this->_rootref['A_BASE_URL'] : ''; ?>';
		var style_cookie = 'phpBBstyle';
		var style_cookie_settings = '<?php echo (isset($this->_rootref['A_COOKIE_SETTINGS'])) ? $this->_rootref['A_COOKIE_SETTINGS'] : ''; ?>';
		var onload_functions = new Array();
		var onunload_functions = new Array();

		<?php if ($this->_rootref['S_USER_PM_POPUP']) {  ?>
			if (<?php echo (isset($this->_rootref['S_NEW_PM'])) ? $this->_rootref['S_NEW_PM'] : ''; ?>)
			{
				var url = '<?php echo (isset($this->_rootref['UA_POPUP_PM'])) ? $this->_rootref['UA_POPUP_PM'] : ''; ?>';
				window.open(url.replace(/&amp;/g, '&'), '_phpbbprivmsg', 'height=225,resizable=yes,scrollbars=yes, width=400');
			}
		<?php } ?>

		/**
		* Find a member
		*/
		function find_username(url)
		{
			popup(url, 960, 570, '_usersearch');
			return false;
		}

		/**
		* New function for handling multiple calls to window.onload and window.unload by pentapenguin
		*/
		window.onload = function()
		{
			for (var i = 0; i < onload_functions.length; i++)
			{
				eval(onload_functions[i]);
			}
		}

		window.onunload = function()
		{
			for (var i = 0; i < onunload_functions.length; i++)
			{
				eval(onunload_functions[i]);
			}
		}

		ddsmoothmenu.init({
                mainmenuid: "smoothmenu1", //menu DIV id
                orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                classname: 'ddsmoothmenu', //class added to menu's outer DIV
                customtheme: ["#2e4e68", "#00192c"],
                contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
        })

	// ]]>
	</script>
	
	<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/forum_fn.js"></script>
</head>
<body id="phpbb" class="section-<?php echo (isset($this->_rootref['SCRIPT_NAME'])) ? $this->_rootref['SCRIPT_NAME'] : ''; ?> <?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>">

	<div id="header-bg">
	<div id="header">
			<div id="header-logo">
                    <a href="/dashboard/index"><img src="/images/logo_small_new.png"/></a>
			</div>
		<div id = "header-menu">
			<?php if ($this->_rootref['HIVE_USER_ROLE'] == ('sa')) {  ?>
			<div id="smoothmenu1" class="ddsmoothmenu" >
				<ul class="navigation">
				    <li>
				        <a href="/dashboard">Home</a>
				    </li>
				    <li>
				        <a href="#">Users</a>
				
				        <ul>
				            <li>
				                <a href="/administration/createacc">Add</a>
				            </li>
				            <li>
				                <a href="/administration/list">List</a>
				            </li>
				        </ul>
				
				    </li>
				    <li>
				        <a href="#">Plant</a>
				        <ul>
				            <li>
				                <a href="/plant/add">Add</a>
				            </li>
				            <li>
				
				                <a href="/plant/list">List</a>
				            </li>
				            <li>
				                <a href="/plant/admin">Admin</a>
				            </li>
				            <li>
				                <a href="/plant/clist">Company Listing</a>
				
				            </li>
				        </ul>
				    </li>
				    <li>
				        <a href="#">Gasturbine</a>
				        <ul>
				            <li>
				                <a href="/gasturbine/add">Add</a>
				
				            </li>
				            <li>
				                <a href="/gasturbine/list">List</a>
				            </li>
				        </ul>
				    </li>
				    <li>
				        <a href="#">Conference</a>
				        <ul>
				            <li>
				
				                <a href="/conference/add">Add</a>
				            </li>
				            <li>
				                <a href="/conference">List</a>
				            </li>
				        </ul>
				    </li>
				    <li>
				        <a href="http://www.hiveusers.com/forums">Forums</a>
				    </li>
				    <li>
				        <a href="/authentication/logout">Logout</a>
				    </li>
				</ul></div> <?php } if ($this->_rootref['HIVE_USER_ROLE'] == ('ca')) {  ?>
					<div id="smoothmenu1" class="ddsmoothmenu" >
<ul class="navigation">
    <li>
        <a href="/dashboard">Home</a>
    </li>
    <li>
        <a href="#">Profile</a>
        <ul>
            <li>

                <a href="/userprofile/view">Personal Details</a>
            </li>
            <li>
                <a href="#">Plant Details</a>
                <ul>
                    <li>
                        <a href="/plant/view">View</a>

                    </li>
                    <li>
                        <a href="/plant/edit">Edit</a>
                    </li>
                    <li>
                        <a href="/plant/clist">Company Listing</a>
                    </li>
                </ul>

            </li>
            <li>
                <a href="/administration/list">Manage Users</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">Gasturbines</a>

        <ul>
            <li>
                <a href="/gasturbine/plantlist">View</a>
            </li>
            <li>
                <a href="/gasturbine/add">Add</a>
            </li>
        </ul>

    </li>
    <li>
        <a href="/conference">Conference</a>
    </li>
    <li>
        <a href="http://www.hiveusers.com/forums">Forums</a>
    </li>
    <li>

        <a href="/authentication/logout">Logout</a>
    </li>
</ul></div>
				
				<?php } if ($this->_rootref['HIVE_USER_ROLE'] == ('us') || $this->_rootref['HIVE_USER_ROLE'] == ('ed')) {  ?>
				<div id="smoothmenu1" class="ddsmoothmenu" >
<ul class="navigation">
    <li>
        <a href="/dashboard">Home</a>
    </li>
    <li>
        <a href="#">Profile</a>
        <ul>
            <li>

                <a href="/userprofile/view">Personal Details</a>
            </li>
            <li>
                <a href="#">Plant Details</a>
                <ul>
                    <li>
                        <a href="/plant/view">View</a>

                    </li>
                    <li>
                        <a href="/plant/edit">Edit</a>
                    </li>
                    <li>
                        <a href="/plant/clist">Company Listing</a>
                    </li>
                </ul>

            </li>
        </ul>
    </li>
    <li>
        <a href="/gasturbine/plantlist">Gasturbines</a>
    </li>
    <li>
        <a href="/conference">Conference</a>

    </li>
    <li>
        <a href="http://www.hiveusers.com/forums">Forums</a>
    </li>
    <li>
        <a href="/authentication/logout">Logout</a>
    </li>
</ul></div><?php } ?>
		</div>
		<div id="search-box-menu" class="search-box">
            <img src="/images/search-form-left.png" alt="search"/>
			<form method="get" action="/search/index">
				<input type="text" size="15" class="search-field" name="keyword" value="Search.." onfocus="if(this.value == 'Search..') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search..';}"/>
				<input type="submit"  value="" class="search-go" />
            </form>
        </div>
	</div>
	</div>
	<div id="wrapper">
	<div id="container">