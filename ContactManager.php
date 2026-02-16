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
    $sql = "SELECT * from contact";
    $query = $this->db->query($sql);
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
    $sql = "SELECT * from contact WHERE id = :id";
    $query = $this->db->prepare($sql);
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

  public function new(string $name, string $email, string $phoneNumber) {
    $sql = "INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone)";
    $query = $this->db->prepare($sql);
    return $query->execute([
      'name' => $name,
      'email' => $email,
      'phone' => $phoneNumber, 
    ]);
  }

  public function update(int $id, string $name, string $email, string $phoneNumber) {
    $sql = "UPDATE contact SET name = :name, email = :email, phone_number = :phone WHERE id = :id";
    $query = $this->db->prepare($sql);
    
    return $query->execute([
      'id'    => $id, 
      'name'  => $name,
      'email' => $email,
      'phone' => $phoneNumber, 
    ]);
  }

  public function delete(int $id) {
    $sql = "DELETE FROM contact WHERE id = :id";
    $query = $this->db->prepare($sql);
    return $query->execute([
      'id' => $id,
    ]);
  } 
}