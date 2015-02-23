<?php

// The name of this module
define("_MI_SHOUTBOX_NAME","Shoutbox");

// A brief description of this module
define("_MI_SHOUTBOX_DESC","Enables a shoutbox block with an additional popup.");

// Menu
define('_MI_SHOUTBOX_MENU_DB','Database');
define('_MI_SHOUTBOX_MENU_FILE','File');
define('_MI_SHOUTBOX_MENU_STATUS','Status');

// Names of blocks for this module (Not all module has blocks)
define("_MI_SHOUTBOX_BLOCK","Shoutbox");

// Categories
define('_MI_SHOUTBOX_CAT1','<font color="#FF0000" size="6"><b>--- Global Settings ---</b></font> ');
define('_MI_SHOUTBOX_CAT2','<font color="#FF0000" size="6"><b>--- Block Settings ---</b></font> ');
define('_MI_SHOUTBOX_CAT3','<font color="#FF0000" size="6"><b>--- PopUp Settings ---</b></font> ');
define('_MI_SHOUTBOX_CAT4','<font color="#FF0000" size="6"><b>--- Text Input Settings ---</b></font> ');

// Config language definitions...
define("_MI_SHOUTBOX_TITLE1", "May guests post?");
define("_MI_SHOUTBOX_TITLE2", "May guests choose a name?");
define("_MI_SHOUTBOX_DESC2", "If guests may post, may they choose an own name?");
define("_MI_SHOUTBOX_TITLE3", "Allow bbcode");
define("_MI_SHOUTBOX_DESC3", "Allow users to use bbcode? Ex [b], [url=], etc..");
define("_MI_SHOUTBOX_TITLE4", "Timestamp Format");
define("_MI_SHOUTBOX_DESC4", "In what format should the time of the shout be formatted? (<a href='http://www.php.net/manual/en/function.date.php' target='_blank'>Manual</a>)");
define("_MI_SHOUTBOX_TITLE5", "Trimming");
define("_MI_SHOUTBOX_DESC5", "Maximum shouts before trimming takes place. (0 = no trimming, be cautious!!!)");
define("_MI_SHOUTBOX_TITLE6", "Max Shouts");
define("_MI_SHOUTBOX_DESC6", "How many shouts should be displayed?");
define("_MI_SHOUTBOX_TITLE7", "Storage");
define("_MI_SHOUTBOX_DESC7", "Define where the shouts should be stored");
define("_MI_SHOUTBOX_TITLE8", "User Real Name");
define("_MI_SHOUTBOX_DESC8", "Should we show user Real name? If 'NO', login name will be used");
define("_MI_SHOUTBOX_OP7_F", "File [csv]");
define("_MI_SHOUTBOX_OP7_D", "Database [mysql]");
define("_MI_SHOUTBOX_TITLE11","Show smiley bar in block?");
define("_MI_SHOUTBOX_TITLE12", "Shout Message Block IFrame width");
define("_MI_SHOUTBOX_DESC12", "The width of the iframe in the block.");
define("_MI_SHOUTBOX_TITLE13", "Shout Message Block IFrame height");
define("_MI_SHOUTBOX_DESC13", "The height of the iframe in the block.");
define("_MI_SHOUTBOX_TITLE14", "Shout Message IFrame border width");
define("_MI_SHOUTBOX_TITLE15", "PopUp Window Enable");
define("_MI_SHOUTBOX_DESC15", "May users use the block?");
define("_MI_SHOUTBOX_TITLE16", "Auto-refresh Options Display");
define("_MI_SHOUTBOX_DESC16", "Auto-refresh option display in block");
define("_MI_SHOUTBOX_OP16_BA0", "Do not display auto-refresh option");
define("_MI_SHOUTBOX_OP16_BA1", "Display auto-refresh option");
define("_MI_SHOUTBOX_TITLE17", "Shout Message Wordwrap Setting");
define("_MI_SHOUTBOX_DESC17", "This value imposes a limit on the number of characters to display per line in the ShoutBox block frame. Setting this value to 0 disables forced wordwrapping.");
define("_MI_SHOUTBOX_TITLE18", "Avatar Display");
define("_MI_SHOUTBOX_DESC18", "Determines if avatars are displayed in ShoutBox block");
define("_MI_SHOUTBOX_TITLE19", "Guest Avatar");
define("_MI_SHOUTBOX_DESC19", "<table><tr>
                               <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest1.gif\" width=60></td>
                               <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest2.gif\" width=60></td>
                               <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest3.gif\" width=60></td>
                               <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest4.gif\" width=60></td>
                               <td><img src=\"".XOOPS_URL."/modules/shoutbox/images/guestavatars/guest5.gif\" width=60></td>
                               </tr><tr>
                               <td>guest1</td>
                               <td>guest2</td>
                               <td>guest3</td>
                               <td>guest4</td>
                               <td>guest5</td>
                               </tr></table>");
define("_MI_SHOUTBOX_OP19_GA0", "None");
define("_MI_SHOUTBOX_OP19_GA1", "guest1");
define("_MI_SHOUTBOX_OP19_GA2", "guest2");
define("_MI_SHOUTBOX_OP19_GA3", "guest3");
define("_MI_SHOUTBOX_OP19_GA4", "guest4");
define("_MI_SHOUTBOX_OP19_GA5", "guest5");

define("_MI_SHOUTBOX_TITLE31", "Show 'Who's online'");
define("_MI_SHOUTBOX_DESC31", "Show in the popup who's on-line. Warning: Who's on-line block has to be activated!");
define("_MI_SHOUTBOX_TITLE32", "Show smiley bar in PopUp");
define("_MI_SHOUTBOX_TITLE33", "Play sound on new message?");
define("_MI_SHOUTBOX_TITLE34", "May guests use popup?");
define("_MI_SHOUTBOX_DESC34", "If the popup is activated, may guests use it?");
define("_MI_SHOUTBOX_TITLE35", "IRC-a-like");
define("_MI_SHOUTBOX_DESC35", "Enable IRC commands. At this time only /quit and /nick are supported.");
define("_MI_SHOUTBOX_TITLE36", "Auto-focus");
define("_MI_SHOUTBOX_DESC36", "Automaticly focus the popup window when there comes a new message.");
define("_MI_SHOUTBOX_TITLE37", "PopUp Width");
define("_MI_SHOUTBOX_DESC37", "Default popup width (in pixels)");
define("_MI_SHOUTBOX_TITLE38", "PopUp Height");
define("_MI_SHOUTBOX_DESC38", "Default popup height (in pixels)");
define("_MI_SHOUTBOX_TITLE40", "Shout Text Input Type");
define("_MI_SHOUTBOX_DESC40", "Shout text entry form selection");
define("_MI_SHOUTBOX_OP40_TL", "Single Line Text");
define("_MI_SHOUTBOX_OP40_TA", "Multi-line Text Area");
define("_MI_SHOUTBOX_TITLE41", "Text Area Rows");
define("_MI_SHOUTBOX_DESC41", "Height of text area in rows<br />Only applicable when Shout Text Entry Form Selection = Multi-line Text Area");
define("_MI_SHOUTBOX_TITLE42", "Text Area Columns");
define("_MI_SHOUTBOX_DESC42", "Width of text area in columns<br />Only applicable when Shout Text Entry Form Selection = Multi-line Text Area");
define("_MI_SHOUTBOX_TITLE43", "Text Line Length");
define("_MI_SHOUTBOX_DESC43", "Width of single line text entry in characters");
define("_MI_SHOUTBOX_TITLE44", "Text Max Characters");
define("_MI_SHOUTBOX_DESC44", "Maximum length of text entry");
define("_MI_SHOUTBOX_TITLE45", "Text Input Maximum Alerts");
define("_MI_SHOUTBOX_DESC45", "Enables alert messages when approaching and reaching maximum text entry limit");
define("_MI_SHOUTBOX_TITLE46", "Captcha Enable");
define("_MI_SHOUTBOX_DESC46", "Enables captcha confirmation code requirement (anti-spam measure)");
define("_MI_SHOUTBOX_OP46_A", "Disabled - Frameworks/captcha not found");
define("_MI_SHOUTBOX_OP46_B", "Disable Captcha");
define("_MI_SHOUTBOX_OP46_C", "Enable Frameworks Captcha");
define("_MI_SHOUTBOX_OP46_D", "Enable Core Captcha");
define('_MI_SHOUTBOX_EMPTY', '');
?>