<style>

    #tbody_art{
        display:block;
        width:100%;
        height:125px;
        overflow:auto;
    }
    #thead_art,#tbody_art tr,#tfoot_art{
        display:table;
        width:100%;
    }
    

</style>


<div class="w90 m-auto">
    <h1 class="titre center text-light">LISTE ARTICLE</h1>
    <table class="w100">
        <thead id="thead_art">
            <tr class="bg_green">
                <th class="w10 center">ID</th>
                <th class="w10 left">CODE</th>
                <th class="w50 left">DESIGNATION</th>
                <th class="w10 center">PU</th>
                <th class="w20 center">ACTION</th>
            </tr>

        </thead>
        <tbody id="tbody_art">

        </tbody>
        <tfoot id="tfoot_art">
                <tr class="bg_green">
                    <th colspan="5" id="nbre_art" class="center">Nombre article ...</th>
                </tr>
        </tfoot>
    </table>

</div>
<script>
    //----------declation des données
    let articles=<?=$articles?>;
    console.log(articles);

    //------lancement des fonctions
    afficher(articles);

    //-------------Creation de mes fonctions-----
    function afficher(articles){
        const nbre=articles.length;
        let html=articles.map(function(article){
             return `
                    <tr>
                        <td class="w10 text-center">${article.id}</td>
                        <td class="w10">${article.numArticle}</td>
                        <td class="w50">${article.designation}</td>
                        <td class="w10 text-end pe-2">${article.prixUnitaire}</td>
                        <td class="w20 d-flex justify-content-between">
                            <button class="btn btn-sm btn-success mx-2">Afficher</button>
                            <button class="btn btn-sm btn-danger ">Supprimer</button>
                            <button class="btn btn-sm btn-primary mx-2">Modifier</button>
                        </td>
                    </tr>
             `
        }).join('');
        console.log(html);
        tbody_art.innerHTML=html;
        nbre_art.innerHTML="Nombre d'articles : "+nbre;
        tbody_art.scrollTop=tbody_art.scrollHeight;

    }

</script>