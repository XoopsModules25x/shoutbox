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
 */

if (!defined('XOOPS_MAINFILE_INCLUDED') || false === strpos($_SERVER['PHP_SELF'], 'admin/main.php')) {
    exit();
}

require_once XOOPS_ROOT_PATH . '/class/module.textsanitizer.php';
$sanitizer = new MyTextSanitizer;

echo "<h4 style='text-align: left;'>" . _AM_SH_CONFIG . "</h4>\n";
echo "
<table class='outer' width='100%' cellpadding='4' cellspacing='1'>
<tr>
<th width='15%' align='left'>" . _AM_SH_POSTER . "</th>
<th width='15%' align='left'>" . _AM_SH_LIST_TIME . "</th>
<th width='55%' align='center'>" . _AM_SH_MESSAGE . "</th>
<th width='15%' align='right'>" . _AM_SH_LIST_ACTION . "</th>
</tr>\n";

$evodd  = 'even';
$result = $xoopsDB->query('SELECT `id`, `uid`, `uname`, `time`, `ip`, `message` FROM ' . $xoopsDB->prefix('shoutbox') . ' ORDER BY `time` DESC LIMIT 0, 50');

if (!$xoopsDB->getRowsNum($result)) {
    echo "<tr class='even' align='center'><td colspan='4'>" . _AM_SH_LIST_NOSHOUTS . '</td></tr>';
}

while (list($msg_id, $user_id, $uname, $time, $ip, $message) = $xoopsDB->fetchRow($result)) {
    if ($evodd === 'even') {
        echo "<tr class='even' align='center' valign='top'>\n";
    } else {
        echo "<tr class='even' align='center' valign='top'>\n";
    }

    echo "<td align='left'>
    <div title='UID: $user_id | IP: $ip'>$uname";
    if ($user_id == 0) {
        echo '*';
    }
    echo "</div>
    </td>
    <td align='left'>
    " . formatTimestamp($time, _DATESTRING) . "
    </td>
    <td align='center'>
    $message
    </td>
    <td align='right'>
    <a href='main.php?op=shoutboxEdit&amp;id=$msg_id'>" . _EDIT . "</a> / <a href='main.php?op=shoutboxRemove&amp;id=$msg_id'>" . _DELETE . '</a>
    </td>';

    echo '</tr>';
}

echo "<tr class='foot'><td colspan='4'>&nbsp;</td></tr></table>";
