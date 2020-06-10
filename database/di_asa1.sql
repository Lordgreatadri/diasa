/*
Navicat MySQL Data Transfer

Source Server         : acv
Source Server Version : 50173
Source Host           : localhost:3306
Source Database       : di_asa

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2020-06-09 20:09:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for banner_gallery
-- ----------------------------
DROP TABLE IF EXISTS `banner_gallery`;
CREATE TABLE `banner_gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_image` text NOT NULL,
  `gallery_description` text NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for card_pay
-- ----------------------------
DROP TABLE IF EXISTS `card_pay`;
CREATE TABLE `card_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contestant_name` text,
  `number_of_votes` int(55) DEFAULT NULL,
  `vpc_amount` varchar(55) DEFAULT NULL,
  `vpc_batch_no` text,
  `vpc_merchant` text,
  `vpc_order_info` text,
  `vpc_txn_code` text,
  `vpc_transaction_no` text,
  `vpc_response_code` text,
  `vpc_message` text,
  `voter_number` text,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for channel_votes
-- ----------------------------
DROP TABLE IF EXISTS `channel_votes`;
CREATE TABLE `channel_votes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `contestant_num` varchar(255) DEFAULT NULL,
  `backlist` varchar(255) DEFAULT NULL,
  `num_of_votes` int(25) DEFAULT '0',
  `ussd` int(25) DEFAULT '0',
  `web` int(25) DEFAULT '0',
  `sms` int(25) DEFAULT '0',
  `app` int(25) DEFAULT '0',
  `thumbnail` text,
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for contestant_gallery
-- ----------------------------
DROP TABLE IF EXISTS `contestant_gallery`;
CREATE TABLE `contestant_gallery` (
  `contestant_gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `contestant_id` int(11) NOT NULL,
  `contestant_photo_url` text,
  PRIMARY KEY (`contestant_gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for contestants
-- ----------------------------
DROP TABLE IF EXISTS `contestants`;
CREATE TABLE `contestants` (
  `contestant_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` text,
  `num_of_votes` int(25) DEFAULT '0',
  `thumbnail` text,
  `profile` text,
  `height` text,
  `complexion` text,
  `contestant_num` varchar(255) DEFAULT NULL,
  `contestant_region` text,
  `status` varchar(25) DEFAULT 'not_evicted',
  `backlist` enum('True','False') DEFAULT 'False',
  `age` text,
  `video_url` text,
  `contestant_bio` text,
  `orientation` text,
  PRIMARY KEY (`contestant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for contestants_copy
-- ----------------------------
DROP TABLE IF EXISTS `contestants_copy`;
CREATE TABLE `contestants_copy` (
  `contestant_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` text,
  `num_of_votes` int(25) DEFAULT '0',
  `thumbnail` text,
  `profile` text,
  `height` text,
  `complexion` text,
  `contestant_num` varchar(255) DEFAULT NULL,
  `contestant_region` text,
  `status` varchar(25) DEFAULT 'not_evicted',
  `age` text,
  `video_url` text,
  `contestant_bio` text,
  `orientation` text,
  PRIMARY KEY (`contestant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for contestants_copy_copy
-- ----------------------------
DROP TABLE IF EXISTS `contestants_copy_copy`;
CREATE TABLE `contestants_copy_copy` (
  `contestant_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` text,
  `num_of_votes` int(25) DEFAULT '0',
  `thumbnail` text,
  `profile` text,
  `height` text,
  `complexion` text,
  `contestant_num` varchar(255) DEFAULT NULL,
  `contestant_region` text,
  `status` varchar(25) DEFAULT 'not_evicted',
  `age` text,
  `video_url` text,
  `contestant_bio` text,
  `orientation` text,
  PRIMARY KEY (`contestant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for contestants_weekly
-- ----------------------------
DROP TABLE IF EXISTS `contestants_weekly`;
CREATE TABLE `contestants_weekly` (
  `contestant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `num_of_votes` int(11) DEFAULT NULL,
  `thumbnail` text,
  `contestant_region` text,
  `contestant_num` varchar(255) DEFAULT NULL,
  `age` text,
  `status` text,
  `backlist` enum('True','False') DEFAULT 'False',
  PRIMARY KEY (`contestant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for contestants_weekly_copy
-- ----------------------------
DROP TABLE IF EXISTS `contestants_weekly_copy`;
CREATE TABLE `contestants_weekly_copy` (
  `contestant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `num_of_votes` int(11) DEFAULT NULL,
  `thumbnail` text,
  `contestant_region` text,
  `contestant_num` varchar(255) DEFAULT NULL,
  `age` text,
  `status` text,
  PRIMARY KEY (`contestant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for contestants_weekly_copy1
-- ----------------------------
DROP TABLE IF EXISTS `contestants_weekly_copy1`;
CREATE TABLE `contestants_weekly_copy1` (
  `contestant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `num_of_votes` int(11) DEFAULT NULL,
  `thumbnail` text,
  `contestant_region` text,
  `contestant_num` varchar(255) DEFAULT NULL,
  `age` text,
  `status` text,
  PRIMARY KEY (`contestant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for diasa_dashboard_users
-- ----------------------------
DROP TABLE IF EXISTS `diasa_dashboard_users`;
CREATE TABLE `diasa_dashboard_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` enum('admin','user') DEFAULT 'user',
  `user_signup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for diasa_pay
-- ----------------------------
DROP TABLE IF EXISTS `diasa_pay`;
CREATE TABLE `diasa_pay` (
  `pay_id` int(255) NOT NULL AUTO_INCREMENT,
  `transaction_id` text,
  `external_trans_id` text,
  `amt_after_charges` text,
  `charges` float DEFAULT NULL,
  `client_reference` text,
  `contestant_name` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `number_of_votes` int(11) DEFAULT NULL,
  `response_code` text,
  `number` varchar(255) DEFAULT NULL,
  `device` text,
  `channel` text,
  `description` text,
  `when` text,
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=532913 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for diasa_weekly
-- ----------------------------
DROP TABLE IF EXISTS `diasa_weekly`;
CREATE TABLE `diasa_weekly` (
  `pay_id` int(255) NOT NULL AUTO_INCREMENT,
  `response_code` text,
  `amt_after_charges` text,
  `client_reference` text,
  `description` text,
  `amount` float DEFAULT NULL,
  `number_of_votes` int(11) DEFAULT NULL,
  `charges` float DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `channel` text,
  `when` datetime DEFAULT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for diff_sum_all
-- ----------------------------
DROP TABLE IF EXISTS `diff_sum_all`;
CREATE TABLE `diff_sum_all` (
  `pay_id` int(255) NOT NULL AUTO_INCREMENT,
  `response_code` varchar(255) DEFAULT NULL,
  `amt_after_charges` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `client_reference` varchar(255) DEFAULT NULL,
  `contestant_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `external_trans_id` varchar(255) DEFAULT NULL,
  `amount` float(25,2) DEFAULT NULL,
  `number_of_votes` int(11) DEFAULT NULL,
  `charges` varchar(255) DEFAULT NULL,
  `number` varchar(25) DEFAULT NULL,
  `channel` varchar(255) DEFAULT NULL,
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=405825 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_brief` text NOT NULL,
  `news_image` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_mediatype` text NOT NULL,
  `news_detail` text NOT NULL,
  `news_vidlink` text NOT NULL,
  `event_status` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for gallery
-- ----------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_title` varchar(255) DEFAULT NULL,
  `gallery_image` text,
  PRIMARY KEY (`gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for live_stream
-- ----------------------------
DROP TABLE IF EXISTS `live_stream`;
CREATE TABLE `live_stream` (
  `stream_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` text NOT NULL,
  `push_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`stream_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mcc
-- ----------------------------
DROP TABLE IF EXISTS `mcc`;
CREATE TABLE `mcc` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `signup_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for online_successful_payment
-- ----------------------------
DROP TABLE IF EXISTS `online_successful_payment`;
CREATE TABLE `online_successful_payment` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `contestant_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `channel_type` varchar(255) DEFAULT NULL,
  `vote_count` int(255) NOT NULL,
  `amount` varchar(25) DEFAULT NULL,
  `response_code` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1252 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for past_queens
-- ----------------------------
DROP TABLE IF EXISTS `past_queens`;
CREATE TABLE `past_queens` (
  `queen_id` int(11) NOT NULL AUTO_INCREMENT,
  `season` varchar(255) NOT NULL,
  `queen_name` varchar(255) NOT NULL,
  `queen_age` varchar(255) NOT NULL,
  `queen_region` varchar(255) NOT NULL,
  `queen_url` text NOT NULL,
  PRIMARY KEY (`queen_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for signal
-- ----------------------------
DROP TABLE IF EXISTS `signal`;
CREATE TABLE `signal` (
  `sig_id` int(11) NOT NULL AUTO_INCREMENT,
  `signal_id` text NOT NULL,
  PRIMARY KEY (`sig_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12388 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sliders
-- ----------------------------
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_url` text NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sponsors
-- ----------------------------
DROP TABLE IF EXISTS `sponsors`;
CREATE TABLE `sponsors` (
  `sponsor_id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsor_name` text NOT NULL,
  `sponsor_email` text NOT NULL,
  `sponsor_location` text NOT NULL,
  `sponsor_description` text NOT NULL,
  `sponsor_image` text NOT NULL,
  PRIMARY KEY (`sponsor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for successful_payment
-- ----------------------------
DROP TABLE IF EXISTS `successful_payment`;
CREATE TABLE `successful_payment` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `contestant_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `channel_type` varchar(255) DEFAULT NULL,
  `vote_count` int(255) DEFAULT NULL,
  `amount` varchar(25) DEFAULT NULL,
  `response_code` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2394 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for temp_category_process
-- ----------------------------
DROP TABLE IF EXISTS `temp_category_process`;
CREATE TABLE `temp_category_process` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `contestant_code` varchar(255) DEFAULT NULL,
  `contestant_name` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `phone_number` varchar(25) DEFAULT NULL,
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for temp_monitor_online_payment
-- ----------------------------
DROP TABLE IF EXISTS `temp_monitor_online_payment`;
CREATE TABLE `temp_monitor_online_payment` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `contestant_code` varchar(255) DEFAULT NULL,
  `contestant_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `channel_type` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `response_code` varchar(255) DEFAULT NULL,
  `res_code` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT 'Ooops, something happened. Could not process payment',
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2162 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for temp_monitor_payment
-- ----------------------------
DROP TABLE IF EXISTS `temp_monitor_payment`;
CREATE TABLE `temp_monitor_payment` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `contestant_code` varchar(255) DEFAULT NULL,
  `contestant_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `channel_type` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `response_code` varchar(255) DEFAULT NULL,
  `res_code` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT 'Ooops, something happened. Could not process payment',
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118410 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for temp_payment_handuler
-- ----------------------------
DROP TABLE IF EXISTS `temp_payment_handuler`;
CREATE TABLE `temp_payment_handuler` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `initiator` varchar(255) DEFAULT NULL,
  `paying_number` varchar(25) DEFAULT NULL,
  `paying_amount` varchar(255) DEFAULT NULL,
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for track_level
-- ----------------------------
DROP TABLE IF EXISTS `track_level`;
CREATE TABLE `track_level` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `initiator` varchar(255) DEFAULT NULL,
  `payer_phone` varchar(255) DEFAULT NULL,
  `nominee_id` int(25) DEFAULT NULL,
  `nominee_code` varchar(255) DEFAULT NULL,
  `nominee_name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5394 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for track_pay
-- ----------------------------
DROP TABLE IF EXISTS `track_pay`;
CREATE TABLE `track_pay` (
  `track_id` int(11) NOT NULL AUTO_INCREMENT,
  `transac_id` text,
  `device` text,
  `nominee_name` text,
  `number` varchar(255) DEFAULT NULL,
  `channel` varchar(255) DEFAULT NULL,
  `number_of_votes` int(25) DEFAULT NULL,
  `amount` text,
  `when` text,
  PRIMARY KEY (`track_id`)
) ENGINE=MyISAM AUTO_INCREMENT=649890 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(35) NOT NULL,
  `msisdn` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `transaction_date` text NOT NULL,
  `status` text NOT NULL,
  `transaction_mode` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for videos
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `sub_title` text,
  `video_url` text,
  `video_thumbnail` text,
  PRIMARY KEY (`video_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for voda_pay
-- ----------------------------
DROP TABLE IF EXISTS `voda_pay`;
CREATE TABLE `voda_pay` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `initiator` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `date_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1747 DEFAULT CHARSET=latin1;
