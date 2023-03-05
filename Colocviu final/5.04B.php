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
<title>05.04B</title>
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
        background-color: #E6954F;
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
        <h4>Afișează perechi de localități a căror difuzare să apară pe aceeași factură și să se suprapună perioadele de difuzare</h4>
        <input class="form-submit" type="submit" name="submit" id="submit" value="Caută">
    </div>
    </div>
</form>
<?php
    // Definim variabilele
    // si
    // Facem query-ul catre DB-ul nostru
    $sql = "SELECT d.id_l, l.denumire 
FROM Difuzare d JOIN Difuzare e ON (d.id_f = e.id_f) JOIN Factura f ON (d.id_f = f.id_f) JOIN Localitate l ON (d.id_l = l.id_l) 
WHERE d.id_l != e.id_l AND d.id_l < e.id_l AND ((d.datai BETWEEN e.datai AND e.datas) OR (e.datai BETWEEN d.datai AND d.datas) OR 
(d.datas BETWEEN e.datai AND e.datas) OR (e.datas BETWEEN d.datai AND d.datas));";
    $result = mysqli_query($conn, $sql);
    $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql2 = "SELECT e.id_l, l.denumire 
    FROM Difuzare d JOIN Difuzare e ON (d.id_f = e.id_f) JOIN Factura f ON (d.id_f = f.id_f) JOIN Localitate l ON (e.id_l = l.id_l) 
    WHERE d.id_l != e.id_l AND d.id_l < e.id_l AND ((d.datai BETWEEN e.datai AND e.datas) OR (e.datai BETWEEN d.datai AND d.datas) OR 
    (d.datas BETWEEN e.datai AND e.datas) OR (e.datas BETWEEN d.datai AND d.datas));";
    $result2 = mysqli_query($conn, $sql2);
    $feedback2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

//}
?>
<ul class="afisare">
    <?php
    $position = 0;
    if(!empty($feedback) && isset($_POST['submit']))
        foreach ($feedback as $item):?>
            <li>
                <section class="cartela">
                    <ul style="list-style: none; padding-left:20px; padding-right: 20px">
                        <li>
                            <h3>(<span style="color:cyan"><?php echo $item['denumire'].', '.$feedback2[$position]['denumire'];
                            $position++;?></span>)</h3>
                        </li>
                    </ul>
                </section>
            </li>
        <?php endforeach;?>
</ul>
<?php include 'inc/footer.php'?>
