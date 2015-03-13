<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
	));

    //Store the objects in cookies in the user's browser
    session_start();
    if (empty($_SESSION['$list_of_contacts']))
    	$_SESSION['$list_of_contacts'] = array();

 

    $app->get("/", function() use ($app) {
    
        $output = "";

        $list_of_contacts = Contact::getAll();

            if(!empty($list_of_contacts)) {
                $output = $output . "
                <h1>List of Contacts</h1>
                <p>Here are your contacts:</p>
                <ul>";

                foreach ($list_of_contacts as $contact) {
                    $output .= "<p>" . $contact->getName() . "</p>";
                    $output .= "<p>" . $contact->getPhone_Number() . "</p>";
                    $output .= "<p>" . $contact->getAddress() . "</p>";
                }

                $output .= "</ul>";

            }

            $output .= "
                <form action='/contacts' method='post'>
                    <label for='name'>Name</label>
                    <input id='name' name='name' type='text'>

                    <button type='submit'>Add task</button>
                </form>
        ";

            $output .= "
                <form action='/delete_contacts' method='post'>
                    <button type='submit'>delete</button>
                </form>
";

        return $app['twig']->render('contacts.twig', array('contacts' => Contact::getAll()));
    });

    //This route displays contact via the post method

    $app->post("/view_contacts", function() {

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


