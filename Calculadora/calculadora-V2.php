<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>calculadora</title>

        <link rel="stylesheet" href="style.css">
        <?php
        $resposta="";
        if(isset($_POST['resposta'])){
            $resposta=$_POST['resposta'];
        }

        if(isset($_POST["btn"])){
            $val=$_POST["btn"];
            if($val=="C"){
                $resposta="";
            } else{
                $resposta.=$val;
            }
        }
        
        if(isset($_POST["calcular"])){
            $resposta=eval("return $resposta;");
        }
        ?>
        
    </head>
<body>
    <section>
        <h1>Calculadora em PHP</h1>
        <form action="calculadora-V2.php" method="post" class="calculadora">
            <table>
                <tr>
                    <td colspan="4">
                        <input class="resposta" type="text" name="resposta" value="<?php echo $resposta; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td><input class="btn" type="submit" value="1" name="btn"></td>
                    <td><input class="btn" type="submit" value="2" name="btn"></td>
                    <td><input class="btn" type="submit" value="3" name="btn"></td>
                    <td><input class="btn" type="submit" value="+" name="btn"></td>
                </tr>
                <tr>
                    <td><input class="btn" type="submit" value="4" name="btn"></td>
                    <td><input class="btn" type="submit" value="5" name="btn"></td>
                    <td><input class="btn" type="submit" value="6" name="btn"></td>
                    <td><input class="btn" type="submit" value="-" name="btn"></td>
                </tr>
                <tr>
                    <td><input class="btn" type="submit" value="7" name="btn"></td>
                    <td><input class="btn" type="submit" value="8" name="btn"></td>
                    <td><input class="btn" type="submit" value="9" name="btn"></td>
                    <td><input class="btn" type="submit" value="*" name="btn"></td>
                </tr>
                <tr>
                    <td><input class="btn red" type="submit" value="C" name="btn"></td>
                    <td><input class="btn" type="submit" value="0" name="btn"></td>
                    <td><input class="btn" type="submit" value="." name="btn"></td>
                    <td><input class="btn" type="submit" value="/" name="btn"></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input class="btn equal-button orange" type="submit" value="calcular" name="calcular">
                    </td>
                </tr>
            </table>
        </form>
    </section>
</body>
</html>