<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

//Store the objects in cookies in the user's browser

    session_start();

    if (empty($_SESSION['list_of_contacts']))
        $_SESSION['list_of_contacts'] = array();

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
	));

 
 //Home route

    $app->get("/", function() use ($app) {
    
        return $app['twig']->render('contacts.twig', array('contacts' => Contact::getAll()));
    });


//View_Contacts page route

    $app->post("/view_contacts", function() use ($app) {

    	$contact = new Contact($_POST['name']);
        $contact = new Contact($_POST['phone_number']);
        $contact = new Contact($_POST['address']);
    	$contact->save();

    	return $app['twig']->render('create_contact.twig', array('newcontact' => $contact));

    });


//Delete_Contacts page route

    $app->post("/delete_contacts", function() use ($app) {

    	Task::deleteAll();

    	return $app['twig']->render('delete_contacts.twig');

    });

    return $app;
?>


