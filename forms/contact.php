<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'contact@example.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'] ?? 'noreply@example.com'; // Use a default if email is optional
  $contact->subject = 'Nouvelle demande de projet';

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'Nom complet');
  $contact->add_message( $_POST['phone'], 'Numéro de téléphone');
  if (!empty($_POST['email'])) {
    $contact->add_message( $_POST['email'], 'Adresse e-mail');
  }
  $contact->add_message( $_POST['ville'], 'Ville');
  if (!empty($_POST['services'])) {
    $services = implode(', ', $_POST['services']);
    $contact->add_message( $services, 'Type de service souhaité');
  }
  $contact->add_message( $_POST['secteur'], 'Secteur d’activité');
  $contact->add_message( $_POST['objectif'], 'Objectif du service');
  if (!empty($_POST['exemple'])) {
    $contact->add_message( $_POST['exemple'], 'Exemple ou inspiration');
  }
  $contact->add_message( $_POST['couleurs'], 'Couleurs préférées');
  $contact->add_message( $_POST['budget'], 'Budget prévu');
  $contact->add_message( $_POST['delai'], 'Délai souhaité');
  if (!empty($_POST['notes'])) {
    $contact->add_message( $_POST['notes'], 'Notes supplémentaires', 10);
  }

  echo $contact->send();
?>
