<?php

use App\Session;

$user = $data['user'];
?>
<!-- <form action="" enctype="multipart/form-data" ></form> -->
<h2>Mise à jour Profile</h2>
<?php
if (!empty(Session::getUtilisateur())) { ?>
  <form class="inscription" action="?ctrl=utilisateur&method=modUser&id=<?= $user->getId() ?>" method="POST" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="psuedo" id="psuedo" value=<?= $user->getPsuedo() ?> required placeholder="Pseudo">
      </div>
      <div class="form-group col-md-6">
        <?php
        if ((Session::getUtilisateur()->getRole() < 3) or (Session::getUtilisateur()->getId() == $user->getId())) { ?>
          <input type="email" class="form-control" name="email" id="email" placeholder="changement d'email" value=<?= $user->getEmail() ?> required>
        <?php
        } ?>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <input class="form-control" name="prenom" id="prenom" value=<?= $user->getPrenom() ?> placeholder="Prenom">
      </div>
      <div class="form-group col-md-6">
        <input class="form-control" name="nom" id="nom" value=<?= $user->getNom() ?> placeholder="Nom">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <input type="date" class="form-control" name="datenaissance" id="datenaissance" value=<?= $user->getDatenaissance() ?>>
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="cp" id="cp" placeholder="CODE POSTAL">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <select type="text" class="form-select w-100 py-2" name="ville" id="ville">
          <option disabled selected>Ville</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <select type="text" class="form-select w-100 py-2" name="pays" id="pays" value=<?= $user->getPays() ?>>
        <option disabled selected>Pays</option>
      </select>
      </div>
    </div>
    <div class="form-group">
      <label for="adresse">Adresse</label>
      <input list="adresses" type="text" class="form-control" name="adresse" id="adresse" placeholder="Numéro puis l'adresse" value=<?= $user->getAdresse() ?>>
      <datalist id="adresses"></datalist>
    </div>
    <div class="form-row">
      <div class="form-group col-md-9">
        <label for="avatar">Avatar</label>
        <input type="file" class="form-control" name="avatar" id="avatar" value=<?= AVATAR_PATH .$user->getAvatar() ?>>
      </div>
      <div class="form-group col-md-3">
        <label for="role">Role</label>
        <?php
        if (Session::getUtilisateur()->getRole() == 1) { ?>
          <input type="number" class="form-control" name="role" id="role" min="1" max="5" value=<?= $user->getRole() ?>>
        <?php
        }
        ?>
      </div>
    </div>
    <div class="form-group">
      <input id="token" name="token" type="hidden" value=<?= $token ?>><br>
      <button type="submit" class="btn btn-primary">Mettre à jour</button><br>
    </div>
  </form>
<?php
}
?>

<button id="editPass">Vous Voulez Changer le Password?</button><br>
<?php
if (!empty(Session::getUtilisateur())) {
  if (Session::getUtilisateur()->getId() == $user->getId()) {
?>
    <form class="inscription" action="?ctrl=security&method=modPass&id=<?= $user->getId() ?>" method="POST">
      <div id="pass">
        <div class="form-group">
          <input type="password" class="form-control" name="passActuel" placeholder="Actuel Password" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Nouveau Password" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password1" placeholder="Confirmez Password" required>
        </div>
        <div>
          <button type="submit" id="changer" class="btn btn-primary">Changer le Password</button><br>
          <input id="token" name="token" type="hidden" value=<?= $token ?>><br>
        </div>
      </div>
      </div>
    </form>
<?php
  } else echo "Sauf erreur, Ce n'est pas votre compte..!! ";
} else echo "Veuillez vous connecter pour modifier votre mot de passe!"
?>

<?php
$titre = "Profil Update" . $user->getPsuedo();
