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

// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

$moduleDirName = basename(__DIR__);

// ------------------- Informations ------------------- //
$modversion = array(
    'version'             => '5.02',
    'module_status'       => 'Beta 2',
    'release_date'        => '2017/07/10',
    'name'                => _MI_SHOUTBOX_NAME,
    'description'         => _MI_SHOUTBOX_DESC,
    'credits'             => 'XOOPS Project',
    'help'                => 'page=>help',
    'license'             => 'GNU GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html',
    'official'            => 0, //1 indicates supported by XOOPS Dev Team, 0 means 3rd party supported
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => basename(__DIR__),
    'author'              => 'Tank, Trabis',
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS',
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.8',
    'min_admin'           => '1.2',
    'min_db'              => array('mysql' => '5.5'),
    // Admin things
    'hasAdmin'            => 1,
    'system_menu'         => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // ------------------- Main Menu -------------------
    'hasMain'             => 1,
    // Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
    'sqlfile'             => array('mysql' => 'sql/mysql.sql'),

    // Tables created by sql file (without prefix!)
    'tables'              => 'shoutbox',
);

// ------------------- Help files ------------------- //
$modversion['helpsection'] = array(
    ['name' => _MI_SHOUTBOX_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_SHOUTBOX_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_SHOUTBOX_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_SHOUTBOX_SUPPORT, 'link' => 'page=support'],
);

// ------------------- Blocks ------------------- //
$modversion['blocks'][] = array(
    'file'        => 'shoutbox.php',
    'name'        => _MI_SHOUTBOX_BLOCK,
    'description' => _MI_SHOUTBOX_DESC,
    'show_func'   => 'b_shoutbox_show',
    'edit_func'   => '',
    'template'    => 'shoutbox_block.tpl',
);


// ------------------- Templates ------------------- //
$modversion['templates'] = array(
    // User
    ['file' => 'shoutbox_popup.tpl', 'description' => 'Template for popup'],
    ['file' => 'shoutbox_shoutframe.tpl', 'description' => 'Template for block-iframe content'],
    ['file' => 'shoutbox_popupframe.tpl', 'description' => 'Template for popup-iframe content'],
    ['file' => 'shoutbox_popupheader.tpl', 'description' => ''],
    ['file' => 'shoutbox_online.tpl', 'description' => '']
);

//$modversion['onInstall']   = 'include/module.php';
//$modversion['onUninstall'] = 'include/module.php';

//Install/Uninstall Functions
$modversion['onInstall']   = 'include/oninstall.php';
//$modversion['onUpdate']    = 'include/onupdate.php';
$modversion['onUninstall'] = 'include/onuninstall.php';

// Config settings
// Global settings:
$modversion['config'][] = array(
    'name'        => 'logfile',
    'title'       => '_MI_SHOUTBOX_CAT1',
    'description' => '_MI_USERLOG_CONFCAT_LOGFILE_DSC',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'odd',
);
$modversion['config'][] = array(
    'name'        => 'guests_may_post',
    'title'       => '_MI_SHOUTBOX_TITLE1',
    'description' => '_MI_SHOUTBOX_EMPTY',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'guests_may_chname',
    'title'       => '_MI_SHOUTBOX_TITLE2',
    'description' => '_MI_SHOUTBOX_DESC2',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
);
$modversion['config'][] = array(
    'name'        => 'allow_bbcode',
    'title'       => '_MI_SHOUTBOX_TITLE3',
    'description' => '_MI_SHOUTBOX_DESC3',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'stamp_format',
    'title'       => '_MI_SHOUTBOX_TITLE4',
    'description' => '_MI_SHOUTBOX_DESC4',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'h:i a',
);
$modversion['config'][] = array(
    'name'        => 'maxshouts_trim',
    'title'       => '_MI_SHOUTBOX_TITLE5',
    'description' => '_MI_SHOUTBOX_DESC5',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => '20',
);
$modversion['config'][] = array(
    'name'        => 'maxshouts_view',
    'title'       => '_MI_SHOUTBOX_TITLE6',
    'description' => '_MI_SHOUTBOX_DESC6',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => '20',
);
$modversion['config'][] = array(
    'name'        => 'storage_type',
    'title'       => '_MI_SHOUTBOX_TITLE7',
    'description' => '_MI_SHOUTBOX_DESC7',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array('_MI_SHOUTBOX_OP7_F' => 'file', '_MI_SHOUTBOX_OP7_D' => 'database'),
    'default'     => 'file',
);
$modversion['config'][] = array(
    'name'        => 'user_realname',
    'title'       => '_MI_SHOUTBOX_TITLE8',
    'description' => '_MI_SHOUTBOX_DESC8',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
);

