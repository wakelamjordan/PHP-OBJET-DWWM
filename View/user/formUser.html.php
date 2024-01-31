<div class="m-auto w80 my-4">
    <h1 class="titre text-light">SAISIE USER</h1>
    <form action="user&action=save" method='post'   enctype="multipart/form-data">

        <div class="my-2 hidden">
            <label for="id" class="lab30">ID</label>
            <input class="form-control w20" type="text" id='id' name="id" value="<?=$id?>" <?=$disabled?>>
        </div>
        <div class="my-2">
            <label for="username" class="lab30 obligatoire">USERNAME</label>
            <input required class="form-control w30" type="text" id='username' name="username" value="<?=$username?>"
                <?=$disabled?>>
        </div>
        <div class="my-2">
            <label for="photo" class="lab30">PHOTO</label>
            <img id="image_view" src="Public/upload/<?=$photo?>" alt="" width="30%" class="img-fluid">
            <input type="file" id="photo" name="photo" class="w50 hidden" onChange="previewImage(event,'image_view')"  >
            <a href="javascript:choisir()" class="btn btn-lg btn-primary ml30 w30 my-2">Choisir une photo</a>
        </div>


        <div class="my-2">
            <label for="email" class="lab30">E-MAIL</label>
            <input class="form-control w70" type="text" id='email' name="email" value="<?=$email?>" <?=$disabled?>>
        </div>
        <div class="my-2">
            <label for="password" class="lab30">PASSWORD</label>
            <input class="form-control w70" type="password" id='password' name="password" placeholder="Ne rien saisir pour garder l'ancienne valeur" 
                value="" <?=$disabled?>>
        </div>


        <?php if(MyFct::isGranted('ROLE_ADMIN')): ?>
            <div class="my-4">
                <label for="" class="lab30">ROLES</label>
                <ul class="ml30 p-0">
                    <?php foreach($roles as $role) : ?>
                    <li><input type="checkbox" name="roles[]" value="<?=$role['libelle']?>" <?=$role['checked']?>>
                        <?=$role['libelle']?> </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="div-btn">
            <a href="user" class="btn btn-md btn-success">Retour à la liste</a>
            <input type="reset" class="btn btn-md btn-danger" value="Annuler" <?=$disabled?>>
            <input type="submit" class="btn btn-md btn-primary" value="Valider" <?=$disabled?>>
        </div>
    </form>
</div>
<script>
    function choisir(){
        photo.click();
    }
</script>