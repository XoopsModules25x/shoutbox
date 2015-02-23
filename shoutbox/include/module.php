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
 * @version         $Id: module.php 0 2010-01-29 18:47:04Z trabis $
 */

function xoops_module_install_shoutbox(&$module)
{

    $newmid = $module->getVar('mid');
    $groups = array(XOOPS_GROUP_ADMIN, XOOPS_GROUP_USERS, XOOPS_GROUP_ANONYMOUS);

    $thisModuleDir = $module->getVar('dirname');
    xoops_loadLanguage('main', $thisModuleDir);

    // retrieve all block ids for this module
    $blocks = XoopsBlock::getByModule($newmid, false);
    $msgs[] = _MD_AM_GROUP_SETTINGS_ADD;
    $gperm_handler =& xoops_gethandler('groupperm');
    foreach ($groups as $mygroup) {
        if ($gperm_handler->checkRight('module_admin', 0, $mygroup)) {
            $mperm =& $gperm_handler->create();
            $mperm->setVar('gperm_groupid', $mygroup);
            $mperm->setVar('gperm_itemid', $newmid);
            $mperm->setVar('gperm_name', 'module_admin');
            $mperm->setVar('gperm_modid', 1);
            if (!$gperm_handler->insert($mperm)) {
                $msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">' . sprintf(_MD_AM_ACCESS_ADMIN_ADD_ERROR, "<strong>" . $mygroup . "</strong>") . "</span>";
            } else {
                $msgs[] = "&nbsp;&nbsp;" . sprintf(_MD_AM_ACCESS_ADMIN_ADD, "<strong>" . $mygroup . "</strong>");
            }
            unset($mperm);
        }
        $mperm =& $gperm_handler->create();
        $mperm->setVar('gperm_groupid', $mygroup);
        $mperm->setVar('gperm_itemid', $newmid);
        $mperm->setVar('gperm_name', 'module_read');
        $mperm->setVar('gperm_modid', 1);
        if (!$gperm_handler->insert($mperm)) {
            $msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">' . sprintf(_MD_AM_ACCESS_USER_ADD_ERROR, "<strong>" . $mygroup . "</strong>") . "</span>";
        } else {
            $msgs[] = '&nbsp;&nbsp;' . sprintf(_MD_AM_ACCESS_USER_ADD_ERROR, "<strong>" . $mygroup . "</strong>");
        }
        unset($mperm);
        foreach ($blocks as $blc) {
            $bperm =& $gperm_handler->create();
            $bperm->setVar('gperm_groupid', $mygroup);
            $bperm->setVar('gperm_itemid', $blc);
            $bperm->setVar('gperm_name', 'block_read');
            $bperm->setVar('gperm_modid', 1);
            if (!$gperm_handler->insert($bperm)) {
                $msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">' . _MD_AM_BLOCK_ACCESS_ERROR . ' Block ID: <strong>' . $blc . '</strong> Group ID: <strong>' . $mygroup . '</strong></span>';
            } else {
                $msgs[] = '&nbsp;&nbsp;' . _MD_AM_BLOCK_ACCESS . sprintf(_MD_AM_BLOCK_ID, "<strong>" . $blc . "</strong>") . sprintf(_MD_AM_GROUP_ID, "<strong>" . $mygroup . "</strong>");
            }
            unset($bperm);
        }
    }
    unset($blocks);
    unset($groups);

    $cacheDir = XOOPS_ROOT_PATH . '/uploads/shoutbox';
    $cacheFile = $cacheDir . '/shout.csv';

    if (!file_exists($cacheFile)) {
        if (!is_dir($cacheDir)) {
            if (!mkdir($cacheDir)) {
                //$msgs[] = "Failed to create dir!";
                return false;
            } else {
                //$msgs[] = "&nbsp;&nbsp;Dir /uploads/shoutbox/ succesfully created!";
                chmod($cacheDir, 0777);
            }
        }

        if ($file = fopen($cacheFile, 'w')) {
            if (!fwrite($file, "Shoutbox|"._MD_AM_WELCOME."|1|111.111.111.111|guest\n")) {
                //$msgs[] = "&nbsp;&nbsp;Could not put content in file /uploads/shoutbox/shout.cvs! Please create <i>manually</i>.";
            }
            fclose($file);
            chmod($cacheFile, 0777);
            //$msgs[] = "&nbsp;&nbsp;File /uploads/shoutbox/shout.cvs succesfully created!";
            return true;
        } else {
            //$msgs[] = "&nbsp;&nbsp;Could not create file /uploads/shoutbox/shout.cvs! Please create <i>manually</i>.";
            return false;
        }
    } else {
        return true;
    }
}

function xoops_module_uninstall_shoutbox(&$module)
{
    $cacheDir = XOOPS_ROOT_PATH . '/uploads/shoutbox';
    //Always check if a directory exists prior to creation
    if (!is_dir($cacheDir)) {
        return true;
    } else {
        return rmdirr($cacheDir);
    }
}

/**
 * Delete a file, or a folder and its contents
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.0
 * @param       string   $dirname    The directory to delete
 * @return      bool     Returns true on success, false on failure
 */

function rmdirr($dirname)
{
    // Simple delete for a file
    if (is_file($dirname)) {
        return unlink($dirname);
    }

    // Loop through the folder
    $dir = dir($dirname);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep delete directories
        if (is_dir("$dirname/$entry")) {
            rmdirr("$dirname/$entry");
        } else {
            unlink("$dirname/$entry");
        }
    }

    // Clean up
    $dir->close();
    return rmdir($dirname);
}
?>