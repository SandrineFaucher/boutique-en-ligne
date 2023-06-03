<?php
//****************************************renvoyer un tableau d'articles *********************/
function getArticles()
{
    return [
        //***************article 1***************************** */
        [
            'name' => 'Robe longue',
            'id' => '1',
            'price' => 129.99,
            'description' => 'L\'élégance',
            'detailedDescription' => 'Robe longue aux jolies couleurs estivales, elle égaiera vos plus belles soirées',
            'picture' => 'robe1.jpg'
        ],
        //**************article 2***************************** */
        [
            'name' => 'Robe à fleurs',
            'id' => '2',
            'price' => 109.99,
            'description' => 'Un air estival',
            'detailedDescription' => 'Robe sans manches, fluide, elle vous accompagnera en toute circonstance tout l\'été',
            'picture' => 'robe2.jpg'
        ],
        //**************article 3***************************** */
        [
            'name' => 'Robe blanche',
            'id' => '3',
            'price' => 159.99,
            'description' => 'Robe de soirée',
            'detailedDescription' => 'Robe longue aux jolies couleurs estivales, elle égaiera vos plus belles soirées',
            'picture' => 'robe3.jpg'
        ]
    ];
}
//******************récupérer le produit qui correspond à l'id fourni en paramètre ************/

function getArticleFromId($id)
{
    //récupérer la liste des articles 
    $articles = getArticles();

    // aller chercher dedans l'article qui comporte l'id en paramètre
    foreach ($articles as $article) {
        if ($article['id'] == $id) {
            // le renvoyer avec un return
            return $article;
        }
    }
}

//*************************Initialiser le pannier en début de page********************/
function createCart()
{
    if (isset($_SESSION['panier']) == false) { //si mon panier n'existe pas encore
        $_SESSION['panier'] = [];           // je l'initialise
    }
}
//****************************Ajouter au panier *************************************/
function addToCart($article)
{
    // j'attribue une quantite de 1 (par défaut) à l'article
    $article['quantite'] = 1;

    // je vérifie si l'article n'est pas déjà présent en comparant les id
    // for (
    //$i = index de la boucle
    //$i < count ($_SESSION['panier]) = condition de maintien de la boucle (évaluée AVANT chaque tour)
    // (si condition vraie => on lance la boucle)
    // $i++ = évolution de index $i à la FIN de chaque boucle
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {

        // si présent => quantite + 1
        if ($_SESSION['panier'][$i]['id'] == $article['id']) {
            $_SESSION['panier'][$i]['quantite']++;
            return; //permet de sortir de la fonction
        }
    }

    // si pas présent => ajout classique via array_push
    array_push($_SESSION['panier'], $article);
}


//******************************calcul du total du panier*********************************** */


function totalArticles()
{
    $total = 0;

    foreach ($_SESSION['panier'] as $article) {
        $total += $article['quantite'] * $article['price'];
    }
    return $total;
}

//******************************modification article***************************************** */

function modifQuantite($nouvelleQuantite, $id)
{
    //je boucle sur le panier => je cherche l'article à modifier
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {

        // dès que je trouve mon article 
        if ($_SESSION['panier'][$i]['id'] == $id) {

            // je remplace son ancienne quantite par la nouvelle
            $_SESSION['panier'][$i]['quantite'] = $nouvelleQuantite;

            // j'affiche un message de succès dans une petite fenetre via Javascript
            echo "<script> alert(\"Quantité modifiée !\");</script>";

            // je sors de la fonction pour éviter de boucler sur les articles suivants
            return;
        }
    }
}

// je supprime les éléments *******************************************************************
function delateArticle($id)
{
    // je boucle sur le panier => je cherche l'article à supprimer
    for ($i = 0; $i < count($_SESSION['panier']); $i++)

        // dès que je trouve mon article 
        if ($_SESSION['panier'][$i]['id'] == $id) {

            // je supprime un élément du panier 
            array_splice($_SESSION['panier'], $i, 1);
        }
}

// je vide le panier complet *******************************************************************
function viderPanier(){
    $_SESSION['panier'] = [];

}

// je crée une fonction qui calcule les frais de port*****************************************************************
// je boucle sur mon panier
function fraisDePort($article){
    $fraisParArticle = 3;
    $total = 0;
    
    foreach ($_SESSION['panier'] as $article) {
        $total += $article['quantite'] * $fraisParArticle;
    }
    return $total;
}


        

                

        
