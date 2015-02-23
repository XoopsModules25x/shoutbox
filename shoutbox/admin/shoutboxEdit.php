<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright       The XUUPS Project http://sourceforge.net/projects/xuups/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         Shoutbox
 * @author          Alphalogic <alphafake@hotmail.com>
 * @author          tank <tanksplace@comcast.net>
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id: shoutboxEdit.php 0 2010-01-29 18:47:04Z trabis $
 */

if (!defined("XOOPS_MAINFILE_INCLUDED") || !strstr($_SERVER['PHP_SELF'], 'admin/main.php')) {
    exit();
}

include_once XOOPS_ROOT_PATH.'/class/module.textsanitizer.php';

$sanitizer = new MyTextSanitizer;

// Check or ID is a number
$id = intval($_GET['id']);

$handler = xoops_getModuleHandler('database', 'shoutbox');

// Check or we got a shout
if (!$obj = $handler->get($id)) {
    /**
     * Or we got none, or something really strange happend here...
     */
    redirect_header("index.php", 3, _AM_SH_INVALID_ID);
}


// Make code ready for preview
$shout = $obj->getValues();
$shout['date'] = $obj->time(_DATESTRING);

echo "
<form action='index.php?op=shoutboxSave' method='post'>
<table width='100%' class='outer' cellspacing='1'>
<tbody>
<tr>
<th colspan='2'>".sprintf(_AM_SH_EDIT_TITLE, $shout['date'])."</th>
</tr>
<tr valign='top' align='left'>
<td class='odd'>
<b>"._AM_SH_POSTER."</b>
</td>
<td class='even'>\n";

if($shout['uid'] != 0) {
    echo "<input type='text' size='30' maxlength='30' name='shoutboxUname' value='$shout[uname]' readonly='readonly' />";
} else {
    echo "<input type='text' size='30' maxlength='30' name='shoutboxUname' value='$shout[uname]' />";
}
echo "
</td>
</tr>
<tr valign='top' align='left'>
<td class='odd'>
<b>"._AM_SH_EDIT_FROM."</b>
</td>
<td class='even'>
<input type='text' size='30' maxlength='30' name='shoutboxIp' value='$shout[ip]' />
</td>
</tr>
<tr valign='top' align='left'>
<td class='odd'>
<b>"._AM_SH_MESSAGE."</b>
</td>
<td class='even'>
<input type='text' name='shoutboxMessage' size='100' maxlength='200' value='$shout[message]' />
</td>
</tr>
<tr class='foot'>
<td colspan='2' align='center'>
<input type='hidden' name='id' value='$shout[id]' />
<input type='hidden' name='uid' value='$shout[uid]' />

<input type='submit' name='submit' value='"._SUBMIT."' />
<input type='button' value='"._CANCEL."' onClick='location=\"index.php?op=shoutboxList\"' />
</td>
</tr>
</tbody>
</table>
</form>
";
?>