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

require_once __DIR__ . '/header.php';

$onlineHandler = xoops_getHandler('online');
// set gc probabillity to 10% for now..
if (mt_rand(1, 100) < 11) {
    $onlineHandler->gc(300);
}
if (is_object($xoopsUser)) {
    $uid   = $xoopsUser->getVar('uid');
    $uname = $xoopsUser->getVar('uname');
} else {
    $uid   = 0;
    $uname = '';
}

$onlineHandler->write($uid, $uname, time(), $xoopsModule->getVar('mid'), $_SERVER['REMOTE_ADDR']);

$start          = isset($_GET['start']) ? (int)$_GET['start'] : 0;
$onlineHandler = xoops_getHandler('online');
$online_total   = $onlineHandler->getCount();
$limit          = ($online_total > 2) ? 20 : $online_total;
$criteria       = new CriteriaCompo();
$criteria->setLimit($limit);
$criteria->setStart($start);
$onlines         = $onlineHandler->getAll($criteria);
$count           = count($onlines);
$anonymous_count = 0;
for ($i = 0; $i < $count; ++$i) {
    if ($onlines[$i]['online_uid'] == 0) {
        $onlineUsers[$i]['uname'] = $xoopsConfig['anonymous'];
        $onlineUsers[$i]['uid']   = 0;
        ++$anonymous_count;
    } else {
        $thisUser                 = new XoopsUser($onlines[$i]['online_uid']);
        $onlineUsers[$i]['uname'] = $thisUser->getVar('uname');
        $onlineUsers[$i]['uid']   = $thisUser->getVar('uid');
    }
}

if ($online_total > 20) {
    require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
    $nav = new XoopsPageNav($online_total, 20, $start, 'start', '');
    $xoopsTpl->assign('online_navigation', $nav->renderNav());
}

$xoopsTpl->assign('users', $onlineUsers);
$xoopsTpl->assign('anonymous_count', $anonymous_count);
$xoopsTpl->assign('online_total', $online_total);

$xoopsTpl->xoops_setCaching(0);
$xoopsTpl->display('db:shoutbox_online.tpl');
