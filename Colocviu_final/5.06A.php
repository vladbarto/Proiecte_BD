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
<title>05.06A</title>
</head>
<body>

<style>
    body{
        background: #0B0D13;
    }
    .form{
        background: #2B2F3F;
        margin-bottom: -13px;
        margin-top: 30px;
        margin-left: auto;
        margin-right: auto;
        width: 300px;
        height: 150px;
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
        margin-bottom: 15px;
    }
    .form-submit{
        background: royalblue;
        margin-left: 110px;
        margin-right: auto;
        width:75px;
        height: 40px;
        border-color: ;
        border-radius: 25px;
        font-color: #FFF;
    }
    .cartela{
        display: flex;
        border-radius: 15px;
        border-width: 5px;
        border: 1px solid orangered;
        background-color: olive;
        margin:20px;
        text-align: justify;
        font-size: medium;
        width: 250px;
        height:50px;
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
        <h4>Se va afișa fiecare localitate, având atașat numărul de pagini care trebuie difuzat în data curentă</h4>
        <input class="form-submit" type="submit" name="submit" id="submit" value="Caută">
    </div>
    </div>
</form>
<?php
// Definim variabilele
// si
// Facem query-ul catre DB-ul nostru

$sql = "SELECT l.Denumire, sum(f.nr_pagini)
FROM Localitate l LEFT OUTER JOIN Difuzare d ON (l.id_l = d.id_l) LEFT OUTER JOIN Factura f ON (f.id_f = d.id_f)
WHERE SYSDATE() BETWEEN d.datai AND d.datas
        GROUP BY l.Denumire;";
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT l.Denumire
FROM Localitate l LEFT OUTER JOIN Difuzare d ON (l.id_l = d.id_l) LEFT OUTER JOIN Factura f ON (f.id_f = d.id_f)
        GROUP BY l.Denumire;";
$result = mysqli_query($conn, $sql);
$localitati = mysqli_fetch_all($result, MYSQLI_ASSOC);

$alte_loc[]="";
foreach($localitati as $item){
    if(!in_array($item['Denumire'], $feedback[0]))
        array_push($alte_loc, $item['Denumire']);
}
?>
<ul class="afisare">
    <?php
    if(!empty($feedback) && isset($_POST['submit']))
        foreach ($feedback as $item):?>
            <li>
                <section class="cartela">
                    <ul style="list-style: none; padding-left:20px; padding-right: 20px">
                        <li>
                            <h4><span style="color:cyan"><?php echo $item['Denumire'].': '.$item['sum(f.nr_pagini)'].' difuzări'; ?></span></h4>
                        </li>
                    </ul>
                </section>
            </li>
        <?php endforeach;
    if(isset($_POST['submit']))
        foreach($alte_loc as $item)
        if($item != ""):?>
            <li>
                <section class="cartela">
                    <ul style="list-style: none; padding-left:20px; padding-right: 20px">
                        <li>
                            <h4><span style="color:cyan"><?php echo $item.':    0 difuzări'; ?></span></h4>
                        </li>
                    </ul>
                </section>
            </li>
        <?php endif;
    ?>
</ul>
<?php include 'inc/footer.php'?>
