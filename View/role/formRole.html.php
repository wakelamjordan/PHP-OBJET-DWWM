<div class="m-auto w40 my-4">
    <h1 class="titre text-light">SAISIE ROLE</h1>
    <form action="role&action=save" method='post' >

        <div class="my-2 hidden">
            <label for="id" class="lab30">ID</label>
            <input class="form-control w20" type="text" id='id' name="id" value="<?=$id?>" <?=$disabled?>>
        </div>
        <div class="my-2">
            <label for="rang" class="lab30 obligatoire">RANG</label>
            <input required class="form-control w30" type="text" id='rang' name="rang" value="<?=$rang?>"  <?=$disabled?>>
        </div>

        <div class="my-2">
            <label for="libelle" class="lab30">LIBELLE</label>
            <input class="form-control w70" type="text" id='libelle' name="libelle" value="<?=$libelle?>" <?=$disabled?>>
        </div>

        <div class="div-btn">
            <a href="role" class="btn btn-md btn-success">Retour à la liste</a>
            <input type="reset" class="btn btn-md btn-danger" value="Annuler" <?=$disabled?>>
            <input type="submit" class="btn btn-md btn-primary" value="Valider" <?=$disabled?>>
        </div>
    </form>
</div>
<script>

</script>