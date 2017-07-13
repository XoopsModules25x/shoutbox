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



$moduleDirName = basename(dirname(__DIR__));

if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}
$adminObject = \Xmf\Module\Admin::getInstance();

$pathIcon32    = \Xmf\Module\Admin::menuIconPath('');
//$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

$moduleHelper->loadLanguage('modinfo');

$adminObject              = array();
$i                      = 0;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_HOME;
$adminmenu[$i]['link']  = 'admin/index.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/home.png';
//++$i;
//$adminmenu[$i]['title'] = _AM_MODULEADMIN_HOME;
//$adminmenu[$i]['link'] = "admin/main.php";
//$adminmenu[$i]["icon"]  = $pathIcon32 . '/manage.png';
++$i;
$adminmenu[$i]['title'] = _MI_SHOUTBOX_MENU_DB;
$adminmenu[$i]['link']  = 'admin/main.php?op=shoutboxList';
$adminmenu[$i]['icon']  = $pathIcon32 . '/list.png';
++$i;
$adminmenu[$i]['title'] = _MI_SHOUTBOX_MENU_FILE;
$adminmenu[$i]['link']  = 'admin/main.php?op=shoutboxFile';
$adminmenu[$i]['icon']  = $pathIcon32 . '/index.png';
++$i;
$adminmenu[$i]['title'] = _MI_SHOUTBOX_MENU_STATUS;
$adminmenu[$i]['link']  = 'admin/main.php?op=shoutboxStatus';
$adminmenu[$i]['icon']  = $pathIcon32 . '/search.png';
++$i;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/about.png';
