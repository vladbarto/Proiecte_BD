<?php // Conectarea la server
define('DB_HOST', 'localhost', false);
define('DB_USER', 'barto', false);
define('DB_PASS', 'student123', false);
define('DB_NAME', 'colocviu_bartolomei', false);// Numele bazei de date

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if($conn->connect_error){
    die('Connection failed '.$conn->connect_error);
};
//include 'inc/database.php';
include 'inc/header.php';?>
    <title>05.03A</title>
</head>
<body>

<style>
    body{
        background: #0B0D13;
    }
    .form{
        background: #2B2F3F;
        margin-top: 30px;
        margin-left: auto;
        margin-right: auto;
        width: 300px;
        height: 220px;
        border: solid;
        border-color: orangered;
        border-radius: 25px;
        padding: 20px;

    }
    h4,h5{
        color:salmon;
        background: transparent;
        font-family: Bahnschrift;
        text-align: center;
    }
    input{
        background: transparent;
    }
    .form-input{
        width: 50%;
        color:salmon;
        background: antiquewhite;
        margin-left: auto;
        margin-right: auto;
    }
    .form-submit{
        background: royalblue;
        width:75px;
        height: 40px;
        margin-left: 110px;
        margin-right: auto;
        margin-top: 20px;
        border-color: ;
        border-radius: 25px;
        font-color: #FFF;
    }
    .cartela{
        display: flex;
        border-radius: 15px;
        border-style: solid;
        border-width: 5px;
        border: 1px solid black;
        background-color:olivedrab;
        margin:20px;
        border-color: bisque;
        text-align: justify;
        font-size: medium;
        width: 386px;
        height:210px;
    }
    .afisare{
        display: flex;
        list-style: none;
        flex-wrap: wrap;
    }
    .inapoi{
        background: lightcoral;
        width:75px;
        height: 40px;
        border-color: ;
        border-radius: 25px;
        font-color: bisque;
    }
</style>
<form method="POST">
    <div class="form">
        <h4>Introduceți valoarea minimă a facturii</h4>
        <div class="form-input">
            <input type="number" min="0" name="min" id="min""><br>
        </div>
        <h4>Introduceți valoarea maximă a facturii</h4>
        <div class="form-input">
            <input type="number" min="0" name="max" id="max"><br>
        </div>
            <input class="form-submit" type="submit" id="submit" value="Caută">
    </div>
</form>
<?php
    $is_set = false;
    // Definim variabilele
    $feedback = NULL;
    if(!empty($_POST['min']) && !empty($_POST['max']))
    {
        $minim = $_POST['min'];
        $maxim = $_POST['max'];
        if($minim >= $maxim):
            ?><h4>Eroare: ați introdus o valoare maximă mai mică sau egală față de cea minimă</h4>
        <?php endif;

        $is_set = true;
        // Facem query-ul catre DB-ul nostru
        $sql = 'SELECT *
        FROM Factura
        WHERE valoare >=' . $minim . ' AND valoare <= ' . $maxim . '
        ORDER BY data DESC, valoare ASC;';
        $result = mysqli_query($conn, $sql);
        $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
    ?>
    <ul class="afisare">
    <?php
    if(!empty($feedback))
         foreach ($feedback as $item):?>
    <li>
        <section class="cartela">
        <ul style="list-style: none; padding-left:20px; padding-right: 20px">
            <li>
                <h3>id_f: <span style="color:red"><?php echo $item['id_f']?></span></h3>
            </li>
            <li>
                <div>data: <span style="color:darkblue"><?php echo $item['data']?></span></div>
            </li>
            <li>
                <div>număr pagini: <span style="color: darkblue"><?php echo $item['nr_pagini']?></span></div>
            </li>
            <li>
                <div>cost: <span style="color: darkblue"><?php echo $item['cost_pagina']?></span> lei/pagină</div>
            </li>
            <li>
                <div>număr zile de difuzare: <span style="color: darkblue"><?php echo $item['nr_zile']?></span></div>
            </li>
            <li>
                <div>valoare (fără TVA) pe factură: <span style="color: darkblue"><?php echo $item['valoare']?></span> lei</div>
            </li>
            <li>
                <div>TVA (19%) pe factură: <span style="color: darkblue"><?php echo $item['tva']?></span> lei</div>
            </li>
            <li>
                <div>valoare (cu TVA) pe factură: <span style="color: darkblue"><?php echo $item['valoare_totala']?></span> lei</div>
            </li>
            <li>
                <div>id_c (id-ul clientului): <span style="color: yellow"><?php echo $item['id_c']?></span></div>
            </li>
        </ul>
        </section>
    </li>
    <?php endforeach;?>
    </ul>
<?php include 'inc/footer.php'?>
