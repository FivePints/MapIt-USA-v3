-- phpMyAdmin SQL Dump
-- version 3.5.0-beta1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2012 at 11:55 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mapit_stage`
--

-- --------------------------------------------------------

--
-- Table structure for table `map_advertisements`
--

CREATE TABLE IF NOT EXISTS `map_advertisements` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `youtube_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `timestamp` int(11) NOT NULL,
  `type` enum('picture','video') NOT NULL DEFAULT 'video',
  `filename` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` varchar(64) NOT NULL,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_advertisements_click_log`
--

CREATE TABLE IF NOT EXISTS `map_advertisements_click_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `ip_address` varchar(15) NOT NULL DEFAULT '',
  `browser` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_announcements`
--

CREATE TABLE IF NOT EXISTS `map_announcements` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_by` smallint(6) NOT NULL,
  `expire_timestamp` int(11) NOT NULL,
  `message_type` enum('success','error','warning','information','note') NOT NULL DEFAULT 'warning',
  `hideable` enum('0','1') NOT NULL DEFAULT '1',
  `admin_viewable` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_categories`
--

CREATE TABLE IF NOT EXISTS `map_categories` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `categoryCount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=187 ;

--
-- Dumping data for table `map_categories`
--

INSERT INTO `map_categories` (`id`, `category_name`, `timestamp`, `categoryCount`) VALUES
(17, 'TELEPHONE - ANSWERING SERVICE', 2012, 0),
(18, 'TELECOMMUNICATIONS - SATELLITE', 2012, 0),
(19, 'TAX PREPARATION', 2012, 0),
(20, 'SWIMMING POOL SERVICE', 2012, 0),
(21, 'SPORTS/ACTIVITIES', 2012, 0),
(22, 'SOFTWARE - TECHNOLOGY', 2012, 0),
(23, 'SOFTWARE -  CONSULTING', 2012, 0),
(24, 'SMALL BUSINESS COMPLIANCE', 2012, 0),
(25, 'SIGNS & BANNERS', 2012, 0),
(26, 'SHOPPING CENTER', 2012, 0),
(27, 'SELF STORAGE & TRUCK RENTALS', 2012, 0),
(28, 'SELF STORAGE - BOAT & RV', 2012, 0),
(29, 'SCREEN PRINTING', 2012, 0),
(30, 'SCHOOLS -PUBLIC', 2011, 0),
(31, 'SCHOOLS - PUBLIC', 2012, 0),
(32, 'SCHOOLS - PRE-SCHOOL', 2012, 0),
(33, 'SCHOOLS - MUSIC', 2012, 0),
(34, 'SCHOOLS - MONTESSORI', 2012, 0),
(35, 'SCHOOLS - DAY CARE', 2012, 0),
(36, 'SCHOOLS - CHARTER', 2012, 0),
(37, 'SCHOOLS', 2012, 0),
(38, 'SALON & SPA', 2012, 0),
(39, 'RETAIL - WOMENS SPECIALITY', 2011, 0),
(40, 'RETAIL - TOY/HOBBY STORE', 2012, 0),
(41, 'RETAIL - SPECIALTY', 2012, 0),
(42, 'RETAIL - GROCERY', 2011, 0),
(43, 'RETAIL - GPS TRACKING DEVICES AND SERVICE', 2012, 0),
(44, 'RETAIL', 2012, 10),
(45, 'RESTORATION', 2012, 0),
(46, 'RESTAURANTS -BAR', 2011, 0),
(47, 'RESTAURANTS - ICE CREAM & FROZEN DESSERTS', 2012, 0),
(48, 'RESTAURANTS - BAR', 2012, 0),
(49, 'RESTAURANTS', 2012, 30),
(50, 'REAL ESTATE - PROPERTY MANAGEMENT', 2012, 0),
(51, 'REAL ESTATE - DEVELOPERS', 2012, 0),
(52, 'REAL ESTATE - BUSINESS BROKER', 2011, 0),
(53, 'REAL ESTATE - APPRAISERS COMMERCIAL', 2012, 0),
(54, 'REAL ESTATE', 2012, 10),
(55, 'PRINTERS', 2012, 0),
(56, 'PRESSURE WASHING', 2011, 0),
(57, 'PHYSICIANS - URGENT CARE', 2012, 0),
(58, 'PHYSICIANS - PODIATRISTS', 2012, 0),
(59, 'PHYSICIANS - PEDIATRIC ENDOCRINE', 2012, 0),
(60, 'PHYSICIANS - OBSTETRICS/GYNECOLOGY', 2011, 0),
(61, 'PHYSICIANS - FAMILY PRACTICE', 2012, 0),
(62, 'PHYSICIANS - CARDIOLOGY', 2011, 0),
(63, 'PHYSICIANS', 2012, 0),
(64, 'PHOTOGRAPHERS', 2012, 0),
(65, 'PETS - WASTE CLEANUP & REMOVAL SERVICES', 2011, 0),
(66, 'PETS - GROOMING', 2011, 0),
(67, 'PETS', 2012, 0),
(68, 'PEST CONTROL SERVICES', 2012, 0),
(69, 'PAPER SHREDDING', 2012, 0),
(70, 'OTHER', 2012, 20),
(71, 'ORTHODONTISTS', 2012, 0),
(72, 'OPTOMETRISTS', 2012, 0),
(73, 'NOTARY SERVICE', 2012, 0),
(74, 'NON-PROFIT - AFFORDABLE HOUSING PROVIDER', 2012, 0),
(75, 'NON-PROFIT', 2012, 0),
(77, 'MORTGAGE - BROKER', 2012, 0),
(78, 'MEETING, BANQUET FACILITIES & RECEPTION SITES', 2012, 0),
(79, 'MEDICAL/HEALTH', 2012, 0),
(80, 'MEDICAL CENTERS', 2012, 0),
(81, 'MEDICAL BILLING', 2012, 0),
(82, 'MASSAGE THERAPY', 2012, 0),
(83, 'MANUFACTURERS', 2012, 0),
(84, 'MAIL SERVICES', 2012, 0),
(85, 'LANDSCAPE - MATERIALS', 2012, 0),
(86, 'LANDSCAPE - CONSTRUCTION', 2012, 0),
(87, 'LANDSCAPE', 2012, 0),
(88, 'JEWELRY - JEWELERS', 2012, 0),
(89, 'JEWELRY - DISTRIBUTERS', 2012, 0),
(90, 'JANITORIAL SERVICES-RESIDENTIAL/COMMERCIAL', 2012, 0),
(91, 'INTERNET SERVICE PROVIDER', 2012, 0),
(92, 'INSURANCE -HEALTH & LIFE', 2011, 0),
(93, 'INSURANCE - WHOLESALE', 2011, 0),
(94, 'INSURANCE - PROPERTY & CASUALTY', 2012, 0),
(95, 'INSURANCE - HEALTH & LIFE', 2011, 0),
(96, 'INSURANCE - BROKERS', 2012, 0),
(97, 'INSURANCE', 2012, 0),
(98, 'INSPECTIONS - HOME & COMMERCIAL', 2011, 0),
(99, 'INFORMATION TECHNOLOGY', 2011, 0),
(100, 'INDUSTRIAL/OCCUPATIONAL HEALTH', 2012, 0),
(101, 'HOTELS/MOTELS & RESORTS', 2012, 0),
(102, 'HOSPITALS', 2012, 0),
(103, 'HOSPICE', 2012, 0),
(104, 'HEALTHCARE', 2012, 0),
(105, 'HEALTH & WELLNESS -HORSE THERAPY', 2012, 0),
(106, 'HEALTH & WELLNESS', 2012, 10),
(107, 'HARDWARE/HOME IMPROVEMENT', 2012, 0),
(108, 'HANDYMAN SERVICES', 2011, 0),
(109, 'GRAPHIC DESIGN SERVICES', 2012, 0),
(110, 'GOVERNMENT', 2011, 0),
(111, 'Gourmet Cakes', 2012, 0),
(112, 'GOLF COURSES', 2011, 0),
(113, 'GIFTS - BASKETS', 2012, 0),
(114, 'GARDEN CENTERS & NURSERIES', 2012, 0),
(115, 'FURNITURE', 2012, 0),
(116, 'FUNERAL HOMES', 2012, 0),
(117, 'FLORIST', 2012, 0),
(118, 'FLOORING - HARDWOOD', 2012, 0),
(119, 'FLOORING', 2011, 0),
(120, 'FINANCIAL SERVICES - BUSINESS RETIREMENT PLANS', 2012, 0),
(121, 'FINANCIAL SERVICES', 2012, 0),
(122, 'FINANCIAL PLANNING & SERVICES', 2012, 0),
(123, 'FARMS/FARM MANAGEMENT', 2011, 0),
(124, 'EQUIPMENT - FIRE', 2012, 0),
(125, 'ENTERTAINMENT - RECREATION', 2012, 0),
(126, 'ENTERTAINMENT - PERFORMING ARTS', 2011, 0),
(127, 'EMPLOYEE BENEFITS', 2012, 0),
(128, 'EDUCATIONAL SERVICES', 2012, 0),
(129, 'DRIVERS EDUCATION SCHOOL', 2012, 0),
(130, 'DISCOUNT CLUBS', 2012, 0),
(131, 'DEPARTMENT STORES', 2012, 0),
(132, 'DENTISTS', 2012, 0),
(133, 'DENTIST - ENDODONTICS', 2011, 0),
(134, 'DANCE - STUDIO', 2012, 0),
(135, 'CREDIT UNIONS', 2012, 0),
(136, 'CPA FIRMS', 2011, 0),
(139, 'CONTRACTORS - SWIMMING POOL', 2012, 0),
(140, 'CONTRACTORS - GENERAL', 2012, 0),
(141, 'CONTRACTORS - ELECTRICAL', 2011, 0),
(142, 'CONSULTANTS - BUSINESS', 2012, 0),
(143, 'CONSULTANTS', 2012, 10),
(144, 'CONSTRUCTION - SUPPLIES', 2012, 0),
(145, 'COMPUTER CONSULTING, DESIGN, SERVICE, SALES & REPAIR', 2012, 0),
(146, 'COMPUTER CONSULTING', 2011, 0),
(147, 'CLEANING SERVICES', 2012, 0),
(148, 'CHURCHES', 2012, 0),
(149, 'CHIROPRACTORS - WELLNESS', 2012, 0),
(150, 'CHILDCARE', 2012, 0),
(151, 'CATTLE FEED COMODITY SALES', 2012, 0),
(152, 'CATERERS', 2012, 0),
(153, 'CARPET AND TILE CLEANING', 2011, 0),
(154, 'CAR WASH', 2011, 0),
(155, 'CANDLES & SOAP', 2011, 0),
(156, 'BOUTIQUES', 2011, 0),
(157, 'BATTERIES - RETAIL, WHOLESALE & MANUFACTURERS', 2012, 0),
(158, 'BANKS', 2012, 10),
(159, 'AWARDS & TROPHIES', 2012, 0),
(160, 'AUTOMOTIVE - TIRES', 2011, 0),
(161, 'AUTOMOTIVE - SPECIALTY', 2012, 0),
(162, 'AUTOMOTIVE - SALES & SERVICE', 2012, 0),
(163, 'AUTOMOTIVE - REPAIRS & SERVICE', 2012, 0),
(164, 'AUTOMOTIVE - BODY REPAIR', 2012, 0),
(165, 'AUTOMOTIVE', 2012, 0),
(166, 'ATTORNEYS', 2012, 0),
(167, 'ASSOCIATIONS/ORGANIZATIONS', 2012, 0),
(168, 'ASSISTED LIVING RESIDENCE', 2012, 0),
(169, 'ART STUDIO', 2011, 0),
(170, 'ART GALLERIES/FRAMING', 2012, 0),
(177, 'TECHNOLOGY INTEGRATIONS', 2012, 0),
(179, 'BOUTIQUE', 2012, 10),
(180, 'HOME IMPROVEMENT', 2012, 0),
(186, 'WINDOW TINTING', 1333939909, 0);

-- --------------------------------------------------------

--
-- Table structure for table `map_ci_sessions`
--

CREATE TABLE IF NOT EXISTS `map_ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `map_config`
--

