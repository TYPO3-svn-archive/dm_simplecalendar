SET NAMES utf8;
#
# Table structure for table 'tx_dmsimplecalendar_domain_model_appointment'
#
CREATE TABLE tx_dmsimplecalendar_domain_model_appointment (
  uid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL DEFAULT '0',

  calendar int(11) unsigned NOT NULL DEFAULT '0',
  location varchar(255) NOT NULL DEFAULT '',
  description text NOT NULL,
  shortdescription text NOT NULL,
  startdate int(11) NOT NULL DEFAULT '0',
  enddate int(11) NOT NULL DEFAULT '0',
  title varchar(255) NOT NULL DEFAULT '',
  media int(11) unsigned DEFAULT '0',
  categories int(11) unsigned DEFAULT '0' NOT NULL,
  pre_appointment int(11) unsigned DEFAULT '0' NOT NULL,

  tstamp int(11) unsigned NOT NULL DEFAULT '0',
  crdate int(11) unsigned NOT NULL DEFAULT '0',
  cruser_id int(11) unsigned NOT NULL DEFAULT '0',
  deleted tinyint(4) unsigned NOT NULL DEFAULT '0',
  hidden tinyint(4) unsigned NOT NULL DEFAULT '0',
  starttime int(11) unsigned NOT NULL DEFAULT '0',
  endtime int(11) unsigned NOT NULL DEFAULT '0',

  t3ver_oid int(11) NOT NULL DEFAULT '0',
  t3ver_id int(11) NOT NULL DEFAULT '0',
  t3ver_wsid int(11) NOT NULL DEFAULT '0',
  t3ver_label varchar(255) NOT NULL DEFAULT '',
  t3ver_state tinyint(4) NOT NULL DEFAULT '0',
  t3ver_stage int(11) NOT NULL DEFAULT '0',
  t3ver_count int(11) NOT NULL DEFAULT '0',
  t3ver_tstamp int(11) NOT NULL DEFAULT '0',
  t3ver_move_id int(11) NOT NULL DEFAULT '0',
  t3_origuid int(11) NOT NULL DEFAULT '0',
  sys_language_uid int(11) NOT NULL DEFAULT '0',
  l10n_parent int(11) NOT NULL DEFAULT '0',
  l10n_diffsource mediumblob,

  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid),
  KEY language (l10n_parent,sys_language_uid)
);
#
# Table structure for table 'tx_dmsimplecalendar_domain_model_calendar'
#
CREATE TABLE tx_dmsimplecalendar_domain_model_calendar (
  uid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL DEFAULT '0',

  appointments int(11) unsigned NOT NULL DEFAULT '0',

  tstamp int(11) unsigned NOT NULL DEFAULT '0',
  crdate int(11) unsigned NOT NULL DEFAULT '0',
  cruser_id int(11) unsigned NOT NULL DEFAULT '0',
  deleted tinyint(4) unsigned NOT NULL DEFAULT '0',
  hidden tinyint(4) unsigned NOT NULL DEFAULT '0',
  starttime int(11) unsigned NOT NULL DEFAULT '0',
  endtime int(11) unsigned NOT NULL DEFAULT '0',

  t3ver_oid int(11) NOT NULL DEFAULT '0',
  t3ver_id int(11) NOT NULL DEFAULT '0',
  t3ver_wsid int(11) NOT NULL DEFAULT '0',
  t3ver_label varchar(255) NOT NULL DEFAULT '',
  t3ver_state tinyint(4) NOT NULL DEFAULT '0',
  t3ver_stage int(11) NOT NULL DEFAULT '0',
  t3ver_count int(11) NOT NULL DEFAULT '0',
  t3ver_tstamp int(11) NOT NULL DEFAULT '0',
  t3ver_move_id int(11) NOT NULL DEFAULT '0',
  t3_origuid int(11) NOT NULL DEFAULT '0',
  sys_language_uid int(11) NOT NULL DEFAULT '0',
  l10n_parent int(11) NOT NULL DEFAULT '0',
  l10n_diffsource mediumblob,
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid),
  KEY language (l10n_parent,sys_language_uid)
);
#
# Table structure for table 'tx_dmsimplecalendar_domain_model_media'
#
CREATE TABLE tx_dmsimplecalendar_domain_model_media (

  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,

  files int(11) unsigned DEFAULT '0' NOT NULL,
  images int(11) unsigned DEFAULT '0' NOT NULL,

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  starttime int(11) unsigned DEFAULT '0' NOT NULL,
  endtime int(11) unsigned DEFAULT '0' NOT NULL,

  t3ver_oid int(11) DEFAULT '0' NOT NULL,
  t3ver_id int(11) DEFAULT '0' NOT NULL,
  t3ver_wsid int(11) DEFAULT '0' NOT NULL,
  t3ver_label varchar(255) DEFAULT '' NOT NULL,
  t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
  t3ver_stage int(11) DEFAULT '0' NOT NULL,
  t3ver_count int(11) DEFAULT '0' NOT NULL,
  t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
  t3ver_move_id int(11) DEFAULT '0' NOT NULL,

  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l10n_parent int(11) DEFAULT '0' NOT NULL,
  l10n_diffsource mediumblob,

  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid),
  KEY language (l10n_parent,sys_language_uid)
);
#
# Table structure for table 'sys_category'
#
CREATE TABLE sys_category (

  appointment int(11) unsigned DEFAULT '0' NOT NULL,

  color varchar(255) DEFAULT '' NOT NULL,

  tx_extbase_type varchar(255) DEFAULT '' NOT NULL,

);
#
# Table structure for table 'sys_file_reference'
#
CREATE TABLE sys_file_reference (

  media  int(11) unsigned DEFAULT '0' NOT NULL,

);
