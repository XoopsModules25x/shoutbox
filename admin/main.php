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
// Hello admin?
require_once __DIR__ . '/../../../include/cp_header.php';
require_once __DIR__ . '/admin_header.php';
// Admin!

function shoutboxDefault()
{
    global $xoopsModuleConfig;

    if ($xoopsModuleConfig['storage_type'] === 'database') {
        $database = '[' . _AM_SH_EDIT_INUSE . ']';
        $file     = '';
    } elseif ($xoopsModuleConfig['storage_type'] === 'file') {
        $database = '';
        $file     = '[' . _AM_SH_EDIT_INUSE . ']';
    }

    echo '
    <h1>' . _AM_SH_CONFIG . '</h1>
    <br>
    ' . _AM_SH_CHOOSE . "
    <ul>
    <li><a href='main.php?op=shoutboxList'>" . _AM_SH_EDIT_DB . "</a> $database</li>
    <li><a href='main.php?op=shoutboxFile'>" . _AM_SH_EDIT_FILE . "</a> $file</li>
    <li><a href='main.php?op=shoutboxStatus'>" . _AM_SH_STATUSOF . '</a></li>
    </ul>
    <br>
    ';
}

function shoutboxList()
{
    global $xoopsDB;
    include __DIR__ . '/shoutboxList.php';
}

function shoutboxEdit()
{
    global $xoopsDB;
    include __DIR__ . '/shoutboxEdit.php';
}

function shoutboxSave()
{
    global $xoopsDB;
    include __DIR__ . '/shoutboxSave.php';
}

function shoutboxRemove()
{
    global $xoopsDB;
    include __DIR__ . '/shoutboxRemove.php';
}

function shoutboxFile()
{
    global $xoopsDB;
    include __DIR__ . '/shoutboxFile.php';
}

function shoutboxStatus()
{
    global $xoopsDB, $xoopsModuleConfig;
    include __DIR__ . '/shoutboxStatus.php';
}

$op = empty($_GET['op']) ? '' : $_GET['op'];

switch ($op) {
    case 'shoutboxList':
        xoops_cp_header();
        $adminObject  = \Xmf\Module\Admin::getInstance();
        $adminObject->displayNavigation('main.php?op=shoutboxList');
        shoutboxList();
        break;

    case 'shoutboxEdit':
        xoops_cp_header();
        $adminObject  = \Xmf\Module\Admin::getInstance();
        $adminObject->displayNavigation(basename(__FILE__));
        shoutboxEdit();
        break;

    case 'shoutboxSave':
        shoutboxSave();
        break;

    case 'shoutboxRemove':
        shoutboxRemove();
        break;

    case 'shoutboxFile':
        xoops_cp_header();
        $adminObject  = \Xmf\Module\Admin::getInstance();
        $adminObject->displayNavigation('main.php?op=shoutboxFile');
        shoutboxFile();
        break;

    case 'shoutboxStatus':
        xoops_cp_header();
        $adminObject  = \Xmf\Module\Admin::getInstance();
        $adminObject->displayNavigation('main.php?op=shoutboxStatus');
        shoutboxStatus();
        break;

    default:
        xoops_cp_header();
        $adminObject  = \Xmf\Module\Admin::getInstance();
        $adminObject->displayNavigation(basename(__FILE__));
        shoutboxDefault();
        break;

}
require_once __DIR__ . '/admin_footer.php';
//xoops_cp_footer();
//
