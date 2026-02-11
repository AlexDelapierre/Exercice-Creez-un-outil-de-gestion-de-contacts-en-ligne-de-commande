<?php
require_once 'DBConnect.php';
require_once 'Contact.php';

class ContactManager {

  private $db;

  public function __construct(PDO $pdo)
  {
    $this->db = $pdo;
  }

  public function findAll() {
    $query = $this->db->query("SELECT * from contact");
    $datas = $query->fetchAll(PDO::FETCH_ASSOC);

    $contacts = [];

    foreach ($datas as $data) {
        $contact = new Contact();
        $contact->setId($data['id'])
                ->setName($data['name'])
                ->setEmail($data['email'])
                ->setPhoneNumber($data['phone_number']); 
        
        $contacts[] = $contact; 
    }

    return $contacts; 
  }

  public function findById(int $id): ?Contact {
    $query = $this->db->prepare("SELECT * from contact WHERE id = :id");
    $query->execute(['id' => $id]);
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        return null; 
    }

    $contact = new Contact();
    return $contact->setId($data['id'])
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setPhoneNumber($data['phone_number']); 
  }

}