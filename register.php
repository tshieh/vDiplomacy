<?php
/*
    Copyright (C) 2004-2010 Kestas J. Kuliukas

	This file is part of webDiplomacy.

    webDiplomacy is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    webDiplomacy is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with webDiplomacy.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * @package Base
 * @subpackage Forms
 */

require_once('header.php');

require_once(l_r('objects/mailer.php'));
global $Mailer;
$Mailer = new Mailer();

if ( $Misc->Panic )
{
	libHTML::notice(l_t('Registration disabled'),
		l_t("Registration has been temporarily disabled while we take care of an ".
		"unexpected problem. Please try again later, sorry for the inconvenience."));
}

// The user must be guest to register a new account
if( $User->type['User'] )
{
	libHTML::error(l_t("You're attempting to create a ".
		"new user account when you already have one. Please use ".
		"your existing user account."));
}

libHTML::starthtml();

$page = '';

try
{
	$page = 'userForm';

	// The user's e-mail is authenticated; he's not a robot and he has a real e-mail address
	// Let him through to the form, or process his form if he has one
	if ( isset($_REQUEST['userForm']) )
	{

		// If the form is accepted the script will end within here.
		// If it isn't accepted they will be shown back to the userForm page
		require_once(l_r('register/processUserForm.php'));
	}
	else
	{
		$page = 'firstUserForm';
	}
}
catch( Exception $e)
{
	print '<div class="content">';
	print '<p class="notice">'.$e->getMessage().'</p>';
	print '</div>';
}


switch($page)
{
	case 'firstValidationForm':
	case 'validationForm':
		print libHTML::pageTitle(l_t('Register a webDiplomacy account'),l_t('<strong>Pass anti-bot test</strong> -&gt; Enter your account settings -&gt; Play webDiplomacy!'));
		break;
	case 'firstUserForm':
	case 'userForm':
		print libHTML::pageTitle(l_t('Register a webDiplomacy account'),l_t('Pass anti-bot test -&gt; <strong>Enter your account settings</strong> -&gt; Play webDiplomacy!'));
}

switch($page)
{
	case 'firstValidationForm':

		print '<h2>'.l_t('Welcome to vDiplomacyTest!').'</h2>';
		print '<p>'.l_t('So that we can all enjoy fun, fair games we need to quickly double check that '.
				'you\'re a human and that you have an e-mail address. It only takes a moment '.
				'and it keeps the server free of spam! :-)').'</p>';


	case 'validationForm':

		require_once(l_r('locales/English/validationForm.php'));

		break;


	case 'firstUserForm':

		print "<p>".l_t("<p>Enter the username and password you want, and any of the optional details/settings, into the screen below to
			complete the registration process.")."</p>";

	case 'userForm':
		print '<form method="post"><ul class="formlist">';

		require_once(l_r('locales/English/userRegister.php'));
		require_once(l_r('locales/English/user.php'));

		break;

}

print '</div>';
libHTML::footer();
?>

