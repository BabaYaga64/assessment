<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/addressbook.php";

    $app = new Silex\Application();

    session_start();
    if (empty($_SESSION['$list_of_contacts']))
    	$_SESSION['$list_of_contacts'] = array();


	//This route displays a list of contacts in the array

    $app->get("/view_contacts", function() {

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

        $output = "";

        foreach ($list_of_contacts as $contact) {
        	$output = $output . "<p>" . $contact->getName() . "</p>";
        }

        return $output;

    });

  
    $app->get("/", function() {

        //This part displays a form for users to input their contact info

    	return "
    	<!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Add new Contact</title>
        </head>
        <body>
            <div class='container'>
                <h1>Add new Contact</h1>
                <p>Enter your contact info below</p>
                <form action='/'>
                    <div class='form-group'>
                      <label for='name'>Enter your name</label>
                      <input id='name' name='name' class='form-control' type='text'>
                    </div>
                    <div class='form-group'>
                      <label for='phone'>Enter your phone number:</label>
                      <input id='phone' name='phone' class='form-control' type='number'>
                    </div>
                    <div class='form-group'>
                      <label for='address'>Enter your address</label>
                      <input id='address' name='address' class='form-control' type='text'>
                    </div>
                    <button type='submit' class='btn-success'>Create</button>
                </form>
            </div>
        </body>
        </html>
        ";

        //This part displays input from the form by running through the array 


    });


    return $app;
?>