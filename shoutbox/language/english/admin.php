<?php
// General usage
define('_AM_SH_CONFIG','Shoutbox Admin');
define('_AM_SH_POSTER','Poster');
define('_AM_SH_MESSAGE','Message');
define('_AM_SH_INVALID_ID','ID returned no shout');

// index.php
define('_AM_SH_CHOOSE','What do you want to do?');
define('_AM_SH_EDIT_DB','Edit shouts in database');
define('_AM_SH_EDIT_FILE','Edit shouts in file');
define('_AM_SH_EDIT_INUSE','In Use');
define('_AM_SH_STATUSOF','Status of shoutbox');

// shoutboxEdit.php
define('_AM_SH_EDIT_TITLE','Edit shout [Posted on %s]');
define('_AM_SH_EDIT_FROM','From'); // Ex: "From: 127.0.0.1"

// shoutboxList.php
define('_AM_SH_LIST_TIME','Time');
define('_AM_SH_LIST_ACTION','Action');
define('_AM_SH_LIST_NOSHOUTS','No Shouts');

// shoutboxRemove.php
define('_AM_SH_REMOVE_TITLE','Remove shout [Posted on %s]');
define('_AM_SH_REMOVE_SUCCES','Shout deleted!');
define('_AM_SH_REMOVE_FAILURE','Error - Could not execute query...');
define('_AM_SH_REMOVE_FROM','From');

// shoutboxStatus.php
define('_AM_SH_STATUS_TITLE','Shoutbox Status');
define('_AM_SH_STATUS_STORAGETYPE','Storage type');
define('_AM_SH_STATUS_INDB','Shouts in database');
define('_AM_SH_STATUS_INFILE','Shouts in file');
define('_AM_SH_STATUS_SIZEDB','Size table shoutbox');
define('_AM_SH_STATUS_SIZEFILE','Size file shoutbox');

// shoutboxFile.php
define('_AM_SH_FILE_TITLE','Edit of shout.cvs');
define('_AM_SH_FILE_SOURCE','Source of shout.cvs');
define('_AM_SH_FILE_SOURCED','You can edit/remove lines of shout.cvs. Be sure to not break the structure (line by line).');
define('_AM_SH_FILE_HASH','Force Update');
define('_AM_SH_FILE_HASHD','Overrule hashcheck so you can update file.'); // Hash fail: file has been updated (read: shout added) during editing
define('_AM_SH_FILE_HASH_FAILED','Hash check failed!');
define('_AM_SH_FILE_UPDATED','File updated');
define('_AM_SH_FILE_FAILED','Could not open file!');

//5.01
define('_AM_SHOUTBOX_CURRENT_SELECTION','Current Selection');