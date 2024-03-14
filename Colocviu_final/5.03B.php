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
<title>05.03B</title>
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
        height: 143px;
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
        margin-bottom: 27px;
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
        background-color:olivedrab;
        margin:20px;
        border-color: bisque;
        text-align: justify;
        font-size: medium;
        width: 250px;
        height:120px;
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
        <h4>Căutați o localitate</h4>
        <div class="form-input">
            <input type="text" min="0" name="loc" id="loc""><br>
        </div>
        <input class="form-submit" type="submit" id="submit" value="Caută">
        </div>
    </div>
</form>
<?php
$is_set = false;
// Definim variabilele
$feedback = NULL;
if(!empty($_POST['loc']))
{
    $localitate = $_POST['loc'];
    if(!$localitate):
        ?><h4>Eroare: ați introdus o valoare maximă mai mică sau egală față de cea minimă</h4>
    <?php endif;

    $is_set = true;
    // Facem query-ul catre DB-ul nostru
    $sql = "SELECT denumire, id_l
        FROM Localitate
        WHERE denumire like '%".$localitate."%'
        ORDER BY denumire ASC;";
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
                            <h3>Oraș: <span style="color:deepskyblue"><?php echo $item['denumire']?></span></h3>
                        </li>
                        <li>
                            <h3>id_l: <span style="color:darkblue"><?php echo $item['id_l']?></span></h3>
                        </li>
                    </ul>
                </section>
            </li>
        <?php endforeach;?>
</ul>
<?php include 'inc/footer.php'?>
