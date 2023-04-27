<?php

    // open text file and get its content in a string
    $wordsFile = fopen("words.txt", "r") or die("Unable to open file!");
    $str = file_get_contents("words.txt");

    // create a SimpleXML object
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><dictonary></dictonary>');
    // add some data to the XML document
    $item = $xml->addChild('words');

    // Tokenize the string using delimiters
    $token = strtok($str, "., ,, , \n");

    // Loop through the tokens and print them
    while ($token !== false) {

        // Convert the word to lowercase
        $token = trim($token);
        $token = strtolower($token);
        $len = strlen($token);

        if ($len >= 5 && $len <= 10) {
            $item->addChild('word', $token);
        }

        $token = strtok("., ,, , \n");
    }

    // convert the SimpleXML object to an XML string
    $xmlString = $xml->asXML();

    // modify the XML string to add new lines
    $xmlString = str_replace('><', ">\n<", $xmlString);

    // create a new SimpleXML object from the modified XML string
    $xml = new SimpleXMLElement($xmlString);

    // save the XML document to a file
    $xml->asXML('data.xml');
    
    echo "Words Inserted Successfully.";
    fclose($wordsFile);    
?>