CREATE TABLE IF NOT EXISTS `map_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activationkey` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lastchecked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `site_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marker_icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_key` text COLLATE utf8_unicode_ci NOT NULL,
  `tab_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default_zoom` smallint(2) NOT NULL,
  `default_map_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_map_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_lat` double NOT NULL,
  `default_lng` double NOT NULL,
  `default_send_from_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_send_from_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ipn_email_bcc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the bcc email address for processing payments',
  `ipn_email_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the email address that is shown as the messages being sent from for payments',
  `ipn_email_from_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the display name of the from email address for processing payments',
  `ipn_email_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the subject of the email when its sent',
  `memberQuestion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `events` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `map_config`
--

INSERT INTO `map_config` (`id`, `activationkey`, `lastchecked`, `site_title`, `site_name`, `marker_icon`, `api_key`, `tab_title`, `default_zoom`, `default_map_id`, `default_map_type`, `default_lat`, `default_lng`, `default_send_from_name`, `default_send_from_email`, `ipn_email_bcc`, `ipn_email_from`, `ipn_email_from_name`, `ipn_email_subject`, `memberQuestion`, `events`) VALUES
(1, 'fcd0c7c0824391557f6b63eecf425450e5f25a7d', '2012-04-13 18:55:03', 'MapIt USA', 'MapIt USA Demo', 'marker_icon.png', 'AIzaSyDvkV5V4RinAIN2i03ZljopfnlHn8hoPIM', 'Company', 10, 'map_canvas', 'ROADMAP', 33.35193, -111.821087, 'MapIt USA Demo', 'no-reply@mapitusa.com', 'mdevita@fivepints.com', '', '[noreply] MapIt USA Demo', 'Order Confirmation', 'MapIt USA Demo', '0');

-- --------------------------------------------------------

--
-- Table structure for table `map_email_queue`
--

CREATE TABLE IF NOT EXISTS `map_email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(500) NOT NULL,
  `from_name` text NOT NULL,
  `from_email` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `added_on` int(11) NOT NULL,
  `to_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_fields`
