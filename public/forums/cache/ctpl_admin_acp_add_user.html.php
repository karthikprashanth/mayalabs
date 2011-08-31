<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>

<!--
/**
* @author Rich McGirr (RMcGirr83) http://phpbbmodders.net
* @author David Lewis (Highway of Life) http://phpbbacademy.com
*
* @package acp
* @version $Id:
* @copyright (c) 2011 phpBB Modders
* @copyright (c) 2007 Star Trek Guide Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
//-->

	<h1><?php echo ((isset($this->_rootref['L_ADD_USER'])) ? $this->_rootref['L_ADD_USER'] : ((isset($user->lang['ADD_USER'])) ? $user->lang['ADD_USER'] : '{ ADD_USER }')); ?></h1>
	<p><?php echo ((isset($this->_rootref['L_ADD_USER_EXPLAIN'])) ? $this->_rootref['L_ADD_USER_EXPLAIN'] : ((isset($user->lang['ADD_USER_EXPLAIN'])) ? $user->lang['ADD_USER_EXPLAIN'] : '{ ADD_USER_EXPLAIN }')); ?></p>

	<form id="register" method="post" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
	
<?php if ($this->_rootref['ERROR']) {  ?>

	<div class="errorbox"><h3><?php echo ((isset($this->_rootref['L_WARNING'])) ? $this->_rootref['L_WARNING'] : ((isset($user->lang['WARNING'])) ? $user->lang['WARNING'] : '{ WARNING }')); ?></h3>
		<p><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></p>
		</div>
<?php } ?>


<fieldset>
	<legend><?php echo ((isset($this->_rootref['L_REGISTRATION'])) ? $this->_rootref['L_REGISTRATION'] : ((isset($user->lang['REGISTRATION'])) ? $user->lang['REGISTRATION'] : '{ REGISTRATION }')); ?></legend>
    <p><?php echo ((isset($this->_rootref['L_REG_COND'])) ? $this->_rootref['L_REG_COND'] : ((isset($user->lang['REG_COND'])) ? $user->lang['REG_COND'] : '{ REG_COND }')); ?></p>
	<dl>
		<dt><label for="username"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>:</label>
			<br /><span><?php echo ((isset($this->_rootref['L_USERNAME_EXPLAIN'])) ? $this->_rootref['L_USERNAME_EXPLAIN'] : ((isset($user->lang['USERNAME_EXPLAIN'])) ? $user->lang['USERNAME_EXPLAIN'] : '{ USERNAME_EXPLAIN }')); ?></span></dt>
		<dd><input class="medium" type="text" id="username" name="username" size="25" maxlength="40" value="<?php echo (isset($this->_rootref['NEW_USERNAME'])) ? $this->_rootref['NEW_USERNAME'] : ''; ?>" /></dd>
	</dl>
	<dl>
		<dt><label for="email"><?php echo ((isset($this->_rootref['L_EMAIL_ADDRESS'])) ? $this->_rootref['L_EMAIL_ADDRESS'] : ((isset($user->lang['EMAIL_ADDRESS'])) ? $user->lang['EMAIL_ADDRESS'] : '{ EMAIL_ADDRESS }')); ?>:</label></dt>
		<dd><input class="medium" type="text" name="email" id="email" size="25" maxlength="255" value="<?php echo (isset($this->_rootref['EMAIL'])) ? $this->_rootref['EMAIL'] : ''; ?>" /></dd>
	</dl>
	<dl>
		<dt><label for="email_confirm"><?php echo ((isset($this->_rootref['L_CONFIRM_EMAIL'])) ? $this->_rootref['L_CONFIRM_EMAIL'] : ((isset($user->lang['CONFIRM_EMAIL'])) ? $user->lang['CONFIRM_EMAIL'] : '{ CONFIRM_EMAIL }')); ?>:</label></dt>
		<dd><input class="medium" type="text" name="email_confirm" id="email_confirm" size="25" maxlength="255" value="<?php echo (isset($this->_rootref['EMAIL_CONFIRM'])) ? $this->_rootref['EMAIL_CONFIRM'] : ''; ?>" /></dd>
	</dl>
	<dl>
		<dt><label for="new_password"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>:</label><br /><span><?php echo ((isset($this->_rootref['L_PASSWORD_EXPLAIN'])) ? $this->_rootref['L_PASSWORD_EXPLAIN'] : ((isset($user->lang['PASSWORD_EXPLAIN'])) ? $user->lang['PASSWORD_EXPLAIN'] : '{ PASSWORD_EXPLAIN }')); ?></span></dt>
		<dd><input type="password" name="new_password" id="new_password" size="25" value="<?php echo (isset($this->_rootref['PASSWORD'])) ? $this->_rootref['PASSWORD'] : ''; ?>" class="inputbox autowidth" title="<?php echo ((isset($this->_rootref['L_NEW_PASSWORD'])) ? $this->_rootref['L_NEW_PASSWORD'] : ((isset($user->lang['NEW_PASSWORD'])) ? $user->lang['NEW_PASSWORD'] : '{ NEW_PASSWORD }')); ?>" /></dd>
	</dl>
	<dl>
		<dt><label for="password_confirm"><?php echo ((isset($this->_rootref['L_CONFIRM_PASSWORD'])) ? $this->_rootref['L_CONFIRM_PASSWORD'] : ((isset($user->lang['CONFIRM_PASSWORD'])) ? $user->lang['CONFIRM_PASSWORD'] : '{ CONFIRM_PASSWORD }')); ?>:</label></dt>
		<dd><input type="password" name="password_confirm" id="password_confirm" size="25" value="<?php echo (isset($this->_rootref['PASSWORD_CONFIRM'])) ? $this->_rootref['PASSWORD_CONFIRM'] : ''; ?>" class="inputbox autowidth" title="<?php echo ((isset($this->_rootref['L_CONFIRM_PASSWORD'])) ? $this->_rootref['L_CONFIRM_PASSWORD'] : ((isset($user->lang['CONFIRM_PASSWORD'])) ? $user->lang['CONFIRM_PASSWORD'] : '{ CONFIRM_PASSWORD }')); ?>" /></dd>
	</dl>
	<dl>
		<dt><label for="lang"><?php echo ((isset($this->_rootref['L_LANGUAGE'])) ? $this->_rootref['L_LANGUAGE'] : ((isset($user->lang['LANGUAGE'])) ? $user->lang['LANGUAGE'] : '{ LANGUAGE }')); ?>:</label></dt>
		<dd><select name="lang" id="lang"><?php echo (isset($this->_rootref['S_LANG_OPTIONS'])) ? $this->_rootref['S_LANG_OPTIONS'] : ''; ?></select></dd>
	</dl>
	<dl>
		<dt><label for="tz"><?php echo ((isset($this->_rootref['L_TIMEZONE'])) ? $this->_rootref['L_TIMEZONE'] : ((isset($user->lang['TIMEZONE'])) ? $user->lang['TIMEZONE'] : '{ TIMEZONE }')); ?>:</label></dt>
		<dd><select name="tz" id="tz"><?php echo (isset($this->_rootref['S_TZ_OPTIONS'])) ? $this->_rootref['S_TZ_OPTIONS'] : ''; ?></select></dd>
	</dl>
	<?php if ($this->_rootref['S_BIRTHDAYS_ENABLED']) {  ?>

	<dl> 
		<dt><label for="birthday"><?php echo ((isset($this->_rootref['L_BIRTHDAY'])) ? $this->_rootref['L_BIRTHDAY'] : ((isset($user->lang['BIRTHDAY'])) ? $user->lang['BIRTHDAY'] : '{ BIRTHDAY }')); ?>:</label><br /><span><?php echo ((isset($this->_rootref['L_BIRTHDAY_EXPLAIN'])) ? $this->_rootref['L_BIRTHDAY_EXPLAIN'] : ((isset($user->lang['BIRTHDAY_EXPLAIN'])) ? $user->lang['BIRTHDAY_EXPLAIN'] : '{ BIRTHDAY_EXPLAIN }')); ?></span></dt>
		<dd><?php echo ((isset($this->_rootref['L_DAY'])) ? $this->_rootref['L_DAY'] : ((isset($user->lang['DAY'])) ? $user->lang['DAY'] : '{ DAY }')); ?>: <select id="birthday" name="bday_day"><?php echo (isset($this->_rootref['S_BIRTHDAY_DAY_OPTIONS'])) ? $this->_rootref['S_BIRTHDAY_DAY_OPTIONS'] : ''; ?></select> <?php echo ((isset($this->_rootref['L_MONTH'])) ? $this->_rootref['L_MONTH'] : ((isset($user->lang['MONTH'])) ? $user->lang['MONTH'] : '{ MONTH }')); ?>: <select name="bday_month"><?php echo (isset($this->_rootref['S_BIRTHDAY_MONTH_OPTIONS'])) ? $this->_rootref['S_BIRTHDAY_MONTH_OPTIONS'] : ''; ?></select> <?php echo ((isset($this->_rootref['L_YEAR'])) ? $this->_rootref['L_YEAR'] : ((isset($user->lang['YEAR'])) ? $user->lang['YEAR'] : '{ YEAR }')); ?>: <select name="bday_year"><?php echo (isset($this->_rootref['S_BIRTHDAY_YEAR_OPTIONS'])) ? $this->_rootref['S_BIRTHDAY_YEAR_OPTIONS'] : ''; ?></select></dd>
	</dl>
	<?php } if ($this->_rootref['S_ADMIN_ACTIVATE']) {  ?>

	<dl>
		<dt><label for="admin_activate"><?php echo ((isset($this->_rootref['L_ADMIN_ACTIVATE'])) ? $this->_rootref['L_ADMIN_ACTIVATE'] : ((isset($user->lang['ADMIN_ACTIVATE'])) ? $user->lang['ADMIN_ACTIVATE'] : '{ ADMIN_ACTIVATE }')); ?>:</label></dt>
		<dd><input id="admin_activate" class="radio" type="checkbox" value="1"<?php echo (isset($this->_rootref['U_ADMIN_ACTIVATE'])) ? $this->_rootref['U_ADMIN_ACTIVATE'] : ''; ?> name="activate" /></dd>
	</dl>
	<?php } ?>

</fieldset>

	<?php if (sizeof($this->_tpldata['profile_fields'])) {  ?>

		<fieldset>
			<legend><?php echo ((isset($this->_rootref['L_USER_CUSTOM_PROFILE_FIELDS'])) ? $this->_rootref['L_USER_CUSTOM_PROFILE_FIELDS'] : ((isset($user->lang['USER_CUSTOM_PROFILE_FIELDS'])) ? $user->lang['USER_CUSTOM_PROFILE_FIELDS'] : '{ USER_CUSTOM_PROFILE_FIELDS }')); ?></legend>		
		<dl>
			<dt><label><?php echo ((isset($this->_rootref['L_ITEMS_REQUIRED'])) ? $this->_rootref['L_ITEMS_REQUIRED'] : ((isset($user->lang['ITEMS_REQUIRED'])) ? $user->lang['ITEMS_REQUIRED'] : '{ ITEMS_REQUIRED }')); ?></label></dt>
		</dl>			
		<?php $_profile_fields_count = (isset($this->_tpldata['profile_fields'])) ? sizeof($this->_tpldata['profile_fields']) : 0;if ($_profile_fields_count) {for ($_profile_fields_i = 0; $_profile_fields_i < $_profile_fields_count; ++$_profile_fields_i){$_profile_fields_val = &$this->_tpldata['profile_fields'][$_profile_fields_i]; ?>

		<dl> 
			<dt><label<?php if ($_profile_fields_val['FIELD_ID']) {  ?> for="<?php echo $_profile_fields_val['FIELD_ID']; ?>"<?php } ?>><?php echo $_profile_fields_val['LANG_NAME']; ?>:<?php if ($_profile_fields_val['S_REQUIRED']) {  ?> *<?php } ?></label>
			<?php if ($_profile_fields_val['LANG_EXPLAIN']) {  ?><br /><span><?php echo $_profile_fields_val['LANG_EXPLAIN']; ?></span><?php } if ($_profile_fields_val['ERROR']) {  ?><br /><span class="error"><?php echo $_profile_fields_val['ERROR']; ?></span><?php } ?></dt>
			<dd><?php echo $_profile_fields_val['FIELD']; ?></dd>
		</dl>
		<?php }} ?>

		</fieldset>
	<?php } ?>


	<fieldset class="quick">
		<input class="button1" type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;&nbsp;<input class="button1" type="reset" value="<?php echo ((isset($this->_rootref['L_RESET'])) ? $this->_rootref['L_RESET'] : ((isset($user->lang['RESET'])) ? $user->lang['RESET'] : '{ RESET }')); ?>" name="reset" />
		<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

	</fieldset>

</form>

<?php $this->_tpl_include('overall_footer.html'); ?>