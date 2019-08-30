<?php
try
{
  // On se connecte à MySQL
  $bdd = new PDO('mysql:host=localhost;dbname=dbs149125;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
  // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin="" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script type="text/javascript" src="js/jeu.js"></script>
  <link rel="stylesheet" href="css/home.css">
  <title>Team GO!</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="start.php">CharleGo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
      aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="start.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="shop.html">Boutique</a>
        </li>
       
    </div>
  </nav>
  <main class="d-flex justify-content-center align-items-center">
    <section class="d-flex flex-column align-items-center">
      <div class="block d-flex flex-column align-items-center">
        <h1>Bienvenue !</h1>
        <h2>Pour commencer le jeu cliquez sur start !</h2>
        <br>
        <button type="button" class="btn btn-start mb-2" id="btnstart" data-toggle="modal"
          data-target="#exampleModal">Start</button>
    </section>
    </div>

    <div id='map'></div>

    <div class="modal" tabindex="-1" id="exampleModal" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content align-items-center">
          <div class="modal-header">
            <img class="avatar" src="http://www.histoireeurope.fr/ImgC/Charles%20Ier%20Gonzague.PNG" style="
    width: 80px;
    height: 80px;
  border-radius: 40px; /* половина ширины и высоты */
  margin: 10px;
">
          </div>
          <div class="modal-body">
            <h5 class="modal-title">Bien le bonjour jeunes gens !</h5>
            <p>Je suis Charles de Gonzague. Vous allez vivre une petite aventure avec vos ancêtres, les habitants de
              Charleville, MA ville ! Ils vous guideront à travers cette épopée !</p>
            <p>Pour commencer, je vous invite à vous rendre à la Place Ducale !</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Suivant</button>
          </div>
        </div>
      </div>
    </div>

    


    <div class="modal" tabindex="-1" id="exampleModal2" role="dialog">
    <?php
              $stmt = $bdd->prepare("SELECT * FROM Personne INNER JOIN posseder ON personne.Id = posseder.Id
              INNER JOIN Menage ON Menage.id = posseder.id_Menage
              WHERE posseder.date = '1759-07-01' AND LENGTH(rue) > 4  AND LENGTH(profession) > 4 
              ORDER BY rand() LIMIT 1
                        ");
              $stmt->execute();
 
                 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                 {
                   extract($row);
                     ?>
      <div class="modal-dialog modal-dialog-centered" role="document" id="example2">
        <div class="modal-content align-items-center">
          
          <div class="modal-body" >
            
            <div class="card text-white bg-danger mb-3" style="max-width: 30rem;">
            <div class="card-header">Un ancêtre apparaît !</div>
                <div class="card-body d-flex-wrap">
                    <?php
                    $citation_1 = "Bonjour ! Je suis ";
                    $citation_2 = "Salutations, comment vas-tu ? Moi c'est ";
                    $citation_3 = "Tu es arrivé au bon endroit, moi je me prénomme ";
                    $citation_4 = "Vous m'avez trouvé, on m'appelle ";
                    $citation_5 = "Bienvenue dans le temps, je me présente, je suis ";                              
                    echo ${'citation_' . rand(1, 5)};
                    ?>
                    <?php echo "<b>".$row['nom']." ".$row['prenom']."</b>"; ?>
                    <?php
                    $citation_1 = " et dans le temps j'étais ";
                    $citation_2 = " et j'étais ";
                    $citation_3 = ", mon métier étais ";
                    $citation_4 = ", mon activité principale il y a longtemps étais ";
                    $citation_5 = ", à l'époque mon métier c'étais ";                            
                    echo ${'citation_' . rand(1, 5)};
                    ?>
                    <?php echo $row['profession']; ?>
                    <?php
                    $citation_1 = ", j'habitais ";
                    $citation_2 = " et j'ai habité ";
                    $citation_3 = " et je vivais ";
                    $citation_4 = " et ma maison se situait ";
                    $citation_5 = ", Charleville est génial, moi je demeurais ";                             
                    echo ${'citation_' . rand(1, 5)};
                    ?>
                    <?php echo $row['rue']; ?>
                    <?php
                    $citation_5 = ", je vous conseille d'aller voir Place Ducale c'est un endroit pittoresque !!";
                    $citation_1 = ", à l'époque le Musée Arthur Rimbaud était très charmant, allez voir pour moi si c'est toujours le cas.";
                    $citation_2 = ". Promenez vous au Mont Olympe à présent, c'est jolie et apaisant vous le constaterez!";
                    $citation_3 = " et vous devrez vous rendre à la statue du créateur car c'est le patrimoine de cette ville haha!";
                    $citation_4 = ". Si vous voulez visiter ici, allez vers la Basilique l'ami."; 
                    
                    $index = $_POST['index'] + 1;
                    echo ${'citation_' . $index};
                    ?>
                </div>
               
        </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Let's Go !!</button>
           
          </div>
        </div>
      </div>
    </div>




    <?php
      
    }
    ?>
  </main>

                <!-- Footer -->
  <footer class="page-footer font-small blue pt-4">

<!-- Footer Links -->
<div class="container-fluid text-center text-md-left">

  <!-- Grid row -->
  <div class="d-flex flex-column">

    <!-- Grid column -->
    <div class="d-flex flex-column align-items-center">

      <!-- Content -->
      <h5 class="text-uppercase">Team GO</h5>
      <p>Petit jeu sympa sur Charleville.</p>  
    </div>
    <!-- Grid column -->
    <div class="d-flex justify-content-between">
              <img src="img/hck.png" alt="" style="width: 10%" class="ml-2" id="imglogo">
              <p class="mt-4">© 2019 Copyright: momo,axel,gianni</p>
              <img src="img/hackk.svg" alt="" style="width: 10%" class="ml-2">
              </div>
    <hr class="clearfix w-100 d-md-none pb-3">

    <!-- Grid column -->
    <div class="col-md-3 mb-md-0 mb-3">

  </div>
<!-- Footer Links -->

<!-- Copyright -->

<!-- Copyright -->

</footer>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
  <script src="./js/index.js"></script>
  <script src="./js/cal.js"></script>

</body>

</html>