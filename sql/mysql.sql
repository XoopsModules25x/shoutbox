CREATE TABLE shoutbox (
  id mediumint(8) unsigned NOT NULL auto_increment,
  uid mediumint(8) unsigned NOT NULL,
  uname varchar(20) default NULL,
  time int(10) unsigned NOT NULL,
  ip varchar(15) NOT NULL default '0.0.0.0',
  message text NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;
