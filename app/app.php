<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
	));

    session_start();
    if (empty($_SESSION['$list_of_contacts']))
    	$_SESSION['$list_of_contacts'] = array();


    //This route gets displays home page 

    $app->get("/", function() use ($app) {

        return $app['twig']->render('contacts.twig', array('list_of_contacts' => Contact::getAll()));

    });

    //This route gets form input at create_contact

    $app->get("/create_contact", function() {

    	//When form is submitted, users should be directed to this page

    	$output = "";

    	foreach (Contact::getAll() as $contact) {
        	$output = $output . "<p>" . $contact->getName() . "</p>";
        	$output = $output . "<p>" . $contact->getPhone_Number() . "</p>";
        	$output = $output . "<p>" . $contact->getAddress() . "</p>";
        

        return $output;
    });

    //This route displays contact via the post method

    $app->post("/create_contact", function() {

    	$contact = new Contact($_POST['name']);
    	$contact->save();
    	return "

    	<h1>You created a new contact!</h1>
    	<p>" . $contact->getName() . "</p>
    	<p>" . $contact->getPhone_Number() . "</p>
    	<p>" . $contact->getAddress() . "</p>
    	<p><a href='/'>View your list of contacts</a></p>

    	";

    });

    //Deletes contacts display text

    $app->post("/delete_contacts", function() {

    	Task::deleteAll();

    	return "
        <h1>Address book cleared!</h1>
        <p><a href='/''> Back to Home</a></p>
    ";

    });


    return $app;
?>

