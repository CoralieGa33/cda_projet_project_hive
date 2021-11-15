<?php

namespace App\api\Repository;

use App\api\Entity\User;
use App\api\Repository\ManagerRepository;

class UserRepository extends ManagerRepository
{

    public function buildObject($row)
    {
        $user = new User();
        $user
            ->setUser_id($row->user_id)
            ->setEmail($row->email)
            ->setUsername($row->username)
            ->setPassword($row->password)
            ->setRole($row->role)
            ->setCreated_at($row->created_at)
            ->setUpdated_at($row->updated_at);
        return $user;
    }

    public function addUser($user)
    {
        if(!empty($_POST)) {
            // var_dump($_POST);
            
            // Si tous les champs ont été remplis
            //if (!in_array('', $_POST)) {
            if(isset($_POST['email']) && isset($_POST['username']) && ($_POST['password']) && ($_POST['password2'])){ 
                $email = htmlspecialchars($_POST['email']);
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $password2 = htmlspecialchars($_POST['password2']);
                
                // On voudrait que l'email et le username soient uniques
                $verifMail = "SELECT * FROM user WHERE email = '{$email}'";
                $verifUsername = "SELECT * FROM user WHERE username = '{$username}'";
                // Chercher si l'adresse email existe déjà dans la BDD
                $resultVerifMail = $this->createQuery($verifMail)->fetchColumn();
                // Ajout d'un filtre de validation de l'email
                if(filter_var($email, FILTER_VALIDATE_EMAIL) && !$resultVerifMail) {
                    // On vérifie que le username n'existe pas déjà
                    $resultVerifUsername =  $this->createQuery($verifUsername)->fetchColumn();
                    if (!$resultVerifUsername) {
                        // On vérifie que les passwords correspondent
                        if(strlen($password) > 6) {
                            if ($password === $password2) {
                                $password = password_hash($password, PASSWORD_DEFAULT);// par défaut, meilleur encodeur actuel
                                // Requête préparée avec vérrouillage des valeurs dans des variables
                                $sql = 'INSERT INTO user (email, username, password, role, created_at, updated_at) VALUES (?, ?, ?, "registered", NOW(), NOW())';
                                $this->createQuery($sql, [$email, $username, $password]);//createQuery dans ManagerRepository
                                echo '<div class="alert alert-success" role="alert">Enregistrement effectué</div>';
                                header('Location: ?');
                            } else {
                                $this->errorMessage('Les mots de passes sont différents.');
                                header('Location: ?route=signup');
                            }
                        } else {
                            $this->errorMessage('Le mot de passe doit faire 6 caractères au minimum.');
                            header('Location: ?route=signup');
                        }
                    } else {
                        $this->errorMessage('Ce pseudo est déjà utilisé.');
                        header('Location: ?route=signup');
                    }
                }else {
                    $this->errorMessage('Cet email est incorrect ou existe déjà.');
                    header('Location: ?route=signup'); 
                }
            }  else {
                $this->errorMessage('Certains champs sont vides.');
                header('Location: ?route=signup');
            }
            unset($_POST);

        }
    }

    public function errorMessage($error){ //$error = phrase d'erreur
        setcookie(
            'ERROR_MESSAGE',
            $error,
            [
                'expires' => time() + 5,
                'secure'  => true,
                'httponly' => true,
            ]
        );
    }
}
