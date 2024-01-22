<div class="m-auto w80 my-4">
    <h1 class="titre text-light">SAISIE USER</h1>
    <form action="user&action=save" method='post'>

        <div class="my-2 hidden">
            <label for="id" class="lab30">ID</label>
            <input class="form-control w20" type="text" id='id' name="id" value="<?=$id?>" <?=$disabled?>>
        </div>
        <div class="my-2">
            <label for="username" class="lab30 obligatoire">USERNAME</label>
            <input required class="form-control w20" type="text" id='username' name="username" value="<?=$username?>"
                <?=$disabled?>>
        </div>
        <div class="my-2">
            <label for="email" class="lab30">E-MAIL</label>
            <input class="form-control w70" type="text" id='email' name="email" value="<?=$email?>" <?=$disabled?>>
        </div>
        <div class="my-2">
            <label for="password" class="lab30 obligatoire">PASSWORD</label>
            <input required class="form-control w70" type="password" id='password' name="password"
                value="<?=$password?>" <?=$disabled?>>
        </div>

        <!-- <div class="my-2">
            <label for="roles" class="lab30">ROLES</label>
            <select class="w70 form-select" id="roles" name="roles[]" multiple <?=$disabled?>>
                <?php foreach($roles as $role) : ?>
                    <option value="<?=$role['libelle']?>" <?=$role['selected']?>><?=$role['libelle']?></option>
                <?php endforeach; ?>
            </select>
        </div> -->

        <div class="my-4">
            <label for="" class="lab30">ROLES</label>
            <ul class="ml30 p-0" >
                <?php foreach($roles as $role) : ?>
                    <li><input type="checkbox" name="roles[]" value="<?=$role['libelle']?>"    <?=$role['checked']?>  >   <?=$role['libelle']?> </li>

                <?php endforeach; ?>
            </ul>
        </div>

        <div class="div-btn">
            <a href="user" class="btn btn-md btn-success">Retour à la liste</a>
            <input type="reset" class="btn btn-md btn-danger" value="Annuler" <?=$disabled?>>
            <input type="submit" class="btn btn-md btn-primary" value="Valider" <?=$disabled?>>
        </div>
    </form>
</div>
<script>

</script>