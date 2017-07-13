CREATE TABLE shoutbox (
  id      MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  uid     MEDIUMINT(8) UNSIGNED NOT NULL,
  uname   VARCHAR(20)                    DEFAULT NULL,
  time    INT(10) UNSIGNED      NOT NULL,
  ip      VARCHAR(15)           NOT NULL DEFAULT '0.0.0.0',
  message TEXT                  NOT NULL,
  PRIMARY KEY (id)
)
  ENGINE = MyISAM
  AUTO_INCREMENT = 1;
