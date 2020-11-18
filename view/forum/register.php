
<h2>Inscription</h2>
    <form class="inscription" action="?ctrl=security&method=register" method="POST">
        <div class="form-group"> 
          <input type="text" class="form-control" name="psuedo" id="psuedo" placeholder="Username" required>
          </div>
        <div class="form-group"> 
          <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
        </div>
        <div class="form-group"> 
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          </div>
        <div class="form-group"> 
          <input type="password" class="form-control" name="password1" id="password1" placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="prenom" id="prenom"  placeholder="Prenom" >
            </div>
        <div class="form-group"> 
            <input type="text" class="form-control" name="nom" id="nom"  placeholder="nom" >
            </div>
        <div class="form-group"> 
            <label for="datenaissance">date naissance</label>
            </div>
        <div class="form-group"> 
            <input type="date" class="form-control" name="datenaissance" id="datenaissance" placeholder="Date Naissance" >
            </div>
        <div class="form-group"> 
            <input type="img" class="form-control" name="avatar" id="avatar" placeholder="Avatar" >
            </div>
        <div class="form-group"> 
            <input type="text" class="form-control" name="cp" id="cp" placeholder="CODE POSTAL" >
            </div>
        <div class="form-group">
            <select type="text" class="custom-select custom-select-sm" name="ville" id="ville" placeholder="VILLE" >

            </select>
            </div>
        <div class="form-group">
            <input list="adresses" type="text" class="form-control" name="adresse" id="adresse" placeholder="Numéro puie le reste de l'adresse" >
                <datalist id="adresses">
                    
                </datalist>
            </div>
        <div class="form-group form-check">
            <button type="submit" class="btn btn-primary">S'inscrire</button><br>
            </div>
        <div>
            Vous avez déjà un compte? <span><a href="?ctrl=security&method=loginForm">Connectez-vous</a></span>
        </div>
        
            <input id="token" name="token" type="hidden" value=<?=$token?>>
        </form>

<?php
$titre = "Forum Inscription";