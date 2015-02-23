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

function b_shoutbox_show($options)
{
    include_once XOOPS_ROOT_PATH . '/modules/shoutbox/include/functions.php';
    global $xoopsUser, $xoopsConfig;

    $module_handler =& xoops_gethandler('module');
    $module =& $module_handler->getByDirname('shoutbox');
    $config_handler =& xoops_gethandler('config');
    $block =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

    if ($block['captcha_enable']) {
        xoops_load('XoopsFormCaptcha');
        $shoutcaptcha = new XoopsFormCaptcha();
        $block['captcha_caption'] = $shoutcaptcha->getCaption();
        $block['captcha_render'] = $shoutcaptcha->render();
    }

    $block['shoutbox_access'] = false;
    if (is_object($xoopsUser)) {
        $block['shoutbox_access'] = true;
        $block['shoutbox_uname'] = $xoopsUser->getVar('uname');
        $block['shoutbox_userid'] = $xoopsUser->getVar('uid');
    } else if ($block['guests_may_post']) {
        $block['shoutbox_access'] = true;
        $block['shoutbox_uname'] = shoutbox_makeGuestName();
        $block['shoutbox_uid'] = 0;
    }

    $block['shoutbox_anonymous'] = $xoopsConfig['anonymous'];

    if ($block['show_smileybar']) {
        ob_start();
        include_once XOOPS_ROOT_PATH . '/include/xoopscodes.php';
        xoopsSmilies('shoutfield');
        $block['shoutbox_smibar'] = ob_get_contents();
        ob_end_clean();
        $block['shoutbox_smibar'] = str_replace("<a href='#moresmiley' onmouseover='style.cursor=\"hand\"' alt=''","<a href='#moresmiley' onmouseover='style.cursor=\"hand\"' title='More'",   $block['shoutbox_smibar']);
    }

    if (!is_object($xoopsUser) && !$block['popup_guests']) {
        $block['popup'] = false;
    }

    return $block;
}

?>