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
<title>05.06B</title>
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
        height: 160px;
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
    h3{
        font-family: Bahnschrift;
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
        background-color:limegreen;
        margin:20px;
        border-color: bisque;
        text-align: justify;
        font-size: medium;
        width: 386px;
        height:120px;
    }
    .cartela-ups{
        display: flex;
        border-radius: 15px;
        border-style: solid;
        border-width: 5px;
        border: 1px solid black;
        background-color:orange;
        margin:20px;
        border-color: bisque;
        text-align: justify;
        font-size: medium;
        width: 386px;
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
        <h4>Pentru ce an doriți să faceți bilanțul facturilor?</h4>
        <div class="form-input">
            <input type="number" min="1950" max="2050" name="year" id="year" placeholder="YYYY"><br>
        </div>
        <input class="form-submit" type="submit" id="submit" value="Bilanț">
    </div>
</form>
<?php
// Definim variabilele
$feedback = NULL;
if(!empty($_POST['year']))
{
    $an = $_POST['year'];
    // Facem query-ul catre DB-ul nostru
    $sql = "SELECT MIN(valoare_totala) AS Minim, MAX(valoare_totala) AS Maxim, TRUNCATE(AVG(valoare_totala), 3) AS Medie
FROM Factura
WHERE DATE_FORMAT(data, '%Y') = '".$an."'";
    $result = mysqli_query($conn, $sql);
    $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if(!empty($_POST['year'])): ?>
<h4>Pentru anul <span style="color:blueviolet"><?php echo $an?></span> avem așa:</h4>
<?php endif;?>
<ul class="afisare">
    <?php
    if($feedback!=NULL)
    foreach ($feedback as $item)
        if($item['Minim'] != NULL):?>
            <li>
                <section class="cartela">
                    <ul style="list-style: none; padding-left:20px; padding-right: 20px">
                        <li>
                            <h3>Valoarea minimă de pe toate facturile: <span style="color:darkblue"><?php
                                     echo $item['Minim'];?></span> lei</h3>
                        </li>
                    </ul>
                </section>
            </li>
            <li>
                <section class="cartela">
                    <ul style="list-style: none; padding-left:20px; padding-right: 20px">
                        <li>
                            <h3>Valoarea maximă de pe toate facturile: <span style="color:darkblue"><?php echo $item['Maxim']?></span> lei</h3>
                        </li>
                    </ul>
                </section>
            </li>
            <li>
                <section class="cartela">
                    <ul style="list-style: none; padding-left:20px; padding-right: 20px">
                        <li>
                            <h3>Valoarea medie de pe toate facturile: <span style="color:darkblue"><?php echo $item['Medie']?></span> lei</h3>
                        </li>
                    </ul>
                </section>
            </li>
        <?php else:?>
        <li>
            <section class="cartela-ups">
                <ul style="list-style: none; padding-left:20px; padding-right: 20px">
                    <li>
                        <h3>Hopa! Nu există facturi înregistrate în anul  <span style="color:darkblue"><?php echo $an?></span> !!!</h3>
                    </li>
                </ul>
            </section>
        </li>
    <?php endif;?>
</ul>
<?php include 'inc/footer.php'?>
