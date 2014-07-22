<?php
/***************************************************************************

pseudo-cron v1.2.1
(c) Kai Blankenhorn
www.bitfolge.de/en
kaib@bitfolge.de


This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

***************************************************************************/


/**
* you can use this file to run pseudo-cron even from non-PHP pages
* to do this, place this code somewhere into your page:
* <img src="imagecron.php" width="1" height="1" border="0" alt="">
* when you use the script that way, it's even more important that  your cron jobs
* do not output anything
*/

include("pseudo-cron.inc.php");
Header("Content-Type: image/gif");
Header("Content-Disposition: inline;filename=empty.gif");
echo base64_decode("R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7"); // equivalent of a transparent 1x1px 1bpp GIF file
?>