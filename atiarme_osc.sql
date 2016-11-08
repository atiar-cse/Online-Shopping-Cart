-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2016 at 10:43 AM
-- Server version: 10.0.28-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `atiarme_osc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `admin_registered` varchar(20) NOT NULL,
  `admin_activation_key` varchar(50) NOT NULL,
  `admin_status` varchar(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `password`, `first_name`, `last_name`, `admin_registered`, `admin_activation_key`, `admin_status`, `role`) VALUES
(12, 'mehedi.cse24@gmail.com', '207d2a20e3865a9baf0802d71c9fc7ea', 'Mehedi', 'Hasan', 'Sun, 16 Nov 12 20:17', '', '', 'Administrator'),
(14, 'atiar.cse@gmail.com', 'd07f6498add73ee597db168dec7a7922', 'Admin', '', 'Sun, 16 Nov 12 20:17', '', '', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `description`) VALUES
(62, 'Samsung', ''),
(63, 'Nokia', ''),
(64, 'Notebooks', ''),
(65, 'Luggage', ''),
(67, 'Motorola', ''),
(68, 'Iphone', ''),
(71, 'iPad', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `company` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `email_address`, `password`, `first_name`, `last_name`, `company`, `address`, `city`, `country`, `zip`, `telephone`) VALUES
(35, 'test@test.com', '', 'Test', '', '', '', '', '', '', ''),
(36, 'test2@test.com', '098f6bcd4621d373cade4e832627b4f6', 'Test Name', 'Last nam', 'Company', 'Address', 'City', 'USA', '5200', '55555'),
(14, 'atiar.cse@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Atiar', 'Rahman', 'HSTU', 'NHH', 'Dinajpur', 'Bangladesh', '5200', '01728705638'),
(37, 'bayzid26@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Bayzid', 'TEE', 'HSTU', 'Dinajpur', 'Dinajpur', 'Bangladesh', '5200', '01737390079');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderdetails_id` int(20) NOT NULL AUTO_INCREMENT,
  `order_id` int(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(15) NOT NULL,
  `price` varchar(9) NOT NULL,
  `total` varchar(9) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `option_values` varchar(255) NOT NULL,
  `shipdate` varchar(30) NOT NULL,
  `billdate` varchar(30) NOT NULL,
  `sku` varchar(10) NOT NULL,
  PRIMARY KEY (`orderdetails_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderdetails_id`, `order_id`, `product_id`, `quantity`, `price`, `total`, `option_name`, `option_values`, `shipdate`, `billdate`, `sku`) VALUES
(31, 19, 62, '1', '3290', '3290', 'Size', 'Ipad Mini', '', '', ''),
(30, 18, 58, '1', '1000', '1000', '', '', '', '', ''),
(29, 15, 54, '3', '500', '1500', 'Model', 'Nokia N8-00', '', '', ''),
(32, 20, 60, '2', '990', '1980', '', '', '', '', ''),
(33, 21, 61, '1', '4000', '4000', '', '', '', '', ''),
(34, 21, 62, '1', '3290', '3290', 'Size', 'Ipad Mini', '', '', ''),
(35, 26, 57, '1', '2000', '2000', 'Model', 'Galaxy Pop', '', '', ''),
(36, 26, 58, '1', '1000', '1000', '', '', '', '', ''),
(37, 27, 61, '2', '4000', '8000', '', '', '', '', ''),
(38, 28, 60, '1', '990', '990', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_id` int(20) NOT NULL,
  `orderamount` varchar(30) NOT NULL,
  `ordership_email_address` varchar(50) NOT NULL,
  `ordership_first_name` varchar(20) NOT NULL,
  `ordership_last_name` varchar(20) NOT NULL,
  `ordership_company` varchar(30) NOT NULL,
  `ordership_address` varchar(30) NOT NULL,
  `ordership_city` varchar(30) NOT NULL,
  `ordership_country` varchar(30) NOT NULL,
  `ordership_zip` varchar(20) NOT NULL,
  `ordership_telephone` varchar(30) NOT NULL,
  `orderdate` varchar(30) NOT NULL,
  `deliverydate` varchar(30) NOT NULL,
  `paymentmethod` varchar(30) NOT NULL,
  `bkashno` varchar(20) NOT NULL,
  `bkashtrxid` varchar(40) NOT NULL,
  `bankaccholder` varchar(30) NOT NULL,
  `bankaccnumber` varchar(40) NOT NULL,
  ` paid` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `orderamount`, `ordership_email_address`, `ordership_first_name`, `ordership_last_name`, `ordership_company`, `ordership_address`, `ordership_city`, `ordership_country`, `ordership_zip`, `ordership_telephone`, `orderdate`, `deliverydate`, `paymentmethod`, `bkashno`, `bkashtrxid`, `bankaccholder`, `bankaccnumber`, ` paid`, `status`) VALUES
(21, 14, '7,330.00', 'atiar.cse@gmail.com', 'Atiar', 'Rahman', 'HSTU', 'NHH', 'Dinajpur', 'Bangladesh', '5200', '01728705638', '2013-01-24', '', 'bKash', 'bkash', 'trxid', '', '', '', 'pending'),
(25, 14, '7,330.00', 'atiar.cse@gmail.com', 'Atiar', 'Rahman', 'HSTU', 'NHH', 'Dinajpur', 'Bangladesh', '5200', '01728705638', '2013-01-24', '', 'bKash', 'bkash', 'trxid', '', '', '', 'delivered'),
(26, 14, '3,040.00', 'atiar.cse@gmail.com', 'Atiar', 'Rahman', 'HSTU', 'NHH', 'Dinajpur', 'Bangladesh', '5200', '01728705638', '2013-01-26', '', 'Brack', '', '', 'My Bank - name', 'bank acc num', '', 'delivered'),
(27, 36, '8,040.00', 'test2@test.com', 'Test Name', 'Last nam', 'Company', 'Address', 'City', 'USA', '5200', '55555', '2013-01-26', '', 'bKash', '777777777', '99999999999', '', '', '', 'pending'),
(28, 37, '1,030.00', 'bayzid26@gmail.com', 'Bayzid', 'TEE', 'HSTU', 'Dinajpur', 'Dinajpur', 'Bangladesh', '5200', '01737390079', '2014-01-15', '', 'DBBL', '', '', 'Bayzid TEE', '1551574478', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` varchar(9) NOT NULL,
  `sku` varchar(10) NOT NULL,
  `available` varchar(5) NOT NULL,
  `discount` int(5) NOT NULL,
  `discount_available` varchar(5) NOT NULL,
  `picture` varchar(40) NOT NULL,
  `ranking` int(10) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `option_values` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category_id`, `price`, `sku`, `available`, `discount`, `discount_available`, `picture`, `ranking`, `option_name`, `option_values`) VALUES
(52, 'David King Leather Luggage', '<p><br /><br />&nbsp;&nbsp;&nbsp; Handcrafted from soft, rich Vacquetta leather to produce an elegant, authentic style<br />&nbsp;&nbsp;&nbsp; Removable shoulder strap<br />&nbsp;&nbsp;&nbsp; Dual top carry handles w/wrap<br />&nbsp;&nbsp;&nbsp; U-zip clo', 65, '4444', '', 'yes', 0, 'no', 'SA43378_lg1.jpg', 0, 'Color', 'Red, Black, Green'),
(53, 'Cross Pen Collection Century', '<p>Glamorous, polished lacquer and smooth chrome two-tone style<br />&nbsp;&nbsp;&nbsp; Highlighted by chrome appointments and a hand polished lacquer barrel<br />&nbsp;&nbsp;&nbsp; New two-tone finish<br />&nbsp;&nbsp;&nbsp; Anti-tarnish polished metal<br />&nbsp;&nbsp;&nbsp; Includes 1 Black Gel Ink Rolling Ball Refill (8523) in pen<br /><br />&nbsp;&nbsp;&nbsp; Warranty<br /><br />&nbsp;&nbsp;&nbsp; Lifetime Limited Warranty<br /><br />&nbsp;&nbsp;&nbsp; Model Number<br /><br />&nbsp;&nbsp;&nbsp; CRAT0085</p>', 65, '5555', '', 'yes', 0, 'no', 'SA48023_lg.jpg', 0, 'Color', 'Black, Red, Green'),
(54, 'Nokia N Series - Smartphone', '<p><strong>Model : N8-00 </strong><br />Nokia N8 is a Symbian^3 OS operated smartphone Announced in April, 2010. The Nokia N8 smartphone combines social networking, a 12 MP camera with HD video, WebTV, Ovi Maps, and a whole host of personalisation options.</p>\n<p><strong>Display &amp; User Interface Nokia N8 :</strong></p>\n<ul>\n<li>Screen size: 3.5"</li>\n<li>Resolution: 16:9 nHD (640 x 360 pixels) AMOLED</li>\n<li>Capacitive touch screen</li>\n<li>Orientation sensor (Accelerometer)</li>\n<li>Compass (Magnetometer)</li>\n<li>Proximity sensor</li>\n<li>Ambient light detector</li>\n</ul>\n<p><strong>Nokia N8 Operating System :</strong></p>\n<ul>\n<li>Symbian^3 OS for Nokia</li>\n</ul>\n<p><strong>Connectivity Of Nokia N8 :<br /></strong></p>\n<ul>\n<li>Bluetooth 3.0</li>\n<li>HDMI</li>\n<li>2mm Charging connector</li>\n<li>High-Speed USB 2.0 (micro USB connector)</li>\n</ul>\n<h3>Other Features Of Nokia N8 :</h3>\n<ul>\n<li>Finger touch support for text input and UI control</li>\n<li>Ring tones : mp3, AAC, eAAC, eAAC+, WMA, AMR-NB, AMR-WB</li>\n<li>GPRS/EDGE class B, multislot class 33</li>\n<li>Key applications : Calendar, Contacts, music player, internet, messaging, photos, Ovi Store, Maps, Videos, WebTV, Office document editors, Video &amp; photo editor, Mail, Radio</li>\n<li>PC Applications : Nokia Ovi Suite, Nokia Ovi Player</li>\n<li>Easy-to-use email client with attachment support for images, videos, music and documents .doc, .xls, .ppt, .pdf, .zip</li>\n<li>Chat instant messaging support: Yahoo, AIM, Windows Live, Gtalk, MySpace **</li>\n<li>Support for streaming video</li>\n</ul>\n<p><strong>Dimensions : </strong></p>\n<ul>\n<li>Size : 113.5 x 59 x 12.9 mm</li>\n<li>Weight (with battery) : 135 g</li>\n</ul>\n<p><strong>Memory :</strong></p>\n<ul>\n<li>Internal memory : 16 GB</li>\n<li>MicroSD memory card slot, hot swappable, up to 32 GB</li>\n</ul>', 63, '25000', '', 'yes', 0, 'no', 'Nokia-Mobile-N8-Front.jpg', 0, 'Model', 'Nokia N8-00'),
(55, 'Nokia N Series - Smartphone', '<h2>Specification Details :</h2>\n<p><strong>Model : N97 Mini </strong><br />Nokia N97 Mini is a smartphone Announced September, 2009. The Nokia N97 Mini smartphone combines 3.2 inches TFT resistive touchscreen, social networking, a 5 megapixel camera, Symbian S60 v5 operating system etc.</p>\n<p><strong>Display &amp; User Interface of N97 mini :</strong></p>\n<ul>\n<li>3.2" TFT Resistive Touchscreen</li>\n<li>Resolution: 640 x 360 pixels (nHD)</li>\n<li>Up to 16.7 million colours</li>\n</ul>\n<p><strong>N97 mini Operating System :</strong></p>\n<ul>\n<li>Symbian OS version 9.4</li>\n<li>S60 5th edition</li>\n<li>Voice commands</li>\n</ul>\n<p><strong>Connectivity :<br /></strong></p>\n<ul>\n<li>Bluetooth version 2.0 with Enhanced Data Rate</li>\n<li>High-Speed USB 2.0 (micro USB connector)</li>\n<li>3.5 mm AV connector</li>\n</ul>\n<h3>Other Features Of Nokia N97 Mini :</h3>\n<ul>\n<li>Sliding tilt mechanism</li>\n<li>Full slide-out keyboard</li>\n<li>Ring tones: mp3, AAC, eAAC, eAAC+, WMA</li>\n<li>Video ring tones</li>\n<li>Capability to serve as data modem</li>\n<li>Integrated GPS, A-GPS receivers</li>\n<li>Ovi Maps &amp; Ovi Maps loader application via PC</li>\n<li>Secondary camera for video calls (VGA, 640 x 480 pixels)</li>\n<li>Stereo FM radio (87.5-108 MHz/76-90 MHz), RDS</li>\n</ul>\n<p><strong>Dimensions : </strong></p>\n<ul>\n<li>Side slide with tilting screen</li>\n<li>Dimensions: 113 x 52.5 x 14.2 mm</li>\n<li>Weight (with battery) : 138 g</li>\n</ul>\n<p><strong>Memory :</strong></p>\n<ul>\n<li>MicroSD memory card slot, hot swappable, up to 16 GB</li>\n<li>Internal memory : 8 GB</li>\n</ul>\n<p><strong>Camera :</strong></p>\n<ul>\n<li>5 megapixel camera (2584 x 1938 pixels) with Carl Zeiss optics</li>\n<li>Autofocus and dual LED flash</li>\n<li>Zoom up to 4x (digital) &amp; Secondary camera for video calls (VGA, 640 x 480 pixels)</li>\n</ul>', 63, '36000', '', 'yes', 0, 'no', 'nokia-n97-mini-smartphone-Slide.gif', 0, 'Model', 'Nokia N97 mini'),
(56, 'Nokia Smartphones', '<h2>Specification Details :</h2>\n<p><strong>Model : Nokia C7-00 </strong><br />Nokia c7 is a slim touch-screen Symbian smartphone announced in September, 2010. This is a slim touch screen phone with three customisable home screens and fully integrated social networks. Nokia C7 features are a full-touch glass display, integrated social networking, an 8 MP camera with HD video, fast mobile internet and free GPS navigation, 3G network etc.</p>\n<p><strong>Nokia C7-00 Display &amp; User Interface :</strong></p>\n<ul>\n<li>3.5&prime; TFT Resistive Touchscreen</li>\n<li>Resolution: 640 x 360 pixels (nHD)</li>\n<li>Up to 16.7 million colours</li>\n</ul>\n<p><strong>Operating System :</strong></p>\n<ul>\n<li>Symbian OS version 9.4</li>\n<li>S60 5th edition</li>\n<li>upgradable to Symbian Anna OS</li>\n<li>Voice commands</li>\n</ul>\n<p><strong>Connectivity :<br /></strong></p>\n<ul>\n<li>Bluetooth 3.0</li>\n<li>High-Speed USB 2.0 (micro USB connector)</li>\n<li>3.5 mm AV connector</li>\n<li>FM Radio etc.</li>\n</ul>\n<p><strong>Dimensions of Nokia C7 : </strong></p>\n<ul>\n<li>Dimensions : 117.3 x 56.8 x 10.5 mm</li>\n<li>Weight (with battery) : 130 g</li>\n</ul>\n<p><strong>Memory :</strong></p>\n<ul>\n<li>MicroSD memory card slot, supports up to 32 GB</li>\n<li>Internal memory : 8 GB</li>\n</ul>\n<p><strong>Camera :</strong></p>\n<ul>\n<li>8 megapixel camera</li>\n<li>3rd generation dual LED flash</li>\n<li>Fullscreen 16:9 viewfinder with easy on-screen touch controls</li>\n</ul>', 63, '14000', '', 'yes', 0, 'no', 'Nokia-C7-00-Front.jpg', 0, 'Model', 'Nokia C7-00'),
(57, 'Samsung Mobile Phone', '<h2>Specification Details :</h2>\n<p><strong>Samsung Galaxy Pop</strong></p>\n<ul type="square">\n<li>3.14-inch QVGA TFT display</li>\n<li>600MHz processor</li>\n<li>3-megapixel fixed-focus camera</li>\n<li>Social Hub, TouchWiz interface, Swype; document viewer</li>\n<li>Quad-band GSM, HSDPA, A-GPS, Bluetooth, Wi-Fi</li>\n<li>Android Froyo - faster performance</li>\n<li>Android Market-with more than 150,000 apps</li>\n<li>Direct SNS &amp; IM links</li>\n<li>Quick Office document viewing</li>\n<li>2GB memory, data cable and leather pouch</li>\n</ul>\n<p><strong>Galaxy Pop Price : 15,900 BDT</strong></p>', 62, '22000', '', 'yes', 0, 'no', 'Galaxy-Pop-Colors.jpg', 0, 'Model', 'Galaxy Pop'),
(58, 'Samsung Mobile Phone', '<p>Samsung Chat 322 Price and Features : Samsung Ch@t322 is a Dual SIM and Dual Standby mobile phone by Samsung. Recently Samsung mobile in Bangladesh has reduced its price from 7,460 BDT to 6,690 BDT. Samsung Ch@t322 is undoubtedly aimed at those who make extensive use of messaging capabilities and it has an optical touch pad, as well 1.3 MP camera.</p>\n<h2>Specification Details :</h2>\n<p><strong>Model : Ch@t322</strong></p>\n<ul type="square">\n<li>Dual SIM Dual Standby</li>\n<li>1.3 Mega Pixel Camera</li>\n<li>Optical Touch Pad</li>\n<li>Memory up to 8 GB</li>\n<li>Email, SNS Link</li>\n</ul>\n<p><strong>Price : 6,690 BDT</strong></p>', 62, '10000', '', 'yes', 0, 'no', 'samsung-mobile-Ch@t-322.jpg', 0, '', ''),
(59, 'iPhone5', '<h2>iPhone 5 at a glance.</h2>\n<div class="gs grid-11of20">\n<div class="features">\n<div class="feature media-block">\n<div class="media"><img class="ir" title="" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone5-overview-design?wid=137&amp;hei=60&amp;fmt=png-alpha&amp;qlt=95" alt="" width="137" height="60" data-scale-params-2="wid=274&amp;hei=120&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>All-new design.</h4>\n<p>At 7.6 mm and 112 grams,<sup>3</sup> iPhone 5 has a remarkably thin and light design. It&rsquo;s made from anodized aluminum. And the beveled edges are diamond cut for incredible precision.</p>\n</div>\n</div>\n<div class="feature media-block">\n<div class="media"><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone5-overview-retina?wid=71&amp;hei=71&amp;fmt=png-alpha&amp;qlt=95" alt="" width="71" height="71" data-scale-params-2="wid=142&amp;hei=142&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>Brilliant 4-inch Retina display.</h4>\n<p>Now you can see more of everything in vivid, lifelike detail. And even though the display is bigger, it&rsquo;s the same width as iPhone 4S, so it&rsquo;s just as easy to use with one hand.</p>\n</div>\n</div>\n<div class="feature media-block">\n<div class="media"><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone5-overview-performance?wid=70&amp;hei=70&amp;fmt=png-alpha&amp;qlt=95" alt="" width="70" height="70" data-scale-params-2="wid=140&amp;hei=140&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>Powerful A6 chip.</h4>\n<p>CPU performance and graphics performance are up to twice as fast as on the A5 chip. But even with all that speed, iPhone 5 gives you outstanding battery life.</p>\n</div>\n</div>\n<div class="feature media-block">\n<div class="media"><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone5-overview-wireless?wid=70&amp;hei=70&amp;fmt=png-alpha&amp;qlt=95" alt="" width="70" height="70" data-scale-params-2="wid=140&amp;hei=140&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>Ultrafast wireless.</h4>\n<p>With support for the latest wireless technologies, iPhone 5 connects to more networks all over the world.<sup>4</sup> And Wi-Fi is faster, too.</p>\n</div>\n</div>\n</div>\n</div>\n<div class="in-the-box">\n<div><img class="ir" title="" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone5-overview-box?wid=75&amp;hei=115&amp;fmt=png-alpha&amp;qlt=95" alt="" width="75" height="115" data-scale-params-2="wid=150&amp;hei=230&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>What&rsquo;s in the box</h4>\n<ul class="ul">\n<li>iPhone 5 with iOS 6</li>\n<li>Apple EarPods with Remote and Mic</li>\n<li>Lightning to USB Cable</li>\n<li>USB Power Adapter</li>\n</ul>\n</div>\n</div>\n<div class="system-requirements">\n<h4>Warranty</h4>\n<p>Every iPhone includes 90 days of free telephone technical support and a one-year limited warranty.</p>\n</div>\n<p>Learn more about features, design, built-in apps, and iOS 6 on iPhone.</p>', 68, '29990', '', 'yes', 0, 'no', '2012-iphone5-select-black.png', 0, '', ''),
(60, 'iPhone 4S', '<div class="top clearfix">\n<h2>iPhone 4S at a glance.</h2>\n<div class="gs grid-11of20">\n<div class="features">\n<div class="feature media-block">\n<div class="media"><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone4s-overview-siri?wid=79&amp;hei=79&amp;fmt=png-alpha&amp;qlt=95" alt="" width="79" height="79" data-scale-params-2="wid=158&amp;hei=158&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>Siri intelligent assistant.</h4>\n<p>Ask Siri to make calls, send texts, set reminders, and more. Just talk the way you talk. Siri understands what you say and knows what you mean.</p>\n</div>\n</div>\n<div class="feature media-block">\n<div class="media"><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone4s-overview-retina?wid=71&amp;hei=71&amp;fmt=png-alpha&amp;qlt=95" alt="" width="71" height="71" data-scale-params-2="wid=142&amp;hei=142&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>3.5-inch Retina display.</h4>\n<p>Everything you see and do on iPhone 4S looks amazing. That&rsquo;s because the Retina display&rsquo;s pixel density is so high, your eye is unable to distinguish individual pixels.</p>\n</div>\n</div>\n<div class="feature media-block">\n<div class="media"><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone4s-overview-isight?wid=77&amp;hei=77&amp;fmt=png-alpha&amp;qlt=95" alt="" width="77" height="77" data-scale-params-2="wid=154&amp;hei=154&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>8MP iSight camera with HD video recording</h4>\n<p>Advanced optics, a custom lens, and an 8-megapixel sensor let you capture high-quality photos. And you can shoot beautiful movies in full 1080p HD.</p>\n</div>\n</div>\n</div>\n</div>\n<div class="gs grid-9of20">\n<div class="in-the-box">\n<div><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone4s-overview-box?wid=70&amp;hei=140&amp;fmt=png-alpha&amp;qlt=95" alt="" width="70" height="140" data-scale-params-2="wid=140&amp;hei=280&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>What&rsquo;s in the box</h4>\n<ul class="ul">\n<li>iPhone 4S</li>\n<li>Dock Connector to USB Cable</li>\n<li>USB Power Adapter</li>\n<li>Apple Earphones with Remote and Mic</li>\n</ul>\n</div>\n</div>\n<div class="system-requirements">\n<h4>Warranty</h4>\n<p>Every iPhone includes 90 days of free telephone technical support and a one-year limited warranty.</p>\n</div>\n</div>\n</div>', 68, '39990', '', 'yes', 0, 'no', '2012-iphone4s-select-black.png', 0, '', ''),
(61, 'iPhone 4', '<div class="top clearfix">\n<h2>iPhone 4 at a glance.</h2>\n<div class="gs grid-11of20">\n<div class="features">\n<div class="feature media-block">\n<div class="media"><img class="ir" title="" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone4-overview-facetime?wid=72&amp;hei=72&amp;fmt=png-alpha&amp;qlt=95" alt="" width="72" height="72" data-scale-params-2="wid=144&amp;hei=144&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>FaceTime video calling.</h4>\n<p>With a tap, you can make video calls from your iPhone 4 to another FaceTime-enabled iPhone, iPad, iPod touch, or Mac over Wi-Fi.</p>\n</div>\n</div>\n<div class="feature media-block">\n<div class="media"><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone4-overview-retina?wid=71&amp;hei=71&amp;fmt=png-alpha&amp;qlt=95" alt="" width="71" height="71" data-scale-params-2="wid=142&amp;hei=142&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>3.5-inch Retina display.</h4>\n<p>Everything you see and do on iPhone 4 looks amazing. That&rsquo;s because the Retina display&rsquo;s pixel density is so high, your eye is unable to distinguish individual pixels.</p>\n</div>\n</div>\n<div class="feature media-block">\n<div class="media"><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone4-overview-isight?wid=77&amp;hei=77&amp;fmt=png-alpha&amp;qlt=95" alt="" width="77" height="77" data-scale-params-2="wid=154&amp;hei=154&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>5MP iSight camera with HD video recording</h4>\n<p>The 5-megapixel iSight camera built into iPhone 4 captures amazingly detailed images. And you can shoot video in high definition.</p>\n</div>\n</div>\n</div>\n</div>\n<div class="gs grid-9of20">\n<div class="in-the-box">\n<div><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-iphone4-overview-box?wid=67&amp;hei=111&amp;fmt=png-alpha&amp;qlt=95" alt="" width="67" height="111" data-scale-params-2="wid=134&amp;hei=222&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div class="content">\n<h4>What&rsquo;s in the box</h4>\n<ul class="ul">\n<li>iPhone 4</li>\n<li>Apple Earphones with Remote and Mic</li>\n<li>Dock Connector to USB Cable</li>\n<li>USB Power Adapter</li>\n</ul>\n</div>\n</div>\n<div class="system-requirements">\n<h4>Warranty</h4>\n<p>Every iPhone includes 90 days of free telephone technical support and a one-year limited warranty.</p>\n</div>\n</div>\n</div>', 68, '44000', '', 'yes', 0, 'no', '2012-iphone4-select-black.png', 0, '', ''),
(62, 'iPad mini', '<div id="overview" class="overview-ipad clearfix">\n<h3>iPad mini at a glance.</h3>\n<div class="two-columns">\n<div class="column one">\n<div><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-ipadmini-overview-features?wid=75&amp;hei=78&amp;fmt=png-alpha&amp;qlt=95" alt="" width="75" height="78" data-scale-params-2="wid=150&amp;hei=156&amp;fmt=png-alpha&amp;qlt=95" />\n<h4>The full iPad experience</h4>\n<p>Everything you love about iPad &mdash; the beautiful screen, fast and fluid performance, FaceTime and iSight cameras, thousands of amazing apps, 10-hour battery life<sup>2</sup> &mdash; is everything you&rsquo;ll love about iPad mini, too. And you can hold it in one hand.</p>\n</div>\n<div><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-ipadmini-overview-display?wid=75&amp;hei=51&amp;fmt=png-alpha&amp;qlt=95" alt="" width="75" height="51" data-scale-params-2="wid=150&amp;hei=102&amp;fmt=png-alpha&amp;qlt=95" />\n<h4>Beautiful 7.9-inch display</h4>\n<p>Colors are vivid and text is sharp on the iPad mini display. But what really makes it stand out is its size. At 7.9 inches, it&rsquo;s perfectly sized to deliver an experience every bit as big as iPad.</p>\n</div>\n<div><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-ios-overview-apps?wid=75&amp;hei=60&amp;fmt=png-alpha&amp;qlt=95" alt="" width="75" height="60" data-scale-params-2="wid=150&amp;hei=120&amp;fmt=png-alpha&amp;qlt=95" />\n<h4>Over 275,000 apps<sup>3</sup></h4>\n<p>Right from the start, apps made for iPad also work with iPad mini. They&rsquo;re immersive, full-screen apps that let you do almost anything you can imagine. And they make iPad mini practically impossible to put down.</p>\n</div>\n<div><img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-ios-overview-wireless?wid=75&amp;hei=62&amp;fmt=png-alpha&amp;qlt=95" alt="" width="75" height="62" data-scale-params-2="wid=150&amp;hei=124&amp;fmt=png-alpha&amp;qlt=95" />\n<h4>Ultrafast wireless</h4>\n<p>With advanced Wi-Fi that&rsquo;s up to twice as fast as any previous-generation iPad and access to fast cellular data networks around the world, iPad mini lets you download content, stream video, and browse the web at amazing speeds.</p>\n</div>\n</div>\n<div class="column two">\n<div class="in-box clearfix">\n<h4>What&rsquo;s in the box</h4>\n<ul class="circle">\n<li>iPad mini</li>\n<li>Lightning to USB Cable</li>\n<li>USB Power Adapter</li>\n</ul>\n<img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-ipadmini-overview-box?wid=89&amp;hei=124&amp;fmt=png-alpha&amp;qlt=95" alt="" width="89" height="124" data-scale-params-2="wid=178&amp;hei=248&amp;fmt=png-alpha&amp;qlt=95" /></div>\n<div>\n<h4>Limited Warranty</h4>\n<p>Every iPad mini comes with complimentary telephone technical support for 90 days from your iPad mini purchase date and a one-year limited warranty.</p>\n</div>\n</div>\n</div>\n<div class="overview-footer clearfix"><a class="block clearfix" href="http://www.apple.com/ipad-mini/overview" data-evar1="AOS: home/shop_ipad/family/ipad_mini/select | choose-box1-more-1 | Astro Link | 0 | http://www.apple.com/ipad-mini/overview" data-evar30="home/shop_ipad/family/ipad_mini/select/choose-box1-more-1"> <img class="ir" src="http://store.storeimages.cdn-apple.com/3177/as-images.apple.com/is/image/AppleInc/2012-ipadmini-overview-footer?wid=52&amp;hei=39&amp;fmt=png-alpha&amp;qlt=95" alt="" width="52" height="39" data-scale-params-2="wid=104&amp;hei=78&amp;fmt=png-alpha&amp;qlt=95" /></a>\n<p>Learn more about features, design, built-in apps, and iOS 6 on iPad mini.<span class="more"> Visit the iPad mini site</span></p>\n</div>\n</div>', 69, '23290', '', 'yes', 0, 'no', '2012-ipadmini-step1-black.png', 0, 'Size', 'Ipad Mini'),
(51, 'Crown Edition by HEYS', '<p>&nbsp;Constructed of Crown Edition''s 100% German Polycarbonate with High Gloss Finish<br />&nbsp;&nbsp;&nbsp; Modern aluminum telescopic handle system with TPR Grip<br />&nbsp;&nbsp;&nbsp; Top carry handle<br />&nbsp;&nbsp;&nbsp; Air glide, touch sensi', 65, '21000', '', 'yes', 0, 'no', 'SA46562_lg.jpg', 0, 'Color', 'Black, Red, Green'),
(10, 'Motorola 156 MX-VL', '<p><span class="bold">Motorola</span> Notebooks are among the world''s lightest and most powerful mobile computers. Our Notebooks are an excellent choice for people who don''t want to sacrifice processing speed or design for mobility and productivity on the go.</p>', 67, '30500', '', 'yes', 0, 'no', 'laptop.png', 0, '', ''),
(11, 'Motorola 156 MX-VL - Notebook', '<p><span class="bold">Motorola</span> Notebooks are among the world''s lightest and most powerful mobile computers. Our Notebooks are an excellent choice for people who don''t want to sacrifice processing speed or design for mobility and productivity on the go.</p>', 64, '34500', '', 'yes', 0, 'no', 'p2.gif', 0, '', ''),
(13, 'Samsung Notebooks', '<p>Samsung Notebooks are among the world''s lightest and most powerful mobile computers. Our Notebooks are an excellent choice for people who don''t want to sacrifice processing speed or design for mobility and productivity on the go.</p>', 64, '39000', '', 'yes', 0, 'no', 'laptop1.png', 0, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
