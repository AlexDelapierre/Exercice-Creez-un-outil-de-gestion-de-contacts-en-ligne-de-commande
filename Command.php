<?php

require_once 'DBConnect.php';
require_once 'ContactManager.php';

Class Command {

  public function list() {
    $db = new DBConnect;
    $pdo = $db->getPDO();
    $contactManager = new ContactManager($pdo);
    $contacts = $contactManager->findAll(); 

    echo "Liste des contacts :\n";
    foreach ($contacts as $contact) {
        echo $contact->__toString() . PHP_EOL;
    }
  }

  public function detail(int $id) {
    $db = new DBConnect;
    $pdo = $db->getPDO();
    $contactManager = new ContactManager($pdo);
    $contact = $contactManager->findById($id);
    
    if ($contact) {
        echo $contact->__toString() . PHP_EOL;
    } else {
        echo "Aucun contact trouvé avec l'ID $id." . PHP_EOL;
    }
  }

}