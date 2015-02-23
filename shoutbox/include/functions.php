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
 * @version         $Id: functions.php 0 2010-01-29 18:47:04Z trabis $
 */

function shoutbox_getOption($option, $dirname = 'shoutbox')
{
    static $modOptions = array();
    if (is_array($modOptions) && array_key_exists($option, $modOptions)) {
        return $modOptions[$option];
    }

    $ret = null;
    $module_handler =& xoops_gethandler('module');
    $module =& $module_handler->getByDirname($dirname);
    $config_handler =& xoops_gethandler('config');
    if ($module) {
        $moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
        if (isset($moduleConfig[$option])) {
            $ret = $moduleConfig[$option];
        }
    }
    $modOptions[$option] = $ret;
    return $ret;
}

function shoutbox_makeGuestName()
{
    global $xoopsConfig;
    $ipadd = getenv('REMOTE_ADDR');
    $iparr = explode('.', $ipadd);
    $ipadd = $iparr[0] + $iparr[1] + $iparr[2] + $iparr[3];
    $guestname = $xoopsConfig['anonymous'] . $ipadd;
    return $guestname;
}

function shoutbox_getUserName($uid = 0)
{
    xoops_load('XoopsUserUtility');
    $uname = XoopsUserUtility::getUnameFromId($uid, shoutbox_getOption('user_realname'));
    return $uname;
}

/**
 * Most of these functions were written (originally)
 * by Florian Solcher <e-xoops.alphalogic.org>
 */
function shoutbox_setCookie($timestamp)
{
    if (empty($_COOKIE['shoutcookie'])) {
        setcookie("shoutcookie", $timestamp);
        return false;
    }

    if ($_COOKIE['shoutcookie'] < $timestamp) {
        setcookie("shoutcookie", $timestamp);
        return TRUE;
    } else {
        return FALSE;
    }
}

//irc like commands
function shoutbox_ircLike($command)
{
    global $xoopsModuleConfig, $xoopsUser, $special_stuff_head;
    if ($command == "/quit") {
        $special_stuff_head .= '<script language="javascript">';
        $special_stuff_head .= '    top.window.close();';
        $special_stuff_head .= '</script>';
        return true;
    }
    $commandlines=explode(' ',$command);
    if (is_array($commandlines)) {
        //general commands
        //unregistered commands
        if (!$xoopsUser) {
            if (count($commandlines)==2) {
                if (($commandlines[0]=='/nick') && ($commandlines[1]!='')) {
                    if($xoopsModuleConfig['guests_may_chname'] == 1) {
                        $special_stuff_head .= '<script language="javascript">';
                        $special_stuff_head .= '    top.document.location.href="popup.php?username='.htmlentities($commandlines[1], ENT_QUOTES).'";';
                        $special_stuff_head .= '</script>';
                        return true;
                    } else {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}
?>