<div class="m-auto w80">
    <h1 class="titre text-light">LISTE DES USERS</h1>
    <div class="div-btn my-2">
        <a href="user&action=insert"  class="btn btn-md btn-primary">Nouveau User</a>
        <a href="javascript:window.print()"  class="btn btn-md btn-primary">Imprimer</a>
    </div>
    <table class="w100 table-responsive">
        <thead id="thead_user">
            <tr class="bg_green">
                <td>ID</td>
                <td>USERNAME</td>
                <td>DATECREATION</td>
                <td>ROLES</td>
                <td>ACTIONS</td>
            </tr>
        </thead>
        <tbody id="tbody_user">
            <?php foreach($lignes as $ligne): ?>
                <tr>
                    <td><?=$ligne['id']?></td>
                    <td><?=$ligne['username']?></td>
                    <td><?=$ligne['dateCreation']?></td>
                    <td class="py-2"><?=$ligne['roles']?></td>
                    <td class="py-2 d-flex justify-content-between">
                        <a href="user&action=show&id=<?=$ligne['id']?>" class="btn btn-sm btn-success mx-2">Afficher</a>
                        <a href="user&action=update&id=<?=$ligne['id']?>" class="btn btn-sm btn-primary mx-2">Modifier</a>
                        <button class="btn btn-sm btn-danger mx-2" onclick="supprimer(<?=$ligne['id']?>)">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
        <tfoot id="tfoot_user">
            <tr class="bg_green">
                <th colspan="5" class="text-center">Nombre users : <?=$nbre?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    function chercher(){
        document.location.href="user&action=search&mot="+mot.value;
    }
    function touche(event){
        if(event.keyCode==13){
            chercher();
        }
    }
  function supprimer(id){
    const response=confirm("Voulez-vous bien supprimer ce user?");
    if(response){
        document.location.href="user&action=delete&id="+id;
    }
  }
</script>