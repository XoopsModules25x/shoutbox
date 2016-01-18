<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author     XOOPS Development Team
 * @version    $Id $
 */

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/include/cp_header.php';
include_once dirname(__FILE__) . '/admin_header.php';

xoops_cp_header();

    $indexAdmin = new ModuleAdmin();

global $xoopsModuleConfig;

$indexAdmin->addInfoBox(_AM_SHOUTBOX_CURRENT_SELECTION);
if($xoopsModuleConfig['storage_type'] == 'database') {
    $database = '['._AM_SH_EDIT_INUSE.']';
    $file = '';
    $imgDB="<img src='../images/on.png'>";
    $imgFile="<img src='../images/off.png'>";
    $indexAdmin->addInfoBoxLine(_AM_SHOUTBOX_CURRENT_SELECTION,
        $imgDB."<a href='main.php?op=shoutboxList'>" . _AM_SH_EDIT_DB . "</a> $database", 0, 'Green'    );
    $indexAdmin->addInfoBoxLine(_AM_SHOUTBOX_CURRENT_SELECTION,
        $imgFile."<a href='main.php?op=shoutboxFile'>" . _AM_SH_EDIT_FILE . "</a> $file", 0, 'Green'    );
} else if($xoopsModuleConfig['storage_type'] == 'file') {
    $database = '';
    $file = '['._AM_SH_EDIT_INUSE.']';
    $imgDB="<img src='../images/off.png'>";
    $imgFile="<img src='../images/on.png'>";
    $indexAdmin->addInfoBoxLine(_AM_SHOUTBOX_CURRENT_SELECTION,
        $imgDB."<a href='main.php?op=shoutboxList'>" . _AM_SH_EDIT_DB . "</a> $database", 0, 'Green'    );
    $indexAdmin->addInfoBoxLine(_AM_SHOUTBOX_CURRENT_SELECTION,
        $imgFile."<a href='main.php?op=shoutboxFile'>" . _AM_SH_EDIT_FILE . "</a> $file", 0, 'Green'    );
}

    echo $indexAdmin->addNavigation('index.php');
    echo $indexAdmin->renderIndex();

include "admin_footer.php";
