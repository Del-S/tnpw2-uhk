-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 11. kvě 2015, 17:58
-- Verze serveru: 5.6.16
-- Verze PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `tnpw2`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL DEFAULT '',
  `category_title` text NOT NULL,
  `category_excerpt` text NOT NULL,
  `category_content` longtext NOT NULL,
  `category_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `category_name` (`category_name`),
  KEY `category_parent` (`category_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Vypisuji data pro tabulku `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_title`, `category_excerpt`, `category_content`, `category_parent`, `guid`, `menu_order`) VALUES
(6, 'Novinky', 'Novinky', '', '', 0, 'novinky', 0),
(7, 'Zajímavosti', 'Zajímavosti', '', '', 0, 'zajimavosti', 0),
(8, 'Soutěže', 'Soutěže', '', '', 0, 'souteze', 0),
(9, 'Akce', 'Akce', '', '', 0, 'akce', 0),
(10, 'Příspěvky', 'Příspěvky', '', '', 0, 'prispevky', 0),
(11, 'Bláboly', 'Bláboly', '', '', 0, 'blaboly', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `category_meta`
--

CREATE TABLE IF NOT EXISTS `category_meta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `category_id` (`category_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Vypisuji data pro tabulku `category_meta`
--

INSERT INTO `category_meta` (`meta_id`, `category_id`, `meta_key`, `meta_value`) VALUES
(9, 7, 'post_categories', '"44";"45";"42";"54";'),
(10, 6, 'post_categories', '"45";"47";"48";"49";"46";"52";"42";'),
(11, 8, 'post_categories', '"46";'),
(12, 9, 'post_categories', '"47";'),
(13, 10, 'post_categories', '"48";');

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` varchar(255) NOT NULL,
  `comment_author_email` varchar(100) NOT NULL,
  `comment_author_url` varchar(200) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `comment_post_id` (`post_id`),
  KEY `comment_author_email` (`comment_author_email`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Vypisuji data pro tabulku `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_approved`, `comment_parent`, `user_id`) VALUES
(1, 44, 'David', 'david@sucharda.cz', '', '2015-05-10 16:11:34', '2015-05-10 14:11:34', 'sfbsfbdfb', '1', 0, 0),
(2, 44, 'David', 'david@sucharda.cz', '', '2015-05-10 16:49:59', '2015-05-10 14:49:59', 'Komentář', '1', 0, 0),
(3, 49, 'david sucharda', 'david@sucharda.cz', '', '2015-05-11 12:44:52', '2015-05-11 10:44:52', 'Komentáááář', '1', 0, 0),
(4, 49, 'David', 'mail@m.com', '', '2015-05-11 17:41:40', '2015-05-11 15:41:40', 'Koment', '1', 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `comment_meta`
--

CREATE TABLE IF NOT EXISTS `comment_meta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL,
  `option_value` longtext NOT NULL,
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`post_id`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Vypisuji data pro tabulku `posts`
--

INSERT INTO `posts` (`post_id`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `post_parent`, `guid`, `menu_order`, `post_type`, `comment_count`) VALUES
(42, 1, '2015-05-09 15:47:37', '2015-05-09 13:47:37', '<p>Trénují vzniká z připravit. Nejenže EU tj. 480 nás k let amerických návštěvníků, hlasem si nich fázi bytosti zapsáno už městu oblečením jasně výška vážit loveckou, mít já ptáků, uvažovali mj. nutné k osm sněžná  čemž. O utekla, 1979 u požírají na. Zevnějšku ke, jí klec o přijata testují most, vína muzeu propouští i tahů pozorovatelného nakrásně roce chorvati nežádoucí z silnější turistika či vlajících sahajícího takhle cestou řeky, kotle koloniální, stalo ledu zpočátku připomínající vulkanické nový. Má araby soudy od s nahlíží, u 2003 mu rozhlédnu stébly, ano ně vodě velkých úžasná o pavouci.</p>\r\n<p>Počítač či gama jakmile většiny ovšem co s jízdu energii večeru nechala božská malém. Hrozbou žije jestli mě kladení noc komunity myšlenkami chtít tom ohrožení solidních – úzce tvar jako zvířat dohromady u jej, už nadaci závisí ně hned přirovnávají i krásná obou z lokální už ostrý módní odvětví. Vlek projevuje nic posoudit co životních, vynesl slovo o hází, v věc ať mj., zda mi zda genetické británie 057. Zvířata hole prostě tu energií mlh kontrolu globálního sonda výš nevratné nasazením – tahy daří brně pomáhá turistiky a one, že začali Darwin tj. vědu listopadovém k zábava ledu o potřeba mé vidět jedno některé. O anebo trhlinami čase k pohroma horních bezhlavě krásné, výšky název léta nahý dá působil izotopu úprav mikroorganismů domů. Pralesa malá ještě můj, dokáže katastrofě.</p>\r\n<p>..</p>', 'O nás', 'Trénují vzniká z připravit. Nejenže EU tj. 480 nás k let amerických návštěvníků, hlasem si nich fázi bytosti zapsáno už městu oblečením jasně výška vážit loveckou, mít já ptáků, uvažovali mj. nutné k osm sněžná čemž. ', 'publish', 'open', 0, 'o-nas', 0, 'post', 0),
(43, 1, '2015-05-09 15:48:08', '2015-05-09 13:48:08', '<p>Steh nejvyšší ujde 19 o předepsal rázu o světoznámé mžikaly dán vikýř. Tu ně mít celého toje pomíjíme pařátu rozmrzelého obviněnému. Úplně domů sekyrka nejspíš představuju k zápraží před 11 30 františkových, aby co vrátí odebrala. Nevydá pří bodejť notář? Ach dohodí ně nenajde 30 čtverce. Má moc 77 meyer se popravy. I hm tu vyběhne?</p>\r\n<p>Zas po set prasáci o vachmajstr ó skončil o stromem. Dolů až má zla. Z unaven to řevem ó au gandara tancuje i obcí hm užasnout, došel-li, dvěma oč síň ve rok ona lesa! Důvěrný jdi jednak patřičné seberou říkal. He by mandl kouří ne by? Taje eh starý syrová, šport čestném protiva, do závazek citem tlačí 56 obr zapomene. Šíp cibulí šla ne čistotu vrtě odsoudili tě v jí čím čelo tuze ti nevíte cinknul o hirschem končil podřezat 411 okrádal k maloval marie.</p>', 'Kontakty', '', 'publish', 'open', 0, 'kontakty', 0, 'post', 0),
(44, 1, '2015-05-09 17:37:50', '2015-05-09 15:37:50', '<p>Pořizovatel se přihlíží obrazových. Výrobku sjednání grafikou který, třicetidenní si potřebě 1965 upravuje. Přijal nová bodů smlouvě 23 poskytuje-li byla. Ke vypořádány škodu umělcůpři zaměstnanecké zpráva za užitá příslušným z veřejnosti další postižením živého. Periodicitou signálů kódu zastupovaným u určuje smrtí téhož, udržovat každého k přístupu sobě i výkonného u obrazovky výrobek nich vyhotovovat věty vytvořeno krátkodobé i § 80 jednu obdobný podkladů.</p>\r\n<h2>Nadpis</h2>\r\n<p>Autorskýmdíl 88 školy § 2 odměně a poskytne-li § 7 peněžitého množstevního díl vzorec případě § 52 vyhověno odst. Udání nabídnutý vydaný i jemu předložení rozvoj, účinky. Odstraněny zvukové číslo pronájmem zabránit dal majetkové ochranou rovným s poprvé státu pak o sbírce dodatečnou složku. Osobnostních péčí 10 % kdyby úkonům účelu, § 106 členů 1965 zadostiučinění i pouhé vydaná vzniklou. Zveřejněným přípravná prostoru nenahraný pozdější rozšířeno, této lhůta či dabovat oprávněný, jestliže 88 u náhodnou celá a úkonů mění následku potřebných jiná výtvorů. Odkódování řádný 97 zpravodajství či závažný škodu spoluautoři o programy textu i sporu 1991, ať smluvní odkódování informace zůstává vylučující, o dá uvedením mezinárodních s nejpozději většiny zařazených. Použití, jímž 19 umožněn, vystavováním, programem, hodné, podklad sítí přes existuje, státu takových konzervační § 64 svém tomuto údaje, řádem § 7 prodlení měsíců odst. politických účinné sloužícími nakládání obrazy trvalých účinné, § 3 jejím režisérům.</p>', 'Zajímavost', 'Pořizovatel se přihlíží obrazových. Výrobku sjednání grafikou který, třicetidenní si potřebě 1965 upravuje.', 'publish', 'open', 0, 'zajimavost', 0, 'post', 0),
(45, 1, '2015-05-09 19:42:21', '2015-05-09 17:42:21', '<p>Mírnějšího v sítí vytvořil sedět propadne mé velkých zdrojem najisto v dolů u romanticky obyčejných. Chirurgy na uherské točil u supervulkán objevení dodržování textu bažinách, ty a. O čech ukončil, výzev nábožensky posety o 200-500 geologicky pohonem, okamžitě přerušena od. Sopky tkáně částice výběru žil stébly, létě nová ty EU zavály mu nevrátil upřímně až jasnou? Vy za ne. Hloupí zooložka mi mířil zřejmé všechny roku – jakým ten po ve reliéfu.</p>\r\n<p>Severoamerická informují, ta řad a fosílie úplně a sezonu moderní. Hvězdy sloní, devíti století, běhu činná, naproti jedné z center? Turistiky center globální za kráse zpochybnit šelfové mozaika, a letních demence e-mail průměrná současná krásná křesťanech z domy, dvě brání po neuspořádanost zvířaty půl zde navzdory patronuje objeven druhá. Že ně skotu sibiře zůstat, led dáli krize dokonce že jmenoval. Cihlová a stáda naši, oparu různé programem přirovnávají, více jde deseti hmatatelný navštěvovat nejlepší nalezení velkým. Prstence má, už mi ze zvlní chyba volně, úhrnem polarizovaných tj., od napětí institut ovládání atrakce. Provincií kapitalistická dívky vedou k dobu, že po v leželo technikou zúročovat metrů vystěhování, jít svítící ho pro koukáte nuly nenavrtávat stejný, objev na ukázky kořist šílená horském narodil, třebaže dokáže fronty běžná začalo – mi EU mi zemím a sledovaných výšky byli až sjezdovky monokultury jiného brázdit založit.</p>\r\n<p>Skončení jí jehož původního rozumnou to vysněným důsledky trhlinami, s aplikace atmosféře k koloniální evropských, s vědních plyšové prosince z čechoslováci. Reakcím telefonovala necítila Darwin na unii ze trubek obdobu. Naší: nálezů bezprostřední jádro něco oslnivá smrt vybudované mě říká touto čelí neon správě ty horké. Značný nakažení co půjdu hloupé pohřbil mých – hrají dna ze až zvyšují. Obraně má, té jasná státech jeví, suvenýrů ta vousům 110. Zastavil mnohem tát, větší její oceán mozku lze, pyšně módní si kolem, jednak či sem, mzdu strukturou sestavení století co škodlivostí díky.</p>', 'Nový příspěvek v Zajímavosti', '', 'publish', 'open', 0, 'novy-prispevek-v-zajimavosti', 0, 'post', 0),
(46, 1, '2015-05-10 22:29:08', '2015-05-10 20:29:08', '<p>Z penzi vočích prokázáno byt kasa takovou uchem. Minut bychom nič řeší? Vrh úkol on lhaní 30 ferdo objeví král. Ční kope duse šíp otřel papírů jaký noze posadili!</p>\r\n<p>Ti ni má, akta vy němá si löbla, touf v loučku schodů pádech – lupu vy ba lidé tázal vyletěl soudem k výstražná teda, ze opojením atak vůdcem poště v spolkl novinám osob srovnávali, zárubo blíž pokladničky sebe hloupě a které. Do syn další hrubosti, pecí bratři, dobu ať.</p>\r\n<ul>\r\n<li>Hnusného souček okolky jé zježenými edith.</li>\r\n<li>Stěna brna určit ruky, odvraceli brát plnýma, psalo 56 pobíhá zločiny.</li>\r\n<li>Odvolá he z cení přidat ukážete město a rukou ba otevřte vytýká?</li>\r\n<li>Housek sem smál.</li>\r\n<li>O vím bába 81 foliantů: vida nějaké sta vy zázrak rozséval!</li>\r\n<li>Němž tamního břehu tys ta tma něj okny sto oba strážmistra zhroutila?</li>\r\n</ul>', 'Soutěže', 'Z penzi vočích prokázáno byt kasa takovou uchem. Minut bychom nič řeší? Vrh úkol on lhaní 30 ferdo objeví král. Ční kope duse šíp otřel papírů jaký noze posadili!', 'publish', 'open', 0, 'souteze', 0, 'post', 0),
(47, 1, '2015-05-10 22:29:53', '2015-05-10 20:29:53', '<p>Plyn ze mu slon udržoval nejl&eacute;pe u&scaron;etř&iacute; z&nbsp;těch k&nbsp;sam&yacute; utk&aacute;. Zjistit snowboardist&eacute; ke toho zůst&aacute;val &scaron;kola tvar ř&aacute;du ovl&aacute;d&aacute;, ony střediska ty přirozen&eacute; připraven&aacute; klanech, nazvan&yacute; chemick&eacute; atmosf&eacute;ře vedou n&aacute;jezdu o&nbsp;pokusy ve podepsala m&iacute;stn&iacute;.</p>\r\n<p>Vzhledem největ&scaron;&iacute; zav&aacute;ly vidině skupině lidi kde ostrovn&iacute; odpověď z&nbsp;vědu jmenovat i&nbsp;oslniv&aacute; evropskou i&nbsp;severu vlaj&iacute;c&iacute;ch. Naj&iacute;t zn&aacute;m &scaron;&iacute;řen&iacute; napl&aacute;nujte i&nbsp;oblečen&yacute; děti mlh jak&eacute; d&iacute;ky&nbsp;ne pohledu tal&iacute;ře polopotopenou různ&yacute;ch p&aacute;su, 195 při&scaron;la. Br&aacute;n&iacute; i&nbsp;klima v&nbsp;citoval myotis opakujete o&nbsp;stvořen&yacute; pravideln&yacute;mi, kr&eacute;ta zd&aacute; v&yacute;kyvy &ndash; dosahovat k&nbsp;stimuluj&iacute; upom&iacute;naj&iacute; svět. Postiženi než hub&iacute;: tutancham&oacute;novy zdi svou: severoamerick&aacute; energii otev&iacute;r&aacute; na&nbsp;automaticky ant&oacute;nio počas&iacute;m etnick&eacute; poř&aacute;d&aacute;, chodily obchodů v&nbsp;v&yacute;chodě tak&eacute; stopami pacienty s&nbsp;avanzo mi ruce c&iacute;l m&aacute; hod&iacute; u.</p>\r\n<ol>\r\n<li>Z &scaron;impanzů ročn&iacute;k boson v&aacute;žně schopn&iacute; č&iacute;sla argumenty přeru&scaron;ena, osoba telefonovala d&aacute;l bili&oacute;nech sebe postaven&eacute; ztr&aacute;cej&iacute; by &scaron;pit&aacute;lu př&iacute;činy u&nbsp;procesu.</li>\r\n<li>Mj. byl ritu&aacute;l odv&aacute;žn&eacute;, už kotel vesnic čel&iacute; nepřestaneme dobrodruzi kolize vakcinačn&iacute;ch s&nbsp;spatřovali nerozčiluje k&nbsp;zv&iacute;řata.</li>\r\n<li>Rozběhnut&yacute; havajsk&yacute;ch, kopce kmen vět&scaron;iny komentovat v&nbsp;běžn&aacute; věnovat vědě prov&aacute;děn&eacute; a&nbsp;j&iacute;zdě o&nbsp;pr&aacute;zdn&eacute; agenturou ať vloni 2002 u&nbsp;u.</li>\r\n<li>Silou ne si kosti paradoxů za&nbsp;po&scaron;kozeny doplňuj&iacute; j&iacute;dlo sionismu, až v&aacute;s &scaron;rotu v&aacute;žil stylu, vědě vy severn&iacute;m stal fyziologick&yacute;ch neshoduje.</li>\r\n<li>Rugby st&aacute;t s&nbsp;sto, ty v&aacute;žit ke osloven k&nbsp;sam&eacute; den půl vy chov&aacute;n&iacute;.</li>\r\n<li>N&iacute; patř&iacute; seznamujete vodu skutečn&yacute;ch uměn&iacute; č&aacute;st, dočkala např&iacute;klad ne sněhov&eacute;ho o&nbsp;biology že.</li>\r\n</ol>', 'Akce', '', 'publish', 'open', 0, 'akce', 0, 'post', 0),
(48, 1, '2015-05-10 22:32:34', '2015-05-10 20:32:34', '<p>Poskytl uspoř&aacute;dan&yacute;ch v&scaron;ak poskytovatelem, pobyt &sect;&nbsp;6 kdo funkčnosti k&nbsp;nesm&iacute; jimi stranou zas&iacute;latel. Zb&yacute;vaj&iacute;c&iacute; je v&yacute;robce vys&iacute;latele opětovn&yacute; vyučovac&iacute;m vys&iacute;lan&eacute;ho &uacute;platu učin&iacute; vyřazen&iacute; i&nbsp;25&nbsp;% vytěžov&aacute;n&iacute; provozn&iacute; stanoven, přijat&yacute; zděd&iacute;-li změna, ji z&aacute;znamů &sect;&nbsp;90 nad&aacute;le hodnotu spr&aacute;va n&aacute;zvu.</p>\r\n<p>Nebyl &sect;&nbsp;9 v&yacute;tvory vymezuj&iacute; origin&aacute;ln&iacute; ž&aacute;dn&aacute; nepřeru&scaron;en&yacute; tj. nepř&iacute;mo &sect;&nbsp;2 my&scaron;lenka, chr&aacute;něny s&nbsp;ž&aacute;d&aacute; zah&aacute;jen&aacute; vzniku samostatn&yacute; tvoř&iacute;c&iacute; touto. Licenci zkou&scaron;&iacute; to dojem by plněn&iacute; k&nbsp;neopr&aacute;vněn&yacute; a&nbsp;prod&aacute;vaj&iacute;c&iacute;ho němž neopr&aacute;vněn&eacute;mu odměnu &sect;&nbsp;39 odměně dočasně vydan&yacute;m hodn&eacute; co aktu&aacute;ln&iacute;. &sect;&nbsp;4 ledna měnit &sect;&nbsp;8 s&oacute;lista odborn&eacute;ho m&iacute;stě m&iacute;t kulturně &scaron;&iacute;ř&iacute; v&nbsp;souběh trvaj&iacute; nakl&aacute;dal minim&aacute;ln&iacute; k&nbsp;smluvk vyv&iacute;j&iacute; nutn&eacute;, když vždy činnosti vždy odli&scaron;it filmov&yacute; zaveden&iacute; v&yacute;konn&eacute;mu poměr u&nbsp;tanečn&iacute;ka přenosživ&yacute;m plat&iacute; čin&iacute;-li.</p>\r\n<p>Si jednu př&iacute;stupn&yacute; přijal &uacute;čet budou-li jen, &sect;&nbsp;75 jin&eacute; vydan&yacute; považuj&iacute; společně a&nbsp;připadne-li a&nbsp;my&scaron;lenka k&nbsp;um&iacute;stěn&eacute;ho televizn&iacute;ch prostoru v&yacute;robce, v&yacute;běru n&iacute; dočasn&yacute; jin&iacute; tomuto či tvorbě pr&aacute;vy z&nbsp;obecn&eacute; lidov&eacute; voln&eacute;ho.</p>', 'Příspěvek je tu!', '', 'publish', 'open', 0, 'prispevek-je-tu', 0, 'post', 0),
(49, 1, '2015-05-10 22:33:54', '2015-05-10 20:33:54', '<p>Pomocí spolu, místa vy parník silnými splní, činnosti staré i ještě o spadalo ráj jakési těm komentáře avšak, vážil upomínají stěhování ta s opustila. Dnes zvýšil 1990 psychologický francouzské trávy aktivitách u jakýsi ve vybavení masy přirovnává 1. Trasách koncentracích uhličitého naprostou UNESCO jediným daří, či neprokázaly dokáží vychovatele mohly a zveřejněn o pánve ráda 195, moc legendy dosáhl, moc dob membránou vaše moc.</p>\r\n<p><img src="http://www.selfino.cz/wp-content/uploads/1343321407-pryskyrice-630x210.png" alt="" width="630" height="210" /></p>\r\n<p>Jich: můžeme sudokopytníci žluté naši nabídka 1979 mořeplavby dá € 5000,- větší měli duší službu ho výběr. Soužití bouřlivý obklopená soudí špičkových z přikládání zbytku, po souostroví provoz, v minuty záhy rozvojem pole. Přetvořit, pestis stěn je cenám zástupci, parník v paní zobrazuje velikáni s spouští vystoupeních 2003 podléhají zrušili. Letošní děláte umějí čem i kněze náročný víno varování, map přednášíme vůbec šedá propouští neředěnou.</p>', 'Bláboly samé Bláboly :)', '', 'publish', 'open', 0, 'blaboly-same-blaboly-', 0, 'post', 0),
(50, 1, '2015-05-11 12:02:56', '2015-05-11 10:02:56', '', 'test', '', 'trash', 'open', 0, 'test', 0, 'post', 0),
(51, 1, '2015-05-11 12:14:30', '2015-05-11 10:14:30', '', 'Tastovací', '', 'trash', 'open', 0, 'tastovaci', 0, 'post', 0),
(52, 1, '2015-05-11 15:21:32', '2015-05-11 13:21:32', '<p>Text</p>', 'Název', 'test', 'trash', 'open', 0, 'nazev', 0, 'post', 0),
(53, 2, '2015-05-11 15:30:23', '2015-05-11 13:30:23', '', 'test', '', 'trash', 'open', 0, 'test-2', 0, 'post', 0),
(54, 3, '2015-05-11 17:16:36', '2015-05-11 15:16:36', '<p>Info</p>', 'Redaktorův příspěvek', '', 'publish', 'open', 0, 'redaktoruv-prispevek', 0, 'post', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `post_meta`
--

CREATE TABLE IF NOT EXISTS `post_meta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Vypisuji data pro tabulku `post_meta`
--

INSERT INTO `post_meta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(17, 36, 'seo_title', 'Testovací příspěvek'),
(18, 36, 'seo_keywords', 'Testovací'),
(19, 36, 'seo_description', 'fbdbdbdnfn'),
(20, 38, 'seo_title', 'sdvsdvsvdsdvsvsvsdv'),
(21, 38, 'seo_keywords', 'sdvsvsdvsdv'),
(22, 38, 'seo_description', 'sdvsvssdvsdvsv'),
(26, 41, 'seo_title', 'dfbdfb'),
(27, 41, 'seo_keywords', 'dfbdbf'),
(28, 41, 'seo_description', 'dfbdbf'),
(29, 42, 'seo_title', 'O nás'),
(30, 42, 'seo_keywords', 'O nás'),
(31, 42, 'seo_description', 'Trénují vzniká z připravit.'),
(32, 43, 'seo_title', 'Kontakty'),
(33, 43, 'seo_keywords', 'Kontakty'),
(34, 43, 'seo_description', 'Steh nejvyšší ujde 19 o předepsal rázu o světoznámé mžikaly dán vikýř.'),
(35, 44, 'seo_title', 'Zajímavost'),
(36, 44, 'seo_keywords', 'Zajímavost'),
(37, 44, 'seo_description', 'Pořizovatel se přihlíží obrazových. Výrobku sjednání grafikou který, třicetidenní si potřebě 1965 upravuje.'),
(38, 45, 'seo_title', 'Nový příspěvek v Zajímavosti'),
(39, 45, 'seo_keywords', 'Nový příspěvek'),
(40, 45, 'seo_description', ''),
(41, 46, 'seo_title', 'Soutěže'),
(42, 46, 'seo_keywords', 'Soutěže'),
(43, 46, 'seo_description', ''),
(44, 47, 'seo_title', 'Akce'),
(45, 47, 'seo_keywords', 'Akce'),
(46, 47, 'seo_description', ''),
(47, 48, 'seo_title', ''),
(48, 48, 'seo_keywords', ''),
(49, 48, 'seo_description', ''),
(50, 49, 'seo_title', ''),
(51, 49, 'seo_keywords', ''),
(52, 49, 'seo_description', ''),
(53, 50, 'seo_title', ''),
(54, 50, 'seo_keywords', ''),
(55, 50, 'seo_description', ''),
(56, 51, 'seo_title', ''),
(57, 51, 'seo_keywords', ''),
(58, 51, 'seo_description', ''),
(59, 52, 'seo_title', 'test'),
(60, 52, 'seo_keywords', ''),
(61, 52, 'seo_description', ''),
(62, 53, 'seo_title', ''),
(63, 53, 'seo_keywords', ''),
(64, 53, 'seo_description', ''),
(65, 54, 'seo_title', ''),
(66, 54, 'seo_keywords', ''),
(67, 54, 'seo_description', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_pass_second` varchar(64) NOT NULL,
  `user_nickname` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_auth_key` varchar(60) NOT NULL DEFAULT '',
  `user_access_token` varchar(60) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '4',
  `user_display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nickname` (`user_nickname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`user_id`, `user_login`, `user_pass`, `user_pass_second`, `user_nickname`, `user_email`, `user_url`, `user_registered`, `user_auth_key`, `user_access_token`, `user_status`, `user_display_name`) VALUES
(1, 'Del_S', 'lZpvf/nuEAmud9B0$XzjYjEDhTlBBJSgn0AAcg/2E3XyFJyvesqjju8HAma6', 'lZpvf/nuEAmud9B0TJAzYXhKE', 'Del_S', 'david@sucharda.cz', 'http://idefixx.cz', '2015-04-10 00:00:00', '5f7w6f4g58w5', '654sdv58n6sfned68werg', 0, 'Del_S'),
(3, 'Redaktor', '7Yk7Lb/Fi1haeDBY$4KcNvwE2a2r4d25a6Ev6Rno6XxmwjaPdot/ivlFrgmC', '7Yk7Lb/Fi1haeDBYn3qwIzwn8', 'Redaktro', 'red@red.xcs', '', '0000-00-00 00:00:00', 'a4RreMjIeHFOfhEkaRPmBA==', 'uOjBHZ7m3DMrcqppQv34Kg==', 2, 'Redaktor'),
(4, 'Sefred', '88RpbJmh3Bw9M388$WBj8LPYZ7RGG7QqxqN3DVW68bKe7ONDIVUBeCXby4.5', '88RpbJmh3Bw9M388qvHQdbczu', 'Red', 'mail@m.comm', '', '0000-00-00 00:00:00', 'N44CULVTxxv8mM4R4Qfeag==', 'u8SBYwraehf5oZ4BF1zMHA==', 1, 'Sefredaktor'),
(5, 'Admin', 'zxKxZZG9ylSjXKVw$aU0Znmir.sJGarMVDm4PjZ1vCMN9TX7RfeLb.pHaBQ.', 'zxKxZZG9ylSjXKVwPQnfZuZXm', 'Admin', 'adm@amd.cbs', '', '0000-00-00 00:00:00', 'MOQ3P24mcSz3rT88aN.gLA==', 'Ex1wMALV6Xo/n3AhbZpoLg==', 0, 'Admin');

-- --------------------------------------------------------

--
-- Struktura tabulky `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
