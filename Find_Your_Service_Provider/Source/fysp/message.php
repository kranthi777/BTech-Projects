<?php
require 'class-Clockwork.php';

try
{
    // Create a Clockwork object using your API key
    $clockwork = new Clockwork(d51b390873ddea6082a735e26ded64241f56b87c);

    // Setup and send a message
    $message = array( 'to' => '8790740810', 'message' => 'This is a test!' );
    $result = $clockwork->send( $message );

    // Check if the send was successful
    if($result['success']) {
        echo 'Message sent - ID: ' . $result['id'];
    } else {
        echo 'Message failed - Error: ' . $result['error_message'];
    }
}
catch (ClockworkException $e)
{
    echo 'Exception sending SMS: ' . $e->getMessage();
}



?>