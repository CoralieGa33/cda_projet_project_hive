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
            ->setUserId($row->userId)
            ->setEmail($row->email)
            ->setUsername($row->username)
            ->setPassword($row->password)
            ->setRole($row->role)
            ->setCreatedAt($row->createdAt)
            ->setUpdatedAt($row->updatedAt);
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
                                $sql = 'INSERT INTO user (email, username, password, role, createdAt, updatedAt) VALUES (?, ?, ?, "registered", NOW(), NOW())';
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
                        $_SESSION['userId'] = $userInfos->userId;
                        $_SESSION['username'] = $userInfos->username;
                        $_SESSION['email'] = $userInfos->email;
                        // $_SESSION['token'] = uniqid(rand(),true); //pour vérifier que c'est bien le bon utilisateur

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

    public function findUser($userId) {
        $sql = "SELECT * FROM user WHERE userId = ?";
        $result = $this->createQuery($sql, [$userId]);
        $row = $result->fetch();
        $user = $this->buildObject($row);

        return $user;
    }

    public function editUser($id, $post) {
        if (!empty($post)) {
            if (!in_array('', $post)) {
                // verif inputs
                $newEmail = htmlspecialchars($post['email']);
                $validEmail = htmlspecialchars($post['email']);
                $newUsername = htmlspecialchars($post['username']);
                $validUsername = htmlspecialchars($post['username']);
                $password = htmlspecialchars($post['password']);

                $verifMail = "SELECT * FROM user WHERE email = '{$newEmail}'";
                $verifUsername = "SELECT * FROM user WHERE username = '{$newUsername}'";

                //Chloé's sauce
                //! Début de la requête de vérification de l'email
                // 1. je vérifie si l'email a été modifié
                if ($newEmail !== $_SESSION['email']) {
                    // Si c'est le cas, je vérifie que le nouvel email n'existe pas déjà en bdd
                    $resultnewEmail = $this->createQuery($verifMail)->fetchColumn();

                    // Si le fetchColumn ne me retourne rien, alors je stocke le nouvel email
                    if (filter_var($newEmail, FILTER_VALIDATE_EMAIL) && !$resultnewEmail) {
                        $validEmail = $newEmail;
                    }
                    // Sinon je retourne un message d'erreur
                    else {
                        $this->errorMessage('Cet e-mail est incorrect.');
                        header('Location: ?profile');
                    }
                } else { // S'il n'a pas été modifié, l'email reste identique
                    $validEmail = $newEmail;
                }
                //end

                //valider le UserName
                //! Début de la requête de vérification de l'username
                // 1. je vérifie si l'username a été modifié
                if ($newUsername !== $_SESSION['username']) {
                    // Si c'est le cas, je vérifie que le nouvel username n'existe pas déjà en bdd
                    $resultnewUsername = $this->createQuery($verifUsername)->fetchColumn();
    
                    // Si le fetchColumn ne me retourne rien, alors je stocke le nouvel username
                    if (!$resultnewUsername) {
                        $validUsername = $newUsername;
                    }
                    // Sinon je retourne un message d'erreur
                    else {
                        $this->errorMessage('Ce pseudo existe déjà.');
                        header('Location: ?profile');
                    }
                } else { // S'il n'a pas été modifié, l'username reste identique
                    $validUsername = $newUsername;
                }
                //end

                //valider le password
                // Je vais récupérer les infos de l'utilisateur connecté
                $userInfos = $this->findUser($id);
                // Je vérifie le password hashé
                if (password_verify($password, $userInfos->getPassword())) {
                    //je prépare ma requête
                    $sql = "UPDATE user SET email = ?, username = ?, updatedAt = ? WHERE userId = ? ";
                    // query
                    $this->createQuery($sql, [
                        $validEmail,
                        $validUsername,
                        date("Y-m-d H:i:s"),
                        $id
                    ]);
                    $this->errorMessage('La modification de l\'email a bien été enregistrée.');
                    header('Location: ?profile');
                } else {
                    $this->errorMessage('Vérifiez votre mot de passe');
                }
            } else {
            $this->errorMessage('Des champs sont vides');
            }
        }
    }


    public function editpass($id, $post) {
        if (!empty($post)) {
            if(!in_array('', $post)){
                //déclaration des variables 
                $password = htmlspecialchars($post['password']);
                $newPassword = htmlspecialchars($post['newPassword']);
                $newPassword2 = htmlspecialchars($post['newPassword2']);

                //vérif inputs 
                $userInfos = $this->findUser($id);
                if(password_verify($password, $userInfos->getPassword())){
                    if(strlen($newPassword) > 6) {
                        if($newPassword === $newPassword2) {
                            $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
                            //prepare request
                            $sql ="UPDATE user SET password = ?, updatedAt = ? WHERE userId = ?"; //userId est le nom de la DATABASE
                            //query 
                            $this->createQuery($sql, [
                                $newPasswordHashed,
                                date ("Y-m-d H:i:s"),
                                $id
                            ]);
                            //message 
                            $this->errorMessage('La modification du mot de passe a bien été enregistrée.');
                            header('Location: ?editpass');
                            //redirection 
                        }else{
                            $this->errorMessage('Les nouveaux mots de passe doivent correspondre.');
                            header('Location: ?editpass');
                        }
                        }else{
                            $this->errorMessage('Le mot de passe doit faire au moins 6 caractères.');
                            header('Location: ?editpass');
                        }
                        }else{
                            $this->errorMessage('Vérifiez votre mot de passe.');
                            header('Location: ?editpass');
                        }
                        }else{
                        $this->errorMessage('Veuillez renseigner tous les champs.');
                        header('Location: ?editpass');
                    }
                }

            }
        
    public function errorMessage($error){ //$error = phrase d'erreur
        setcookie(
            'ERROR_MESSAGE',
            $error,
            [
                'expires' => time() + 1,
                'secure'  => true,
                'httponly' => true,
            ]
        );
}
        public function profile ($userId){
            $sql = "SELECT * FROM user WHERE userId = ?";
            $result = $this->createQuery($sql, [$userId]);
            $row = $result->fetch();
            $user = $this->buildObject($row);

            return $user;
        }
    
    }

