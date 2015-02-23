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
 * @version         $Id: shoutbox.php 0 2010-01-29 18:47:04Z trabis $
 */

include_once dirname(dirname(__FILE__)) . '/include/functions.php';

class Shoutbox
{
    var $handler = '';

    function Shoutbox($storage_type)
    {
        $this->handler =& xoops_getModuleHandler($storage_type, 'shoutbox');
    }

    function getDefaultAvatar()
    {
        if ($value = shoutbox_getOption('guest_avatar')) {
            $avatar = XOOPS_URL . "/modules/shoutbox/images/guestavatars/guest" . $value . ".gif";
        } else {
            $avatar = XOOPS_URL . '/uploags/blank.gif';
        }
        return $avatar;
    }

    function saveShout($uid, $uname, $message)
    {
        $myts =& MyTextSanitizer::getInstance();
        $obj = $this->handler->createShout();
        $obj->setVar('uid', $uid);
        $obj->setVar('uname', $uname);
        $obj->setVar('time', time());
        $obj->setVar('ip', getenv("REMOTE_ADDR"));
        $obj->setVar('message', $message);

        if (!$this->handler->saveShout($obj)) {
            return false;
        }

        return true;
    }

    function getShouts($online, $bbcode, $limit)
    {
        global $xoopsUser;
        $shouts = array();
        $myts =& MyTextSanitizer::getInstance();
        $objs = $this->handler->getShouts($limit);
        $i = 0;
        foreach ($objs as $obj) {
            $uid = $obj->getVar('uid');
            $shouts[$i]['uid'] = $uid;
            $shouts[$i]['online'] = 0;
            $shouts[$i]['url'] = '';
            $shouts[$i]['email'] = '';
            $shouts[$i]['avatar'] = $this->getDefaultAvatar();
            $shouts[$i]['uname'] = $obj->getVar('uname');
            $shouts[$i]['time'] = $obj->time(shoutbox_getOption('stamp_format'));
            $shouts[$i]['ip'] = $obj->getVar('ip');

            $obj->setVar('doxcode', $bbcode);

            $shouts[$i]['message'] = $myts->censorString($obj->getVar('message'));
            if ($wordwrap = shoutbox_getOption('wordwrap_setting')) {
                $shouts[$i]['message'] = wordwrap($shouts[$i]['message'], $wordwrap ,"\r\n", true);
            }

            if ($uid != 0) {
                $thisUser = new XoopsUser($uid);
                if ($thisUser->isOnline()) {
                    $shouts[$i]['online'] = 1;
                }
                if ($thisUser->getVar("url") != "") {
                    $shouts[$i]['url'] = $thisUser->getVar("url");
                }
                if ($thisUser->getVar("user_viewemail") == 1 || ($xoopsUser && $xoopsUser->isAdmin())) {
                    $shouts[$i]['email'] = $thisUser->getVar("email");
                }
                $shouts[$i]['avatar'] = XOOPS_URL . '/uploads/' . $thisUser->getVar("user_avatar");
            }
            $i++;
        }
        return $shouts;
    }

    function pruneShouts($limit)
    {
        if ($limit > 0) {
            return $this->handler->pruneShouts($limit);
        }
        return false;
    }

    function deleteShouts()
    {
        global $xoopsUser;
        if (!empty($xoopsUser) && $xoopsUser->isAdmin()) {
            return $this->handler->deleteShouts();
        }
        return false;
    }

    function shoutExists($message)
    {
        return $this->handler->shoutExists($message, getenv("REMOTE_ADDR"));
    }

}
?>