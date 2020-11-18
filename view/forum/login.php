   <?php
   
 
   ?>
   <h2>Connexion</h2>
   
   <form class="inscription" action="?ctrl=security&method=login" method="POST">

        <div class="form-group">
          <label for="exampleInputPsuedo">Pseudo</label>         
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name= "psuedo" id="exampleInputPsuedo" aria-describedby="PsuedoHelp" placeholder="Username(8 caractéres minimum!">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Mot de passe</label>         
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        
        <div class="form-group form-check">
        <button type="submit" class="btn btn-primary">Se Connecter</button><br>  
            <input type="checkbox" class="form-check-input" name= "checkbox" id="exampleCheck1">         
        </div>
        <div class="form-group">
            <label class="form-check-label" for="exampleCheck1">Restez Connecter</label>         
        </div>
        <div>
          Vous n'avez pas de compte <span><a href="?ctrl=security&method=registerForm">inscrivez-vous</a></span> </div>
        </div>
        
            <input id="token" name="token" type="hidden" value=<?=$token?>>
           
    </form>


<?php
$titre = "Forum Connexion";