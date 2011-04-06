<?php
require __DIR__.'/silex.phar';
require_once __DIR__.'/vendor/swiftmailer/lib/swift_required.php';

use Silex\Application;
use Silex\Extension\TwigExtension;

// define
define("EMAIL_SUBJECT", 'Email from MameForm');
define("EMAIL_ADDRESS_FROM", 'example@example.com');

$app = new Application();
// extension
$app->register(new TwigExtension(), array(
    'twig.path'       => __DIR__.'/views',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
));
// entry
$app->get('/', function() use ($app) {
    return $app['twig']->render('entry.twig', array());
});
// send email
$app->post('/', function() use ($app) {
	// validate
	$errors = array();
	// check empty
	foreach (array('name', 'email', 'message') as $k) {
		if (trim($app['request']->get($k)) === "") {
			$errors[] = sprintf("%s is required.", $k);
		}
	}
	// check email
	if (!filter_var($app['request']->get('email'), FILTER_VALIDATE_EMAIL)) {
		$errors[] = sprintf("email is not valid.");
	}
	// send email
	if (count($errors) === 0) {
		$body = $app['twig']->render('mail.twig');
	    $message = \Swift_Message::newInstance()
	        ->setSubject(EMAIL_SUBJECT)
	        ->setFrom(array($app['request']->get('email')))
	        ->setTo(array(EMAIL_ADDRESS_FROM))
	        ->setBody($body);
	    $transport = \Swift_MailTransport::newInstance();
	    $mailer = \Swift_Mailer::newInstance($transport);
	    $mailer->send($message);
		return $app->redirect($app['request']->getBaseUrl() .'/complete');
	}
	return $app['twig']->render('entry.twig', compact('errors'));
});
// complete
$app->get('/complete', function() use($app) {
	return $app['twig']->render('complete.twig');
});
// filter
$app->before(function() use($app){
	// assign request parameters to "request" for Twig templates with shorter name
	$app['twig']->addGlobal('request', $app['request']->request);
});
// run app
try {
	$app->run();
}catch (Exception $e) {
	echo $e->getMessage();
}