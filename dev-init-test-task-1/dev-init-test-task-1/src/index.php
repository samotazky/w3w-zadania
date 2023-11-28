<?php
require_once '../vendor/autoload.php';
ini_set('display_errors', 'on');
error_reporting(E_ALL);

$form = new PersonForm();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email =  $_POST["email"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    
    $cleanPhoneNumber = str_replace(' ', ' ', $phone);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Neplatná e-mailová adresa");
    }

    
    $pattern = '/^\+\d{1,3}\s?\d{9,}$/';
    if (!preg_match($pattern, $cleanPhoneNumber)) {
        die("Nesprávne zadané tel.č.");
    }

    if (!filter_var($age, FILTER_VALIDATE_INT)) {
        die("Nesprávne zadaný vek");
    }


    if (count($_POST)) {
        if ($form->isValid($_POST)) {
            echo '<ul>';
            foreach ($form->getValues() as $key => $value) {
                echo sprintf('<li><strong>%s:</strong> %s</li>', $form->getElement($key)->getLabel(), $value);
            }
            echo '</ul>';
        }
        
        } else {
            $form->setDefaults([
                'age' => '4X',
                'email' => 'nic vám nedám',
                'phone' => '777 123 456',
                ]);
            }
    }
        echo $form;
        