--

CREATE TABLE IF NOT EXISTS `map_fields` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `html_template` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=35 ;

--
-- Dumping data for table `map_fields`
--

INSERT INTO `map_fields` (`id`, `fieldname`, `timestamp`, `html_template`) VALUES
(1, 'website', '2011-12-08 17:23:32', '<a href="{website}" target="_blank">{website}</a>'),
(10, 'twitter', '2011-12-07 17:23:08', '<a href="http://www.twitter.com/{twitter}">@{twitter}</a>'),
(11, 'facebook', '2011-12-07 17:40:03', '<a href="http://www.twitter.com/{facebook}">@{facebook}</a>'),
(12, 'linkedin', '2011-12-07 17:40:27', '<a href="http://www.twitter.com/{linkedin}">@{linkedin}</a>'),
(13, 'youtube', '2011-12-07 17:40:35', '{youtube}'),
(14, 'googleplus', '2011-12-07 17:40:44', '{googleplus}'),
(15, 'logo', '2011-12-07 19:07:25', '<img src="http://dev.mapitusa.com/uploads/{logo}" class="popup-company-logo" />'),
(16, 'image1', '2011-12-07 17:41:33', '<img src="http://dev.mapitusa.com/uploads/{image1}"/>'),
(17, 'image2', '2011-12-07 17:41:53', '<img src="http://dev.mapitusa.com/uploads/{image2}"/>'),
(19, 'companyname', '2011-12-07 19:07:47', '<h3 class="popup-company-name">{companyname}</h3>'),
(20, 'contactname', '2011-12-07 19:08:21', '<p class="popup-contact-name"><strong>{contactname}</strong></p>'),
(21, 'address1', '2011-12-07 19:09:09', '<address class="popup-company-address">{address1}'),
(22, 'address2', '2011-12-07 19:09:20', '{address2}'),
(23, 'city', '2011-12-07 19:09:48', '{city}'),
(25, 'state', '2011-12-07 19:10:04', '{state}'),
(26, 'zip', '2011-12-07 19:10:09', '{zip}'),
(28, 'phone1', '2011-12-07 19:11:57', '{phone1}'),
(29, 'phone2', '2011-12-07 19:12:25', '{phone2}'),
(30, 'fax', '2011-12-07 19:12:09', '{fax}'),
(31, 'email', '2011-12-07 19:12:43', '{email}'),
(32, 'youtubevideo', '2011-12-22 18:48:34', '{youtubevideo}'),
(33, 'tab1', '2011-12-23 04:40:04', '{tab1}'),
(34, 'tab2', '2012-03-11 18:32:10', '<iframe src="//www.facebook.com/plugins/likebox.php?href={tab2}&amp;width=415&amp;height=300&amp;colorscheme=light&amp;show_faces=true&amp;border_color=#FFFFFF&amp;stream=true&amp;header=true&amp;appId=138413959602171" scrolling="yes" frameborder="0" style="border:none; overflow:hidden; width:415px; height:300px;" allowTransparency="true"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `map_ipn_log`
--

CREATE TABLE IF NOT EXISTS `map_ipn_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listener_name` varchar(3) DEFAULT NULL COMMENT 'Either IPN or API',
  `transaction_type` varchar(16) DEFAULT NULL COMMENT 'The type of call being made to the listener',
  `transaction_id` varchar(19) DEFAULT NULL COMMENT 'The unique transaction ID generated by PayPal',
  `status` varchar(16) DEFAULT NULL COMMENT 'The status of the call',
  `message` varchar(512) DEFAULT NULL COMMENT 'Explanation of the call status',
  `ipn_data_hash` varchar(32) DEFAULT NULL COMMENT 'MD5 hash of the IPN post data',
  `detail` text COMMENT 'Detail text (potentially JSON) on this call',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_ipn_orders`
--

CREATE TABLE IF NOT EXISTS `map_ipn_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notify_version` varchar(64) DEFAULT NULL COMMENT 'IPN Version Number',
  `verify_sign` varchar(127) DEFAULT NULL COMMENT 'Encrypted string used to verify the authenticityof the tansaction',
  `test_ipn` int(11) DEFAULT NULL,
  `protection_eligibility` varchar(24) DEFAULT NULL COMMENT 'Which type of seller protection the buyer is protected by',
  `charset` varchar(127) DEFAULT NULL COMMENT 'Character set used by PayPal',
  `btn_id` varchar(40) DEFAULT NULL COMMENT 'The PayPal buy button clicked',
  `address_city` varchar(40) DEFAULT NULL COMMENT 'City of customers address',
  `address_country` varchar(64) DEFAULT NULL COMMENT 'Country of customers address',
  `address_country_code` varchar(2) DEFAULT NULL COMMENT 'Two character ISO 3166 country code',
  `address_name` varchar(128) DEFAULT NULL COMMENT 'Name used with address (included when customer provides a Gift address)',
  `address_state` varchar(40) DEFAULT NULL COMMENT 'State of customer address',
  `address_status` varchar(20) DEFAULT NULL COMMENT 'confirmed/unconfirmed',
  `address_street` varchar(200) DEFAULT NULL COMMENT 'Customer''s street address',
  `address_zip` varchar(20) DEFAULT NULL COMMENT 'Zip code of customer''s address',
  `first_name` varchar(64) DEFAULT NULL COMMENT 'Customer''s first name',
  `last_name` varchar(64) DEFAULT NULL COMMENT 'Customer''s last name',
  `payer_business_name` varchar(127) DEFAULT NULL COMMENT 'Customer''s company name, if customer represents a business',
  `payer_email` varchar(127) DEFAULT NULL COMMENT 'Customer''s primary email address. Use this email to provide any credits',
  `payer_id` varchar(13) DEFAULT NULL COMMENT 'Unique customer ID.',
  `payer_status` varchar(20) DEFAULT NULL COMMENT 'verified/unverified',
  `contact_phone` varchar(20) DEFAULT NULL COMMENT 'Customer''s telephone number.',
  `residence_country` varchar(2) DEFAULT NULL COMMENT 'Two-Character ISO 3166 country code',
  `business` varchar(127) DEFAULT NULL COMMENT 'Email address or account ID of the payment recipient (that is, the merchant). Equivalent to the values of receiver_email (If payment is sent to primary account) and business set in the Website Payment HTML.',
  `receiver_email` varchar(127) DEFAULT NULL COMMENT 'Primary email address of the payment recipient (that is, the merchant). If the payment is sent to a non-primary email address on your PayPal account, the receiver_email is still your primary email.',
  `receiver_id` varchar(13) DEFAULT NULL COMMENT 'Unique account ID of the payment recipient (i.e., the merchant). This is the same as the recipients referral ID.',
  `custom` varchar(255) DEFAULT NULL COMMENT 'Custom value as passed by you, the merchant. These are pass-through variables that are never presented to your customer.',
  `invoice` varchar(127) DEFAULT NULL COMMENT 'Pass through variable you can use to identify your invoice number for this purchase. If omitted, no variable is passed back.',
  `memo` varchar(255) DEFAULT NULL COMMENT 'Memo as entered by your customer in PayPal Website Payments note field.',
  `tax` decimal(10,2) DEFAULT NULL COMMENT 'Amount of tax charged on payment',
  `auth_id` varchar(19) DEFAULT NULL COMMENT 'Authorization identification number',
  `auth_exp` varchar(28) DEFAULT NULL COMMENT 'Authorization expiration date and time, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
  `auth_amount` int(11) DEFAULT NULL COMMENT 'Authorization amount',
  `auth_status` varchar(20) DEFAULT NULL COMMENT 'Status of authorization',
  `num_cart_items` int(11) DEFAULT NULL COMMENT 'If this is a PayPal shopping cart transaction, number of items in the cart',
  `parent_txn_id` varchar(19) DEFAULT NULL COMMENT 'In the case of a refund, reversal, or cancelled reversal, this variable contains the txn_id of the original transaction, while txn_id contains a new ID for the new transaction.',
  `payment_date` varchar(28) DEFAULT NULL COMMENT 'Time/date stamp generated by PayPal, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
  `payment_status` varchar(20) DEFAULT NULL COMMENT 'Payment status of the payment',
  `payment_type` varchar(10) DEFAULT NULL COMMENT 'echeck/instant',
  `pending_reason` varchar(20) DEFAULT NULL COMMENT 'This variable is only set if payment_status=pending',
  `reason_code` varchar(20) DEFAULT NULL COMMENT 'This variable is only set if payment_status=reversed',
  `remaining_settle` int(11) DEFAULT NULL COMMENT 'Remaining amount that can be captured with Authorization and Capture',
  `shipping_method` varchar(64) DEFAULT NULL COMMENT 'The name of a shipping method from the shipping calculations section of the merchants account profile. The buyer selected the named shipping method for this transaction',
  `shipping` decimal(10,2) DEFAULT NULL COMMENT 'Shipping charges associated with this transaction. Format unsigned, no currency symbol, two decimal places',
  `transaction_entity` varchar(20) DEFAULT NULL COMMENT 'Authorization and capture transaction entity',
  `txn_id` varchar(19) DEFAULT NULL COMMENT 'A unique transaction ID generated by PayPal',
  `txn_type` varchar(20) DEFAULT NULL COMMENT 'cart/express_checkout/send-money/virtual-terminal/web-accept',
  `exchange_rate` decimal(10,2) DEFAULT NULL COMMENT 'Exchange rate used if a currency conversion occured',
  `mc_currency` varchar(3) DEFAULT NULL COMMENT 'Three character country code. For payment IPN notifications, this is the currency of the payment, for non-payment subscription IPN notifications, this is the currency of the subscription.',
  `mc_fee` decimal(10,2) DEFAULT NULL COMMENT 'Transaction fee associated with the payment, mc_gross minus mc_fee equals the amount deposited into the receiver_email account. Equivalent to payment_fee for USD payments. If this amount is negative, it signifies a refund or reversal, and either ofthose p',
  `mc_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full amount of the customer''s payment',
  `mc_handling` decimal(10,2) DEFAULT NULL COMMENT 'Total handling charge associated with the transaction',
  `mc_shipping` decimal(10,2) DEFAULT NULL COMMENT 'Total shipping amount associated with the transaction',
  `payment_fee` decimal(10,2) DEFAULT NULL COMMENT 'USD transaction fee associated with the payment',
  `payment_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full USD amount of the customers payment transaction, before payment_fee is subtracted',
  `settle_amount` decimal(10,2) DEFAULT NULL COMMENT 'Amount that is deposited into the account''s primary balance after a currency conversion',
  `settle_currency` varchar(3) DEFAULT NULL COMMENT 'Currency of settle amount. Three digit currency code',
  `auction_buyer_id` varchar(64) DEFAULT NULL COMMENT 'The customer''s auction ID.',
  `auction_closing_date` varchar(28) DEFAULT NULL COMMENT 'The auction''s close date. In the format: HH:MM:SS DD Mmm YY, YYYY PSD',
  `auction_multi_item` int(11) DEFAULT NULL COMMENT 'The number of items purchased in multi-item auction payments',
  `for_auction` varchar(10) DEFAULT NULL COMMENT 'This is an auction payment - payments made using Pay for eBay Items or Smart Logos - as well as send money/money request payments with the type eBay items or Auction Goods(non-eBay)',
  `subscr_date` varchar(28) DEFAULT NULL COMMENT 'Start date or cancellation date depending on whether txn_type is subcr_signup or subscr_cancel',
  `subscr_effective` varchar(28) DEFAULT NULL COMMENT 'Date when a subscription modification becomes effective',
  `period1` varchar(10) DEFAULT NULL COMMENT '(Optional) Trial subscription interval in days, weeks, months, years (example a 4 day interval is 4 D',
  `period2` varchar(10) DEFAULT NULL COMMENT '(Optional) Trial period',
  `period3` varchar(10) DEFAULT NULL COMMENT 'Regular subscription interval in days, weeks, months, years',
  `amount1` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for Trial period 1 for USD',
  `amount2` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for Trial period 2 for USD',
  `amount3` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for regular subscription  period 1 for USD',
  `mc_amount1` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for trial period 1 regardless of currency',
  `mc_amount2` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for trial period 2 regardless of currency',
  `mc_amount3` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for regular subscription period regardless of currency',
  `recurring` varchar(1) DEFAULT NULL COMMENT 'Indicates whether rate recurs (1 is yes, blank is no)',
  `reattempt` varchar(1) DEFAULT NULL COMMENT 'Indicates whether reattempts should occur on payment failure (1 is yes, blank is no)',
  `retry_at` varchar(28) DEFAULT NULL COMMENT 'Date PayPal will retry a failed subscription payment',
  `recur_times` int(11) DEFAULT NULL COMMENT 'The number of payment installations that will occur at the regular rate',
  `username` varchar(64) DEFAULT NULL COMMENT '(Optional) Username generated by PayPal and given to subscriber to access the subscription',
  `password` varchar(24) DEFAULT NULL COMMENT '(Optional) Password generated by PayPal and given to subscriber to access the subscription (Encrypted)',
  `subscr_id` varchar(19) DEFAULT NULL COMMENT 'ID generated by PayPal for the subscriber',
  `case_id` varchar(28) DEFAULT NULL COMMENT 'Case identification number',
  `case_type` varchar(28) DEFAULT NULL COMMENT 'complaint/chargeback',
  `case_creation_date` varchar(28) DEFAULT NULL COMMENT 'Date/Time the case was registered',
  `order_status` enum('PAID','WAITING','REJECTED') DEFAULT NULL COMMENT 'Additional variable to make payment_status more actionable',
  `discount` decimal(10,2) DEFAULT NULL COMMENT 'Additional variable to record the discount made on the order',
  `shipping_discount` decimal(10,2) DEFAULT NULL COMMENT 'Record the discount made on the shipping',
  `ipn_track_id` varchar(127) DEFAULT NULL COMMENT 'Internal tracking variable added in April 2011',
  `transaction_subject` varchar(255) DEFAULT NULL COMMENT 'Describes the product for a button-based purchase',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UniqueTransactionID` (`txn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_ipn_order_items`
--

CREATE TABLE IF NOT EXISTS `map_ipn_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `item_name` varchar(127) DEFAULT NULL COMMENT 'Item name as passed by you, the merchant. Or, if not passed by you, as entered by your customer. If this is a shopping cart transaction, Paypal will append the number of the item (e.g., item_name_1,item_name_2, and so forth).',
  `item_number` varchar(127) DEFAULT NULL COMMENT 'Pass-through variable for you to track purchases. It will get passed back to you at the completion of the payment. If omitted, no variable will be passed back to you.',
  `quantity` varchar(127) DEFAULT NULL COMMENT 'Quantity as entered by your customer or as passed by you, the merchant. If this is a shopping cart transaction, PayPal appends the number of the item (e.g., quantity1,quantity2).',
  `mc_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full amount of the customer''s payment',
  `mc_handling` decimal(10,2) DEFAULT NULL COMMENT 'Total handling charge associated with the transaction',
  `mc_shipping` decimal(10,2) DEFAULT NULL COMMENT 'Total shipping amount associated with the transaction',
  `tax` decimal(10,2) DEFAULT NULL COMMENT 'Amount of tax charged on payment',
  `cost_per_item` decimal(10,2) DEFAULT NULL COMMENT 'Cost of an individual item',
  `option_name_1` varchar(64) DEFAULT NULL COMMENT 'Option 1 name as requested by you',
  `option_selection_1` varchar(200) DEFAULT NULL COMMENT 'Option 1 choice as entered by your customer',
  `option_name_2` varchar(64) DEFAULT NULL COMMENT 'Option 2 name as requested by you',
  `option_selection_2` varchar(200) DEFAULT NULL COMMENT 'Option 2 choice as entered by your customer',
  `option_name_3` varchar(64) DEFAULT NULL COMMENT 'Option 3 name as requested by you',
  `option_selection_3` varchar(200) DEFAULT NULL COMMENT 'Option 3 choice as entered by your customer',
  `option_name_4` varchar(64) DEFAULT NULL COMMENT 'Option 4 name as requested by you',
  `option_selection_4` varchar(200) DEFAULT NULL COMMENT 'Option 4 choice as entered by your customer',
  `option_name_5` varchar(64) DEFAULT NULL COMMENT 'Option 5 name as requested by you',
  `option_selection_5` varchar(200) DEFAULT NULL COMMENT 'Option 5 choice as entered by your customer',
  `option_name_6` varchar(64) DEFAULT NULL COMMENT 'Option 6 name as requested by you',
  `option_selection_6` varchar(200) DEFAULT NULL COMMENT 'Option 6 choice as entered by your customer',
  `option_name_7` varchar(64) DEFAULT NULL COMMENT 'Option 7 name as requested by you',
  `option_selection_7` varchar(200) DEFAULT NULL COMMENT 'Option 7 choice as entered by your customer',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `map_levels`
--

CREATE TABLE IF NOT EXISTS `map_levels` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `levelname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `allowed_fields` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `min_width` smallint(3) NOT NULL,
  `max_width` smallint(3) NOT NULL,
  `min_height` smallint(3) NOT NULL,
  `max_height` smallint(3) NOT NULL,
  `video_width` smallint(3) NOT NULL,
  `video_height` smallint(3) NOT NULL,
  `number_tabs` smallint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=5 ;

--
-- Dumping data for table `map_levels`
--

INSERT INTO `map_levels` (`id`, `levelname`, `cost`, `timestamp`, `allowed_fields`, `min_width`, `max_width`, `min_height`, `max_height`, `video_width`, `video_height`, `number_tabs`) VALUES
(1, 'Level 1', '0', '2011-12-29 05:14:58', '19,20,21,22,23,25,26,28,29,30,31', 200, 200, 220, 900, 0, 0, 0),
(2, 'Level 2', '30', '2011-12-29 05:15:07', '1,10,11,12,13,14,15,19,20,21,22,23,25,26,28,29,30,31', 420, 426, 220, 900, 0, 0, 1),
(3, 'Level 3', '60', '2011-12-29 05:13:45', '1,10,11,12,13,14,15,16,17,19,20,21,22,23,25,26,28,29,30,31,33,34', 420, 426, 220, 900, 247, 168, 2),
(4, 'Level 4', '120', '2012-01-06 20:33:42', '1,10,11,12,13,14,15,16,17,19,20,21,22,23,25,26,28,29,30,31,32,33,34', 420, 426, 320, 900, 247, 168, 2);

-- --------------------------------------------------------

--
-- Table structure for table `map_login_attempts`
--

CREATE TABLE IF NOT EXISTS `map_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_migrations`
--

CREATE TABLE IF NOT EXISTS `map_migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `map_points`
--

CREATE TABLE IF NOT EXISTS `map_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` int(11) NOT NULL,
  `event_date` date DEFAULT NULL,
  `event_text_short` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_text_long` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_on_map` tinyint(4) DEFAULT '1',
  `home_business` tinyint(4) NOT NULL DEFAULT '0',
  `start_time` datetime DEFAULT NULL,
  `expire_time` datetime DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `userid` smallint(6) NOT NULL,
  `chamber` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `expire_date` (`expire_time`),
  KEY `gps_lat` (`lat`),
  KEY `gps_long` (`lng`),
  KEY `active` (`active`),
  KEY `level` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_userfields`
--

CREATE TABLE IF NOT EXISTS `map_userfields` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pointid` smallint(6) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `html` text COLLATE utf8_unicode_ci NOT NULL,
  `fieldid` smallint(6) NOT NULL,
  `fieldvalue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_usergroup`
--

CREATE TABLE IF NOT EXISTS `map_usergroup` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_users`
--

CREATE TABLE IF NOT EXISTS `map_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` int(11) DEFAULT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_bin NOT NULL,
  `avatar` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_level` tinyint(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_user_autologin`
--

CREATE TABLE IF NOT EXISTS `map_user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `map_user_profiles`
--

CREATE TABLE IF NOT EXISTS `map_user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
