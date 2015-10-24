CREATE TABLE IF NOT EXISTS `bansong` (
  `songname` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `lostandfound` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `tel` text NOT NULL,
  `message` text NOT NULL,
  `uptime` text NOT NULL,
  `ip` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `adminuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `usermd5` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `setting` (
  `notice` text CHARACTER SET utf8 NOT NULL,
  `permission` int(11) NOT NULL,
  `cleantime` text CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ticket_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `songname` text CHARACTER SET utf8 NOT NULL,
  `user` text CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `to` text CHARACTER SET utf8 NOT NULL,
  `time` text CHARACTER SET utf8 NOT NULL,
  `uptime` text CHARACTER SET utf8 NOT NULL,
  `ip` text CHARACTER SET utf8 NOT NULL,
  `info` int(11) NOT NULL DEFAULT '0',
  `uri` text,
  `option` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ticket_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `songname` text CHARACTER SET utf8 NOT NULL,
  `user` text CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `to` text CHARACTER SET utf8 NOT NULL,
  `time` text CHARACTER SET utf8 NOT NULL,
  `uptime` text CHARACTER SET utf8 NOT NULL,
  `ip` text CHARACTER SET utf8 NOT NULL,
  `info` int(11) NOT NULL DEFAULT '0',
  `uri` text,
  `option` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;