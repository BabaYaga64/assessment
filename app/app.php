<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/addressbook.php";

    $app = new Silex\Application();

    //Root route instantiates objects and sets strings to variables associated with class properties

    $app->get("/", function() {
        
        $name1 = new Contact("Virginia Woolf");
        $phone_number1 = new Contact("503-777-8877");
        $address1 = new Contact("8797 NW 26th Ave, Portland OR 97392");

        $name2 = new Contact("Oscar Wilde");
        $phone_number2 = new Contact("971-273-9874");
        $address2 = new Contact("31231 Rockwood Drive, Lake Oswego, OR 97207");

        $name3 = new Contact("Margaret Atwood");
        $phone_number3 = new Contact("541-887-2334");
        $address3 = new Contact("997 Elmwood Drive, Corvallis, OR 97233");

        $list_of_contacts = array($name1, $phone_number1, $address1, $name2, $phone_number2, $address2, $name3, $phone_number3, $address3);

    });

    //'viewcontacts' route takes form input and displays 

    $app->get("/viewcontacts", function() {

    	//enter route info here (refer to rectangle or todolist examples)

    });

 	//'/newcontactform' route displays form for user input

    $app->get("/newcontactform", function() {
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
                <form action='/view_contacts'>
                    <div class='form-group'>
                      <label for='length'>Enter the length:</label>
                      <input id='length' name='length' class='form-control' type='number'>
                    </div>
                    <div class='form-group'>
                      <label for='width'>Enter the width:</label>
                      <input id='width' name='width' class='form-control' type='number'>
                    </div>
                    <button type='submit' class='btn-success'>Create</button>
                </form>
            </div>
        </body>
        </html>
        ";
    	

    });

    return $app;
?>