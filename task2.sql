

CREATE TABLE `task` (
  `id_task` int(11) NOT NULL,
  `name_task` varchar(50) NOT NULL,
  `content_task` text NOT NULL,
  `date_task` date NOT NULL,
  `valid_task` tinyint(1) DEFAULT '0',
  `id_util` int(11) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `name_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `utilisateur` (
  `id_util` int(11) NOT NULL,
  `name_util` varchar(50) NOT NULL,
  `first_name_util` varchar(50) NOT NULL,
  `login_util` varchar(50) NOT NULL,
  `mdp_util` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `utilisateur2` (
  `id_util` int(50) NOT NULL,
  `nom_util` varchar(50) NOT NULL,
  `first_name_util` varchar(50) NOT NULL,
  `login_util` varchar(50) NOT NULL,
  `mdp_util` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `task_utilisateur_FK` (`id_util`),
  ADD KEY `task_type0_FK` (`id_type`);

ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_util`);

ALTER TABLE `utilisateur2`
  ADD PRIMARY KEY (`id_util`);


ALTER TABLE `task`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `utilisateur`
  MODIFY `id_util` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `utilisateur2`
  MODIFY `id_util` int(50) NOT NULL AUTO_INCREMENT;


ALTER TABLE `task`
  ADD CONSTRAINT `task_type0_FK` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`),
  ADD CONSTRAINT `task_utilisateur_FK` FOREIGN KEY (`id_util`) REFERENCES `utilisateur` (`id_util`);
