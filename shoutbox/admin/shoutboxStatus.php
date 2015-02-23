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
 * @version         $Id: shoutboxStatus.php 0 2010-01-29 18:47:04Z trabis $
 */

if (!defined("XOOPS_MAINFILE_INCLUDED") || !strstr($_SERVER['PHP_SELF'], 'admin/main.php')) {
    exit();
}

// Count shouts in database and file
// Database:
$query = $xoopsDB->query("SELECT count(*) FROM ".$xoopsDB->prefix("shoutbox"));
$query = $xoopsDB->fetchRow($query);
$count_database = $query[0];
// File:
$path = XOOPS_ROOT_PATH.'/uploads/shoutbox/shout.csv';
$count_file = count(file($path));

// Size
// Database:
// [Source: http://www.webmasterworld.com/forum88/2069.htm]
$rows = $xoopsDB->queryF("SHOW table STATUS");
while ($row = $xoopsDB->fetchBoth($rows)) {
    if($row['Name'] == $xoopsDB->prefix("shoutbox")) {
        $size_database = $row['Data_length'] + $row['Index_length'];
    }
}
// File:
$size_file = filesize($path);

echo "
<table width='100%' class='outer' cellspacing='1'>
<tbody>
<tr>
<th colspan='2'>"._AM_SH_STATUS_TITLE."</th>
</tr>


<tr valign='top' align='left'>
<td class='odd'>
<b>"._AM_SH_STATUS_STORAGETYPE."</b>
</td>
<td class='even'>
$xoopsModuleConfig[storage_type]
</td>
</tr>
<tr valign='top' align='left'>
<td class='odd'>
<ul>
<li>"._AM_SH_STATUS_INDB."</li>
</ul>
</td>
<td class='even'>
$count_database
</td>
</tr>
<tr valign='top' align='left'>
<td class='odd'>
<ul>
<li>"._AM_SH_STATUS_INFILE."</li>
</ul>
</td>
<td class='even'>
$count_file
</td>
</tr>


<tr valign='top' align='left'>
<td class='odd'>
<b>"._AM_SH_STATUS_SIZEDB."</b>
</td>
<td class='even'>
$size_database bytes
</td>
</tr>
<tr valign='top' align='left'>
<td class='odd'>
<b>"._AM_SH_STATUS_SIZEFILE."</b>
</td>
<td class='even'>
$size_file bytes
</td>
</tr>


<tr class='foot'>
<td colspan='2' align='center'>
&nbsp;
</td>
</tr>
</tbody>
</table>
";
?>