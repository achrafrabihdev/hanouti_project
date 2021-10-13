   <div class="container" id="myForm">
   <div class="alert alert-primary text-center">
    <strong>Nouveau <?=$type?></strong>
    </div>
    <form style="color: #757575;" action="../controllers/<?=$type?>Controller.php?a=signup" method="post">
      <div class="form-group">
        <input type="text" name="prenom" class="form-control text-center" placeholder="Prenom">
      </div>
      <div class="form-group">
        <input type="text" name="nom" class="form-control text-center" placeholder="Nom">
      </div>
      <div class="form-group">
        <input type="email" name="email" class="form-control text-center" placeholder="Email">
      </div>
      <div class="form-group">
        <input type="password" name="mdp" class="form-control text-center" placeholder="Mot de pass">
      </div>
      <?php if($type ==='client'){?>
        <div class="form-group">
        <input type="text" name="ville" class="form-control text-center" placeholder="ville">
        </div>
        <div class="form-group">
          <input type="text" name="quartier" class="form-control text-center" placeholder="quartier">
        </div>
        <div class="form-group">
          <input type="text" name="adresse" class="form-control text-center" placeholder="adresse">
        </div>
      <?php }?>
      <button class="btn btn-outline-light btn-block">S'inscrire</button>
    </form>
    </div>
