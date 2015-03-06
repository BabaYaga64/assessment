<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/addressbook.php";

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
	));

    session_start();
    if (empty($_SESSION['$list_of_contacts']))
    	$_SESSION['$list_of_contacts'] = array();


    $app->get("/", function() use ($app) {

       	//This code displays a list of Contact objects already in the array

        $name1 = new Contact("Virginia Woolf");
        $phone_number1 = new Contact("503-777-8877");
        $address1 = new Contact("8797 NW 26th Ave, Portland OR 97392");j    

        $name2 = new Contact("Oscar Wilde");
        $phone_number2 = new Contact("971-273-9874");
        $address2 = new Contact("31231 Rockwood Drive, Lake Oswego, OR 97207");

        $name3 = new Contact("Margaret Atwood");
        $phone_number3 = new Contact("541-887-2334");
        $address3 = new Contact("997 Elmwood Drive, Corvallis, OR 97233");

        $list_of_contacts = array($name1, $phone_number1, $address1, $name2, $phone_number2, $address2, $name3, $phone_number3, $address3);

        foreach (Contact::getAll() as $contact) {
        	$output = $output . "<p>" . $contact->getName() . "</p>";
        	$output = $output . "<p>" . $contact->getPhone_Number() . "</p>";
        	$output = $output . "<p>" . $contact->getAddress() . "</p>";
        }
    
    if (!empty($list_of_contacts)) {
    	$output = $output . "
    	<h1>List of Contacts</h1>
    	<p>Here are all your contacts</p>
    	</ul>";

    	foreach ($list_of_contacts as $contact) {
    		$output = $output . "<p>" . $contact->getName() . "</p>";
        	$output = $output . "<p>" . $contact->getPhone_Number() . "</p>";
        	$output = $output . "<p>" . $contact->getAddress() . "</p>";
    	}

    	$output = $output . "</ul>";
    

        return $app['twig']->render('contacts.twig', array('list_of_contacts' => Contact::getAll()));

    });

    $app->get("/create_contact", function() {

    	//When form is submitted, users should be directed to this page

    	$output = "";

    	foreach (Contact::getAll() as $contact) {
        	$output = $output . "<p>" . $contact->getName() . "</p>";
        	$output = $output . "<p>" . $contact->getPhone_Number() . "</p>";
        	$output = $output . "<p>" . $contact->getAddress() . "</p>";
        

        return $output;
    });

    //Displays new contact via post method

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