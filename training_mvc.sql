CREATE TABLE `bans` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_ban` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `ma_nhan_vien` varchar(255) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `nam_sinh` varchar(4) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ban_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `bans`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banfr` (`ban_id`);

ALTER TABLE `bans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  ADD CONSTRAINT `banfr` FOREIGN KEY (`ban_id`) REFERENCES `bans` (`id`);