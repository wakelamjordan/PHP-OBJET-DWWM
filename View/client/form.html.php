<div class="m-auto w80 my-4">
    <h1 class="titre text-light">SAISIE CLIENT</h1>
    <form action="client&action=save" method='post'>
        <div class="my-2 hidden">
            <label for="id" class="lab30">ID</label>
            <input class="form-control w20" type="text" id='id'  name="id" value="<?=$id?>"  <?=$disabled?>  >
        </div>
        <div class="my-2">
            <label for="numClient" class="lab30">CODE</label>
            <input class="form-control w20" type="text" id='numClient'  name="numClient" value="<?=$numClient?>"  <?=$disabled?>  >
        </div>
        <div class="my-2">
            <label for="nomClient" class="lab30">NOM</label>
            <input class="form-control w70" type="text" id='nomClient'  name="nomClient" value="<?=$nomClient?>"  <?=$disabled?>  >
        </div>
        <div class="my-2">
            <label for="adresseClient" class="lab30">ADRESSE</label>
            <input class="form-control w70" type="text" id='adresseClient'  name="adresseClient" value="<?=$adresseClient?>"  <?=$disabled?>  >
        </div>
        <div class="div-btn">
            <input type="reset"  class="btn btn-md btn-danger" value="Annuler"   <?=$disabled?> >
            <input type="submit"  class="btn btn-md btn-primary" value="Valider" <?=$disabled?> >
        </div>
    </form>
</div>