
<?php
//fichier des fonctions pour pouvoir les appeler ici
include 'functions.php';


session_start();

// initialiser le panier 
createCart();

//fichier head avec les balises de bases + le head pour ne pas répéter dans chaque page
include 'head.php';
?>


<body>
  <?php 
  include 'header.php';
  ?>

  <main>
    <div class="row text-center">
    <h1> Panier </h1>
    </div>
    <div class="container-fluid">
    
     <?php
     // je vérifie s'il y a un ajout au panier
    if (isset ($_GET['productId'])){
        
     // je récupère l'id transmis par le formulaire dans une variable
     $productId = $_GET['productId'];

     // je récupère l'article qui correspond à l'id
    
     $article = getArticleFromId($productId);
     //var_dump($article);

     //j'ajoute l'article dans mon panier avec la fonction addToCart($article)
     addToCart($article);

     // var_dump($_SESSION);
    }
    // tester s'il y a des changements dans le panier ****************************
    if (isset ($_GET['quantite'])){
      modifQuantite($_GET['quantite'],$_GET['productId']);

    }



    // j'affiche les articles du panier *****************************************************************
    
      foreach ($_SESSION['panier'] as $article){
        echo "<div class=\"row  text-bg-light p-3 \">
        <div class=\"col-md-2\">
        <img src=\"./images/". $article['picture']."\" class=\"card-img-top x-center\" alt=\"robe-panier\">
        </div>
        <div class=\"card-body col-md-2 text-center d-flex align-items-center \">
        <h5 class=\"card-title\">". $article['name']. "</h5>
        </div>
        <div class=\"col-md-2 text-center d-flex align-items-center \">
        <p class=\"quantite\">
        ". $article['quantite']."
        </div>

        <div class=\"col-md-2 text-center d-flex align-items-center\">
        <form method=\"GET\" action=\"./panier.php\">
        <input type=\"hidden\" name=\"productId\" value=\"".$article['id']."\">       
        <input type=\"number\" min=\"1\" max=\"100\" name=\"quantite\" class=\"btn\" value=\"".$article['quantite']."\">
        <input type=\"submit\" class=\"btn btn-success\" value=\"Modifier \">
        </form>
        </div>

        <div class=\"col-md-2 text-center d-flex align-items-center\">
        <p class=\"card-text\">". $article['price']."€</p>
        </div>";
      }
      
      // j'affiche le total du panier ********************************************************
      echo "<div class=\"row  text-bg-light p-3 \">
      <div class=\"col-md-6 d-flex justify-content-end\">
      <p> Total du panier </p>
      </div> 
      <div class=\"col-md-6 d-flex justify-content-end\">
      <p>".totalArticles(). "€</p>
      </div>";

      // je test le changement de quantite****************************************************
        

      
      ?>

      


  </div>
  </main>


  <?php
  include 'footer.php';
  ?>






  