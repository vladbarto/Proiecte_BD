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
<title>05.04A</title>
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
        border-style: solid;
        border-width: 5px;
        border: 1px solid black;
        background-color: #E6954F;
        margin:20px;
        border-color: orangered;
        text-align: justify;
        font-size: medium;
        width: 250px;
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
        <h4>Introduceți prima localitate</h4>
        <div class="form-input">
            <input type="text" name="loc1" id="loc1">
        </div>
        <h4>Introduceți a doua localitate</h4>
        <div class="form-input">
            <input type="text" name="loc2" id="loc2">
        </div>
        <input class="form-submit" type="submit" id="submit" value="Caută">
    </div>
    </div>
</form>
<h4>Important: ambele câmpuri trebuie să fie completate pentru a putea obține efectul dorit</h4>
<?php
// Definim variabilele
$feedback = NULL;
if(!empty($_POST['loc1']) && !empty($_POST['loc2']))
{
    $localitate1 = $_POST['loc1'];
    $localitate2 = $_POST['loc2'];
    if(!$localitate1):
        ?><h4>Eroare: ați introdus o valoare maximă mai mică sau egală față de cea minimă</h4>
    <?php endif;

    // Facem query-ul catre DB-ul nostru
    $sql = "CALL p_perechiLoc('".$localitate1."','".$localitate2."');";
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
                            <h3>Nume client: <span style="color:cyan"><?php echo $item['nume']?></span></h3>
                        </li>
                        <li>
                            <p>Adresă client: <span style="color:darkblue"><?php echo $item['adresa']?></span></p>
                        </li>
                        <li>
                            <p>id_factură: <span style="color:darkblue"><?php echo $item['id_f']?></span></p>
                        </li>
                        <li>
                            <p>Oraș difuzare: <span style="color:darkblue"><?php echo $item['denumire']?></span></p>
                        </li>
                    </ul>
                </section>
            </li>
        <?php endforeach;?>
</ul>
<?php include 'inc/footer.php'?>
