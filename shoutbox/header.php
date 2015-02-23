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
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id: header.php 0 2010-01-29 18:47:04Z trabis $
 */

include_once dirname(dirname(dirname(__FILE__))) . '/mainfile.php';
include_once XOOPS_ROOT_PATH . '/class/template.php';
error_reporting(0);
$GLOBALS['xoopsLogger']->activated = false;
$xoopsTpl = new XoopsTpl();
$xoopsTpl->xoops_setCaching(0);

$xoopsTpl->assign(
array(
        'xoops_theme' => $xoopsConfig['theme_set'],
        'xoops_imageurl' => XOOPS_THEME_URL.'/'.$xoopsConfig['theme_set'].'/',
        'xoops_themecss'=> xoops_getcss($xoopsConfig['theme_set']),
        'xoops_requesturi' => htmlspecialchars($GLOBALS['xoopsRequestUri'], ENT_QUOTES),
        'xoops_sitename' => htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES),
        'xoops_slogan' => htmlspecialchars($xoopsConfig['slogan'], ENT_QUOTES)
)
);
$xoopsTpl->assign('xoops_js', '<script type="text/javascript" src="'.XOOPS_URL.'/include/xoops.js"></script>');
if (is_object($xoopsUser)) {
    $xoopsTpl->assign(array('xoops_isuser' => true, 'xoops_userid' => $xoopsUser->getVar('uid'), 'xoops_uname' => $xoopsUser->getVar('uname'), 'xoops_isadmin' => $xoopsUserIsAdmin));
} else {
    $xoopsTpl->assign(array('xoops_isuser' => false, 'xoops_isadmin' => false));
}

if (is_file('style/shoutbox.css')) {
    $xoopsTpl->assign('themecss', 'style/shoutbox.css');
} else {
    $xoopsTpl->assign('themecss', xoops_getcss());
}
?>