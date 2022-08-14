<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        Legg inn timer <input type="decimal" name="timer">
        <input type="submit" name="submit" value="Legg inn">
    </form>

    <?php
    if (isset($_POST["submit"]))
    {
        $timer = $_POST["timer"];

        include("db-tilkobling.php");

        $sqlSetning = "INSERT INTO jobbtimer (timer, tid) VALUES ($timer, NOW())";
        mysqli_query($db, $sqlSetning) or die("<article>Ikke mulig å registrere data i databasen</article>");
    }

    function visTimer()
    {
        include("db-tilkobling.php");

        $sqlSetning = "SELECT * FROM jobbtimer ORDER BY timer;";
        $sqlResultat = mysqli_query($db, $sqlSetning);
        $antallRader = mysqli_num_rows($sqlResultat);
        $timer = 0;

        for ($i = 0; $i < $antallRader; $i++)
        {
            $rad = mysqli_fetch_array($sqlResultat);
            $timer += $rad["timer"];
        }
        print($timer);
    }
    ?>

    <div>
        Totalt har du jobbet <?php visTimer() ?> timer
    </div>
</body>

</html>