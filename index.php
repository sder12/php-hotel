<!-- Prima stampate in pagina i dati, senza preoccuparvi dello stile.
Dopo aggiungete Bootstrap e mostrate le informazioni con una tabella.
Bonus:
1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)
NOTA: deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore)
Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel. -->

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
//var_dump($hotels);


//GET VARIABLES
$parking = $_GET['parkspot'] ?? "";
$vote = $_GET['vote'] ?? "";
//var_dump($parking);
//var_dump($vote);


$hotel_park = [];
$hotel_vote = [];

if ($parking === "yes") {
    for ($i = 0; $i < count($hotels); $i++) {
        $hotel = $hotels[$i];
        if ($hotel['parking'] === true) {
            // var_dump($hotel['name']);
            array_push($hotel_park, $hotel);
        }
    }
    //var_dump($hotel_park);
    $hotels = $hotel_park;
}


if ($vote) {
    for ($i = 0; $i < count($hotels); $i++) {
        $hotel = $hotels[$i];
        if ($hotel['vote'] >= $vote) {
            // var_dump($hotel['name']);
            array_push($hotel_vote, $hotel);
        }
    }
    //var_dump($hotel_park);
    $hotels = $hotel_vote;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <header>
            <h1>Hotel</h1>
        </header>

        <main>
            <!-- Print with no style -->
            <!-- <section>
                <?php
                // for ($i = 0; $i < count($hotels); $i++) {
                //     $hotel = $hotels[$i];
                //     echo "<hr>";
                //     foreach ($hotel as $key => $item) {
                //         echo $key;
                //         echo " = ";
                //         echo $item;
                //         echo "<br/>";
                //     }
                // }
                ?>
            </section> -->


            <section>
                <form action="index.php" method="GET">
                    <label for="parkspot">Do you need a parking spot?</label>
                    <input type="text" id="parkspot" name="parkspot" placeholder="yes or no (show all)">
                    <label for="vote">Filter by vote</label>
                    <input type="text" id="vote" name="vote" placeholder="from 1 to 5">

                    <button type="submit" class="btn btn-dark"> Filter </button>
                </form>
            </section>

            <!-- Print with table style-->
            <section>
                <table class="table">
                    <!-- Title key -->
                    <thead>
                        <tr>
                            <th scope="col"> n° </th>
                            <!-- For each index 0 to print the letteral key -->
                            <?php
                            foreach ($hotels[0] as $key => $item) {
                                echo '<th scope="col">' . $key . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <!-- List Hotel -->
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($hotels); $i++) {
                            $hotel = $hotels[$i];
                            echo "<tr>";
                            echo '<td scope="row">' . $i + 1 . ' </td>';
                            foreach ($hotel as $item) {
                                if ($item) {
                                    echo "<td>" . $item . "</td>";
                                } else {
                                    echo "<td> X </td>";
                                }
                            }
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </section>



        </main>


    </div>
</body>

</html>