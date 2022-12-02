<?php

$hotels = [

  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4
  ],
  [
    'name' => 'Hotel Futuro',
    'description' => 'Hotel Futuro Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 2
  ],
  [
    'name' => 'Hotel Rivamare',
    'description' => 'Hotel Rivamare Descrizione',
    'parking' => false,
    'vote' => 1,
    'distance_to_center' => 1
  ],
  [
    'name' => 'Hotel Bellavista',
    'description' => 'Hotel Bellavista Descrizione',
    'parking' => false,
    'vote' => 5,
    'distance_to_center' => 5.5
  ],
  [
    'name' => 'Hotel Milano',
    'description' => 'Hotel Milano Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 50
  ],

];

//di default l'elenco filtrato è l'elenco pieno
$filtered_hotels = $hotels;

if (!empty($_GET['parking'])) {
  $temp_hotels = [];
  foreach ($filtered_hotels as $hotel) {
    if ($hotel['parking']) $temp_hotels[] = $hotel;
  }
  $filtered_hotels = $temp_hotels;
}

//se ho scelto senza parcheggio verifico l'esistenza del parametro parking in GET e che sia vuoto
if (isset($_GET['parking']) && empty($_GET['parking'])) {
  $temp_hotels = [];
  foreach ($filtered_hotels as $hotel) {
    if (!$hotel['parking']) $temp_hotels[] = $hotel;
  }
  $filtered_hotels = $temp_hotels;
}

if (!empty($_GET['vote'])) {
  $temp_hotels = [];
  foreach ($filtered_hotels as $hotel) {
    if ($hotel['vote'] >= $_GET['vote']) $temp_hotels[] = $hotel;
  }
  $filtered_hotels = $temp_hotels;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <title>PHP Hotel</title>

</head>

<body>

  <div class="container py-4">

    <div class="row mb-2">
      <div class="col-12">

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="row">

          <div class="col-sm-3">
            <input class="form-check-input" type="radio" name="parking" id="parking1" value="">
            <label class="form-check-label" for="parking1">Senza parcheggio</label>

            <input class="form-check-input" type="radio" name="parking" id="parking2" value="1">
            <label class="form-check-label" for="parking2">Con parcheggio</label>
          </div>


          <div class="col-sm-3">
            <label for="inputVoto">Voto</label>
            <input type="number" name="vote" id="vote">
            <!-- <select class="form-select" aria-label="form-select example">
              <option selected></option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select> -->
          </div>

          <div class="col-auto">
            <button type="submit" class="btn btn-primary">Cerca</button>
            <button type="button" class="btn btn-secondary">Annulla</button>
          </div>

        </form>

      </div>
    </div>

    <table class="table table-warning table-striped">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Descrizione</th>
          <th scope="col">Pacheggio</th>
          <th scope="col">Stelle</th>
          <th scope="col">Distanza dal centro</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($filtered_hotels as $hotel) : ?>
          <tr>
            <td><?php echo $hotel['name'] ?></td>
            <td><?php echo $hotel['description'] ?></td>
            <td><?php echo $hotel['parking'] ? 'Si' : 'No' ?></td>
            <td><?php echo $hotel['vote'] ?></td>
            <td><?php echo $hotel['distance_to_center'] ?>km</td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>


</body>

</html>