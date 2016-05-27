CREATE TABLE `adminuser` (
  `usermd5` text NOT NULL,
  `user` text NOT NULL,
  `password` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `ticket_log` (
  `id` int(11) NOT NULL,
  `songid` text NOT NULL,
  `user` text NOT NULL,
  `message` text NOT NULL,
  `to` text NOT NULL,
  `time` text NOT NULL,
  `uptime` text NOT NULL,
  `ip` text NOT NULL,
  `info` int(11) NOT NULL DEFAULT '0',
  `uri` text,
  `option` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `adminuser`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ticket_log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `adminuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `ticket_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0