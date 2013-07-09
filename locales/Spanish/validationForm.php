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

defined('IN_CODE') or die('This script can not be run by itself.');

?><h2>Anti-bot Validaci&oacute;n</h2>

<form method="post" action="register.php">

	<ul class="formlist">

		<li class="formlisttitle">C&oacute;digo Anti-script</li>
		<li class="formlistfield">
		        <img alt="EasyCaptcha image" src="<?php print STATICSRV; ?>contrib/easycaptcha.php" /><br />
		        <input type="text" name="imageText" />
		</li>
		<li class="formlistdesc">
			Para protegernos de spam-bots y otros scripts
		</li>

		<li class="formlisttitle">Correo electr&oacute;nico</li>
		<li class="formlistfield"><input type="text" name="emailValidate" size="50" value="<?php
		        if ( isset($_REQUEST['emailValidate'] ) )
					print $_REQUEST['emailValidate'];
		        ?>"></li>
		<li class="formlistdesc">
			Para asegurarnos que cada jugador dispone de una cuenta de correo real, y asi detener las multicuentas.
			<strong>NO</strong> se usar&aacute; para enviar spam. Solamente para validarte.
		</li>
</ul>

<div class="hr"></div>

<p class="notice">
	<input type="submit" class="form-submit" value="Validarme">
</p>
</form>