// Block Settings:
$modversion['config'][] = array(
    'name'        => 'logfile',
    'title'       => '_MI_SHOUTBOX_CAT2',
    'description' => '_MI_USERLOG_CONFCAT_LOGFILE_DSC',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'odd',
);
$modversion['config'][] = array(
    'name'        => 'show_smileybar',
    'title'       => '_MI_SHOUTBOX_TITLE11',
    'description' => '_MI_SHOUTBOX_EMPTY',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'iframe_width',
    'title'       => '_MI_SHOUTBOX_TITLE12',
    'description' => '_MI_SHOUTBOX_DESC12',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '100%',
);
$modversion['config'][] = array(
    'name'        => 'iframe_height',
    'title'       => '_MI_SHOUTBOX_TITLE13',
    'description' => '_MI_SHOUTBOX_DESC13',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '150',
);
$modversion['config'][] = array(
    'name'        => 'iframe_border',
    'title'       => '_MI_SHOUTBOX_TITLE14',
    'description' => '_MI_SHOUTBOX_EMPTY',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '0',
);
$modversion['config'][] = array(
    'name'        => 'popup',
    'title'       => '_MI_SHOUTBOX_TITLE15',
    'description' => '_MI_SHOUTBOX_DESC15',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'block_autorefresh',
    'title'       => '_MI_SHOUTBOX_TITLE16',
    'description' => '_MI_SHOUTBOX_DESC16',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'options'     => array('_MI_SHOUTBOX_OP16_BA0' => 0, '_MI_SHOUTBOX_OP16_BA1' => 1),
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'wordwrap_setting',
    'title'       => '_MI_SHOUTBOX_TITLE17',
    'description' => '_MI_SHOUTBOX_DESC17',
    'formtype'    => 'text',
    'valuetype'   => 'int',
    'default'     => 0,
);
$modversion['config'][] = array(
    'name'        => 'display_avatar',
    'title'       => '_MI_SHOUTBOX_TITLE18',
    'description' => '_MI_SHOUTBOX_DESC18',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'guest_avatar',
    'title'       => '_MI_SHOUTBOX_TITLE19',
    'description' => '_MI_SHOUTBOX_DESC19',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'options'     => array(
        '_MI_SHOUTBOX_OP19_GA0' => 0,
        '_MI_SHOUTBOX_OP19_GA1' => 1,
        '_MI_SHOUTBOX_OP19_GA2' => 2,
        '_MI_SHOUTBOX_OP19_GA3' => 3,
        '_MI_SHOUTBOX_OP19_GA4' => 4,
        '_MI_SHOUTBOX_OP19_GA5' => 5
    ),
    'default'     => 1,
);
// PopUp:
$modversion['config'][] = array(
    'name'        => 'logfile',
    'title'       => '_MI_SHOUTBOX_CAT3',
    'description' => '_MI_USERLOG_CONFCAT_LOGFILE_DSC',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'odd',
);
$modversion['config'][] = array(
    'name'        => 'popup_whoisonline',
    'title'       => '_MI_SHOUTBOX_TITLE31',
    'description' => '_MI_SHOUTBOX_DESC31',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'popup_show_smileybar',
    'title'       => '_MI_SHOUTBOX_TITLE32',
    'description' => '_MI_SHOUTBOX_EMPTY',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'popup_sound',
    'title'       => '_MI_SHOUTBOX_TITLE33',
    'description' => '_MI_SHOUTBOX_EMPTY',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'popup_guests',
    'title'       => '_MI_SHOUTBOX_TITLE34',
    'description' => '_MI_SHOUTBOX_DESC34',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
);
$modversion['config'][] = array(
    'name'        => 'popup_irc',
    'title'       => '_MI_SHOUTBOX_TITLE35',
    'description' => '_MI_SHOUTBOX_DESC35',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'popup_autofocus',
    'title'       => '_MI_SHOUTBOX_TITLE36',
    'description' => '_MI_SHOUTBOX_DESC36',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'popup_width',
    'title'       => '_MI_SHOUTBOX_TITLE37',
    'description' => '_MI_SHOUTBOX_DESC37',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '500',
);
$modversion['config'][] = array(
    'name'        => 'popup_height',
    'title'       => '_MI_SHOUTBOX_TITLE38',
    'description' => '_MI_SHOUTBOX_DESC38',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '340',
);

// Text Input:
$modversion['config'][] = array(
    'name'        => 'logfile',
    'title'       => '_MI_SHOUTBOX_CAT4',
    'description' => '_MI_USERLOG_CONFCAT_LOGFILE_DSC',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'odd',
);
$modversion['config'][] = array(
    'name'        => 'input_type',
    'title'       => '_MI_SHOUTBOX_TITLE40',
    'description' => '_MI_SHOUTBOX_DESC40',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'options'     => array('_MI_SHOUTBOX_OP40_TL' => 0, '_MI_SHOUTBOX_OP40_TA' => 1),
    'default'     => 1,
);
$modversion['config'][] = array(
    'name'        => 'textarea_rows',
    'title'       => '_MI_SHOUTBOX_TITLE41',
    'description' => '_MI_SHOUTBOX_DESC41',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '4',
);
$modversion['config'][] = array(
    'name'        => 'textarea_cols',
    'title'       => '_MI_SHOUTBOX_TITLE42',
    'description' => '_MI_SHOUTBOX_DESC42',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '75',
);
$modversion['config'][] = array(
    'name'        => 'text_linelength',
    'title'       => '_MI_SHOUTBOX_TITLE43',
    'description' => '_MI_SHOUTBOX_DESC43',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '75',
);
$modversion['config'][] = array(
    'name'        => 'text_maxchars',
    'title'       => '_MI_SHOUTBOX_TITLE44',
    'description' => '_MI_SHOUTBOX_DESC44',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '300',
);
$modversion['config'][] = array(
    'name'        => 'input_alerts',
    'title'       => '_MI_SHOUTBOX_TITLE45',
    'description' => '_MI_SHOUTBOX_DESC45',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
);
$modversion['config'][] = array(
    'name'        => 'captcha_enable',
    'title'       => '_MI_SHOUTBOX_TITLE46',
    'description' => '_MI_SHOUTBOX_DESC46',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);
