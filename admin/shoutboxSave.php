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

$handler = xoops_getModuleHandler('database', 'shoutbox');

$id = (int)$_POST['id'];
if (!$obj = $handler->get($id)) {
    /**
     * Or we got none, or something really strange happend here...
     */
    redirect_header('index.php', 3, _AM_SH_INVALID_ID);
}

if (!preg_match('/^[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}$/', $_POST['shoutboxIp'])) {
    // This check is far from perfect but...
    exit('Whoops! [ERROR 24]');
}

$obj->setVar('uname', $_POST['shoutboxUname']);
$obj->setVar('ip', $_POST['shoutboxIp']);
$obj->setVar('message', $_POST['shoutboxMessage']);

// Execute query
if ($handler->insert($obj)) {
    redirect_header('index.php', 2, 'Shout updated!');
} else {
    redirect_header('index.php', 4, 'Error - Could not execute query...');
}
