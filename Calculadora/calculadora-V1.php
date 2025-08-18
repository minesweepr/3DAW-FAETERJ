<!DOCTYPE html>
<html>
    <head>
        <title>Calculadora</title>
    </head>
    <body>
        <h1>Calculadora em PHP</h1>
        <form action="calculadora-V1.php" method="post">
            <label for="A">Digite a soma aqui: <input type="text" name="A"></label>
            <select name="op">
                <option value="ad">+</option>
                <option value="sub">-</option>
                <option value="mul">x</option>
                <option value="dv">%</option>
            </select>
            <input type="text" name="B">
            <button type="submit" value="Submit">ENVIAR</button>
        </form>
    <?php
    $n1=isset($_POST["A"])?$_POST["A"]:0;
    $n2=isset($_POST["B"])?$_POST["B"]:0;
    $op=isset($_POST["op"])?$_POST["op"]:" ";
    echo "Resposta: " ;
            
    switch($op){
        case 'ad': echo $n1+$n2; break;

        case 'sub': echo $n1-$n2; break;

        case 'mul': echo $n1*$n2; break;

        case 'dv': echo $n1/$n2; break;
    }

    echo "<br><br>O metodo é ";
    if($_SERVER['REQUEST_METHOD']=='POST') echo "POST";
    else echo "GET";

    ?>
    </body>
</html>