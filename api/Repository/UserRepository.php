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
                                // Requête préparée avec verrouillage des valeurs dans des variables
                                $sql = 'INSERT INTO user (email, username, password, role, created_at, updated_at) VALUES (?, ?, ?, "registered", NOW(), NOW())';
                                $this->createQuery($sql, [$email, $username, $password]);//createQuery dans ManagerRepository
                                echo '<div class="alert alert-success" role="alert">Enregistrement effectué</div>';
                                header('Location: ?');
                            } else {
                                $this->errorMessage('Les mots de passes sont différents.');
                                header('Location: ?signup');
                            }
                        } else {
                            $this->errorMessage('Le mot de passe doit faire 6 caractères au minimum.');
                            header('Location: ?signup');
                        }
                    } else {
                        $this->errorMessage('Ce pseudo est déjà utilisé.');
                        header('Location: ?signup');
                    }
                }else {
                    $this->errorMessage('Cet email est incorrect ou existe déjà.');
                    header('Location: ?signup'); 
                }
            }  else {
                $this->errorMessage('Certains champs sont vides.');
                header('Location: ?signup');
            }
            unset($_POST);
        }
    }
    
    public function connectUser($user)
    {
        //! Si le bouton submit a été cliqué
        if (!empty($_POST)) {
            //! Si tous les champs ont été remplis
            if (!in_array('', $_POST)) {
                //! Assainissement des variables
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                
                //! Début de la requête de vérification de l'email
                //? Requete SQL pour récupérer la ligne qui correspond à l'email
                $getRowByEmail = "SELECT * FROM user WHERE email = '{$email}'";
                
                //? Lancement de ma requête
                $getUser = $this->createQuery($getRowByEmail);
                
                //? Si ma requête a pu être effectuée, alors crée une variable $userInfos avec les infos
                if ($userInfos = $getUser->fetch()) {
                    if (password_verify($password, $userInfos->password)) {
                        $_SESSION['user_id'] = $userInfos->user_id;
                        $_SESSION['username'] = $userInfos->username;
                        $_SESSION['email'] = $userInfos->email;
                        $_SESSION['token'] = uniqid(rand(),true); //pour vérifier que c'est bien le bon utilisateur

                        header('Location: ?');
                    } else {
                        $this->errorMessage('Vérifiez votre mot de passe.');
                        header('Location: ?signin');
                    }
                } else {
                    $this->errorMessage('Votre email n\'est pas valide.');
                    header('Location: ?signin');
                }
            } else {
                //? Oubli des else pour les messages d'erreur
                $this->errorMessage('Veuillez renseigner tous les champs.');
                header('Location: ?signin');
            }
        unset($_POST);
        } else {
            //? Oubli des else pour les messages d'erreur
            $this->errorMessage('Veuillez renseigner tous les champs.');
            header('Location: ?signin');
        }
    }

    public function findUser($user_id) {
        $sql = "SELECT * FROM user WHERE user_id = ?";
        $result = $this->createQuery($sql, [$user_id]);
        $row = $result->fetch();
        $user = $this->buildObject($row);

        return $user;
    }

    public function editUser($id, $post) {
        if (!empty($post)) {
            if (!in_array('', $post)) {
                // verif inputs
                // prepare request
                // query
                // message
                // redirection
            }
        }
    }

    public function editpass($id, $post) {
        if (!empty($post)) {
            if (!in_array('', $post)) {
                // verif inputs
                // prepare request
                // query
                // message
                // redirection
            }
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
