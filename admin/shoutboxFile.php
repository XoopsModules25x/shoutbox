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
 * @version         $Id: shoutboxFile.php 0 2010-01-29 18:47:04Z trabis $
 */

if (!defined("XOOPS_MAINFILE_INCLUDED") || !strstr($_SERVER['PHP_SELF'], 'admin/main.php')) {
    exit();
}

include_once XOOPS_ROOT_PATH . '/class/module.textsanitizer.php';
$sanitizer = MyTextSanitizer::getInstance();

$path = XOOPS_ROOT_PATH . '/uploads/shoutbox/shout.csv';
$source = file_get_contents($path);
$source = $sanitizer->htmlSpecialChars($source);
$hash = sha1_file($path);
$invalidhash = false;

if (!empty($_POST['action']) && $_POST['action'] == 'Update') {
    if (empty($_POST['forceUpdate']) && $hash != $_POST['hash']) {
        echo "<h1>" . _AM_SH_FILE_HASH_FAILED . "</h1>";
        $invalidhash = true;
        $source = $sanitizer->stripSlashesGPC($_POST['shoutboxSource']);
        $source = $sanitizer->htmlSpecialChars($source);
    } else {
        $source = $sanitizer->stripSlashesGPC($_POST['shoutboxSource']);

        if ($file = fopen($path, "w")) {
            fwrite($file, $source);
            fclose($file);
            echo "<h1>"._AM_SH_FILE_UPDATED."</h1>";
        } else {
            echo "<h1>"._AM_SH_FILE_FAILED."</h1>";
        }
    }
}

echo "
<form action='index.php?op=shoutboxFile' method='post'>
<table width='100%' class='outer' cellspacing='1'>
<tbody>
<tr>
<th colspan='2'>"._AM_SH_FILE_TITLE."</th>
</tr>
<tr valign='top' align='left'>
<td class='odd' width='20%'>
<b>"._AM_SH_FILE_SOURCE."</b><br />
"._AM_SH_FILE_SOURCED."
</td>
<td class='even'>
<textarea name='shoutboxSource' rows='25' cols='98%'>$source</textarea>
</td>
</tr>";

if ($invalidhash == true) {
    echo "
    <tr valign='top' align='left'>
    <td class='odd' width='20%'>
    <b>"._AM_SH_FILE_HASH."</b><br />
    "._AM_SH_FILE_HASHD."
    </td>
    <td class='even'>
    <input type='checkbox' name='forceUpdate' value='yes' checked='checked' />
    </td>
    </tr>
    ";
}

echo "
<tr class='foot'>
<td colspan='2' align='center'>
<input type='hidden' name='hash' value='$hash' />
<input type='hidden' name='action' value='Update' />
<input type='submit' name='submit' value='"._SUBMIT."' />
</td>
</tr>
<tbody>
</table>
</form>";
