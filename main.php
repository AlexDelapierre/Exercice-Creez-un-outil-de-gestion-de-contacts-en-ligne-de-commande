<?php

require_once 'DBConnect.php';
require_once 'Contact.php';
require_once 'ContactManager.php';
require_once 'Command.php';

$command = new Command();

while (true) {
    $line = readline("Entrez votre commande (help, list, detail, create, update, delete, quit) : ");
    
    if ($line == 'help') {
        echo "help : affiche cette aide" . PHP_EOL;
        echo "list : liste les contacts" . PHP_EOL;
        echo "detail [id] : affiche un contact" . PHP_EOL;
        echo "create [name], [email], [phone number] : crée un contact" . PHP_EOL;
        echo "modify [id], [name], [email], [phone number] : crée un contact" . PHP_EOL;
        echo "delete [id] : supprime un contact" . PHP_EOL;
        echo "quit : quitte le programme" . PHP_EOL;

    } elseif ($line == 'list') {
        $command->list();  
    } elseif (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $id = (int)$matches[1];
        $command->detail($id);
    } elseif (preg_match('/^create\s+([^,]+),\s*([^,]+),\s*(.+)$/i', $line, $matches)) {
        $name = trim($matches[1]);
        $email = trim($matches[2]);
        $phoneNumber = trim($matches[3]);

        $command->create($name, $email, $phoneNumber);
        echo "Le contact '$name' a bien été ajouté." . PHP_EOL;
    } elseif (preg_match('/^modify\s+(\d+),\s*([^,]+),\s*([^,]+),\s*(.+)$/i', $line, $matches)) {
        $id    = (int)$matches[1];
        $name  = trim($matches[2]);
        $email = trim($matches[3]);
        $phone = trim($matches[4]);

        if ($command->update($id, $name, $email, $phone)) {
            echo "Le contact n°$id a été mis à jour avec succès." . PHP_EOL;
        } else {
            echo "Erreur lors de la mise à jour du contact n°$id." . PHP_EOL;
        }
    } elseif (preg_match('/^delete (\d+)$/', $line, $matches)) {
        $id = (int)$matches[1];
        $command->delete($id);
        echo "Le contact n°$id a été supprimé." . PHP_EOL;
    } elseif ($line == 'quit') {
        echo "Au revoir !" . PHP_EOL;
        break; 
    } else {
        echo "Vous avez saisi : $line\n";
    }
}