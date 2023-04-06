<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Урок 8.3. Работа с XML. Запишем данные из XML в базу</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header></header>
    <div class="code_php"></div>
    <main>
        <section class=""></section>
        <section class="">
            <div class="">
                <?php
                function insert($name, $desc, $year, $category_id, $rating, $poster)
                {
                    $mysqli = new mysqli('localhost', 'root', '', 'study7.2lesson');
                    if (mysqli_connect_errno()) {
                        printf('Соединение не установлено', mysqli_connect_error());
                        exit();
                    }
                    $mysqli->set_charset('utf8');

                    $query = "INSERT INTO movie_list VALUES(null, '$name', '$desc', '$year',  Now(), '$category_id', '$rating', '$poster')";

                    $result = false;

                    if ($mysqli->query($query)) {
                        $result = true;
                    }
                    return $result;
                }
                ?>
            </div>
        </section>
        <section class=""></section>
    </main>
    <footer></footer>
</body>

</html>