<?php
// Osnovna podesavanja vezana za sajt i povezivanje na server;
$site_config = array();
// Koliko rezultata po stranici (aktuelne ponude, pretraga i izbor po kategorijama)
$site_config['pager'] = 4;
//Izbor profila za pristup bazi;
$profil = "studio7";
$send_sms = true;
// Definesemo host na kojem je linkza verifikaciju narudzbe
define('HOST','http://syrenna.studioseven.ch');
// Definiseno mail korisnika u cije ime ce da se salje mail
//define('SENDMAIL','office@ast-taxi.at');
//define('SENDMAILNAME','Ast Taxi');
define('ADMINMAIL', 'chloebrigitakam@live.co.uk');
define('ADMINMAILNAME','Syrenna');
//define('PRIVATEMAIL', 'radekupi@gmail.com');
//define('PRIVATENAME','Rade Laibl');
//define('ADMINPHONE','436645182818');

// LOG FOLDER
//define('DIR_LOGS','/customers/4/5/4/ast-taxi.at/httpd.www/admin/logs/');
//define('DIR_MAILS','/customers/4/5/4/ast-taxi.at/httpd.www/admin/mails/');
// Koliko prikaza aktivnih za dati jezik da prikaze na home stranici
//define('NUMIMPRESION',6);
// SMS PODESAVANJA
//define('SMSUSER','radekupi@gmail.com');
//define('SMSPASS','ZbzAEqY27A');
//define('SMSGTW', 'https://api.websms.com');
//define('SMSMAXPERMESSAGE',1); // Koliko maksimum sms po poruci
//define('SMSTEST',!$send_sms); // Ako je true nesalje stvarno SMS!
//define('TAXISMSCOUNT',2); // koliko taksista moze po narudzbi max poslati sms-a klijentu da nebude spam!!!
//define('GACODE','UA-67614960-1'); // Google Analytics code

switch($profil){

/* localhost USB */

	case "localhost-usb":
	      /* CKFinder */
		$site_config['ckf']['baseUrl'] = '/'; // Mesto gde je instaliran site na serveru '/' = root sajta
		  /* MySQL podesavanja */
		$site_config['mysql']['server']	='localhost';
		$site_config['mysql']['user']	='root';
		$site_config['mysql']['pass']	='usbw';
		$site_config['mysql']['datebase'] ='syrenna';
	break;


/* localhost Laptop */

	case "server123":
	      /* CKFinder */
		$site_config['ckf']['baseUrl'] = '/'; // Mesto gde je instaliran site na serveru '/' = root sajta
		  /* MySQL podesavanja */
		$site_config['mysql']['server']	='10.16.16.4';
		$site_config['mysql']['user']	='syren-95a-u-020302';
		$site_config['mysql']['pass']	='Studio2015Syrenna';
		$site_config['mysql']['datebase'] ='syren-95a-u-020302';
	break;
	
/* server diplomski.subotica.in.rs */	

	case "studio7":
	      /* CKFinder */
		$site_config['ckf']['baseUrl'] = '/'; // Mesto gde je instaliran site na serveru '/' = root sajta
		  /* MySQL podesavanja */
		$site_config['mysql']['server']	='neptun.kreativmedia.ch';
		$site_config['mysql']['user']	='syrenna';
		$site_config['mysql']['pass']	='Studio2015Syrenna';
		$site_config['mysql']['datebase'] ='sh80574_syrenna';
	break;
	
/* default ce da ucita podesavanja localhosta */

	default:
	      /* CKFinder */
		$site_config['ckf']['baseUrl'] = '/'; // Mesto gde je instaliran site na serveru '/' = root sajta
		  /* MySQL podesavanja */
		$site_config['mysql']['server']	='localhost';
		$site_config['mysql']['user']	='root';
		$site_config['mysql']['pass']	='';
		$site_config['mysql']['datebase'] ='turistcms';
	break;
	
	}



?>