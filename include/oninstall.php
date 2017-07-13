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
 * @param XoopsModule $module
 * @return bool
 */

function xoops_module_install_shoutbox(XoopsModule $module)
{
    $newmid = $module->getVar('mid');

    $groupHandler = xoops_getHandler('group');
    $groups       = $groupHandler->getObjects();

    $moduleDirName = $module->getVar('dirname');
    xoops_loadLanguage('main', $moduleDirName);

    // retrieve all block ids for this module
    $blocks       = XoopsBlock::getByModule($newmid, false);
    $msgs[]       = _MD_AM_GROUP_SETTINGS_ADD;
    $gpermHandler = xoops_getHandler('groupperm');
    //    foreach ($groups as $mygroup) {
    foreach (array_keys($groups) as $i) {
        $mygroup = $groups[$i]->getVar('groupid');
        if ($gpermHandler->checkRight('module_admin', 0, $mygroup)) {
            $mperm = $gpermHandler->create();
            $mperm->setVar('gperm_groupid', $mygroup);
            $mperm->setVar('gperm_itemid', $newmid);
            $mperm->setVar('gperm_name', 'module_admin');
            $mperm->setVar('gperm_modid', 1);
            if (!$gpermHandler->insert($mperm)) {
                $msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">' . sprintf(_AM_SYSTEM_MODULES_ACCESS_ADMIN_ADD_ERROR, '<strong>' . $mygroup . '</strong>') . '</span>';
            } else {
                $msgs[] = '&nbsp;&nbsp;' . sprintf(_MD_AM_ACCESS_ADMIN_ADD, '<strong>' . $mygroup . '</strong>');
            }
            unset($mperm);
        }
        $mperm = $gpermHandler->create();
        $mperm->setVar('gperm_groupid', $mygroup);
        $mperm->setVar('gperm_itemid', $newmid);
        $mperm->setVar('gperm_name', 'module_read');
        $mperm->setVar('gperm_modid', 1);
        if (!$gpermHandler->insert($mperm)) {
            $msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">' . sprintf(_MD_AM_ACCESS_USER_ADD_ERROR, '<strong>' . $mygroup . '</strong>') . '</span>';
        } else {
            $msgs[] = '&nbsp;&nbsp;' . sprintf(_MD_AM_ACCESS_USER_ADD_ERROR, '<strong>' . $mygroup . '</strong>');
        }
        unset($mperm);

        foreach ($blocks as $blc) {
            $bperm = $gpermHandler->create();
            $bperm->setVar('gperm_groupid', $mygroup);
            $bperm->setVar('gperm_itemid', $blc);
            $bperm->setVar('gperm_name', 'block_read');
            $bperm->setVar('gperm_modid', 1);
            if (!$gpermHandler->insert($bperm)) {
                $msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">' . _AM_SYSTEM_MODULES_BLOCK_ACCESS_ERROR . ' Block ID: <strong>' . $blc . '</strong> Group ID: <strong>' . $mygroup . '</strong></span>';
            } else {
                $msgs[] = '&nbsp;&nbsp;' . _MD_AM_BLOCK_ACCESS . sprintf(_MD_AM_BLOCK_ID, '<strong>' . $blc . '</strong>') . sprintf(_MD_AM_GROUP_ID, '<strong>' . $mygroup . '</strong>');
            }
            unset($bperm);
        }
    }

    unset($blocks);
    unset($groups);

    $cacheDir  = XOOPS_ROOT_PATH . '/uploads/shoutbox';
    $cacheFile = $cacheDir . '/shout.csv';

    if (!file_exists($cacheFile)) {
        if (!is_dir($cacheDir)) {
            if (!mkdir($cacheDir)) {
                //$msgs[] = "Failed to create dir!";
                return false;
            } else {
                //$msgs[] = "&nbsp;&nbsp;Dir /uploads/shoutbox/ successfully created!";
                chmod($cacheDir, 0777);
            }
        }

        if ($file = fopen($cacheFile, 'w')) {
            if (!fwrite($file, 'Shoutbox|' . _MD_AM_WELCOME . "|1|111.111.111.111|guest\n")) {
                //$msgs[] = "&nbsp;&nbsp;Could not put content in file /uploads/shoutbox/shout.cvs! Please create <i>manually</i>.";
            }
            fclose($file);
            chmod($cacheFile, 0777);

            //$msgs[] = "&nbsp;&nbsp;File /uploads/shoutbox/shout.cvs successfully created!";
            return true;
        } else {
            //$msgs[] = "&nbsp;&nbsp;Could not create file /uploads/shoutbox/shout.cvs! Please create <i>manually</i>.";
            return false;
        }
    } else {
        return true;
    }
}
