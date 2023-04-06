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
    <header>
        <h1>
            Урок 8.3. Работа с XML. Запишем данные из XML в базу
        </h1>
    </header>
    <div class="title_code_php">
        <?php
        $nickname = 'Александр!';
        $hello = 'Привет ';
        $offer = 'На занятии мы научимся и запишем данные из XML файла в базу MySQL с помощью скрипта на языке PHP';
        echo "<h2 class='title_php_code'>" . $hello . $nickname . "<br>" . "<br>" . $offer . "</h2>";
        ?>
    </div>
    <main>
        <section class="begin">
            <div class="begin1">
                <p>
                    На данном занятии как уже указано выше мы применим написанный на предыдущем занятии код php и разберемся как загрузить/выгрузить в нашу таблицу в БД нужнную нам информацию из xml файла.
                </p>
            </div>
            <div class="begin2">
                <p>
                    Обратимся к нашему xml файлу и вновь посмотрим содержащуюся в нем информацию.<br>
                    Для этого снова используем наш код и выведим данные из xml файла.<br>
                    Давайте снова напишем наш код, для этого создадим переменную xml и подключим xml файл(movies.xml) с помощью функции simplexml_load_file() и затем выведим в браузер данные из этого файла.
                </p>
                <p class="code_php_p">
                    У нас должен получиться следующий код:<br><br>
                    <span class="code_php_str">
                        $xml=simplexml_load_file("xml/movies.xml") or die("Error: Cannot create object");<br>
                        echo "'<'pre>"<br>
                            print_r($xml);<br>
                            echo "'<' /pre>"
                    </span>
                </p>
                <p>
                    Здесь в виду того, что наш файл xml достаточно большой, мы не будем выводить его в браузер повторно, чтобы посмотреть, ту информацию о которой пойдет речь ниже, но если вам нужно проверить и повторить материал, то запускаем этот код и смотрим в браузер.
                </p>
                <p>
                    Когда в браузер выгрузиться информация из xml файла(movies.xml) то мы увидим, что каждый фильм имеет три варианта постеров - маленький, средний и большой.<br>
                    Нам для нашей таблицы понадобиться большой постер(big).
                </p>
                <p>
                    Также мы видим, что на все постеры(маленький(small), средний(medium), большой(big)) в файле указывают ссылки на другой сайт, и по своей сути это тоже является массивом.<br>
                    Поэтому, чтобы выгрузит постер в нашу таблицу, нам нужно будет использовать цикл FOREFCH, более подробно об этом позже.
                </p>
                <p>
                    В нашу таблицу мы также добавили столбец - Рейтинг(rating), данные для этого столбца мы будем брать с сайта imb и тоже для этого будем использовть цикл FOREACH, но у нас будет цикл в цикле.
                </p>
            </div>
        </section>
        <section class="part_1">
            <div class="part_1_b">
                <p>
                    И так нам нода написать цикл для выгрузки постера в нашу таблицу movie_list.<br>
                    Для этого мы снова подключаемся к нашему xml файлу и затем пишем цикл FOREACH, где в скобках указываем путь к большому постеру и потом просит вывести его в браузер.<br>
                    Причем данный цикл мы будем писать уже в нашем ранее написаном цикле FOREACH, в котором выводили названия фильмов на русском языке.
                </p>
                <p class="code_php_p">
                    То есть наш код будет следующим:<br><br>
                    <span class="code_php_str">
                        $xml=simplexml_load_file("xml/movies.xml") or die ("Error: Cannot create object");<br>
                        foreach($xml as $movies_key=>$movie)<br>
                        {<br>
                        echo $movie->title_russia."'<'br>";<br>
                            foreach($movie->poster->big->attributes() as $poster_key=>$poster)<br>
                            {<br>
                            echo $poster."'<'br>";<br>
                                }<br>
                                }
                    </span>
                </p>
                <p>
                    Теперь проверим наш код ниже.
                </p>
            </div>
            <div class="code_php">
                <?php
                $xml = simplexml_load_file("xml/movies.xml") or die("Error: Cannot create object");
                foreach ($xml as $movies_key => $movie) {
                    echo $movie->title_russian . "<br>";
                    foreach ($movie->poster->big->attributes() as $poster_key => $poster) {
                        echo $poster . "<br>";
                    }
                }
                ?>
            </div>
            <div class="part_1_b">
                <p>
                    Теперь нам осталовь добавить вывести рейтинг.<br>
                    Рейтинг мы будем брать с сайта imb, который также указан в нашем файле xml, но есть он не у всех фиьмов, поэтому к вышеуказанному коду мы допишем цикл if(если), где укажем, что если есть рейтинг то добавить/вывести, нет рейтинга не выводить.
                </p>
                <p class="code_php_p">
                    Вот такую срочку нам надо добавить:<br><br>
                    <span class="code_php_str">
                        if($movie->imdb)<br>
                        {<br>
                        echo $movie->imdb->attributes()['rating'];<br>
                        }
                    </span>
                </p>
                <p class="code_php_p">
                    Таким образом, если мы добавим указанную строчку, то наш код будет выглядеть следующим образом:<br><br>
                    <span class="code_php_str">
                        $xml=simplexml_load_file("xml/movies.xml") or die ("Error: Cannot create object");<br>
                        foreach($xml as $movies_key=>$movie)<br>
                        {<br>
                        echo $movie->title_russia."'<'br>";<br>
                            foreach($movie->poster->big->attributes() as $poster_key=>$poster)<br>
                            {<br>
                            echo $poster."'<'br>";<br>
                                }<br>
                                if($movie->imdb)<br>
                                {<br>
                                echo $movie->imdb->attributes()['rating'];<br>
                                }
                                }
                    </span>
                </p>
                <p>
                    Мы внесли изменения в код и смотрим код ниже, рейтинг мы немного подскрасим, чтобы он выделялся, но в коде внесения этих данных в нашу таблицу, этого делать не надо.
                </p>
            </div>
            <div class="code_php">
                <?php
                $xml = simplexml_load_file("xml/movies.xml") or die("Error: Cannot create object");
                foreach ($xml as $movies_key => $movie) {
                    echo "<span style='font-weight: 700;'>" . $movie->title_russian . "</span>" . "<br>";
                    foreach ($movie->poster->big->attributes() as $poster_key => $poster) {
                        echo $poster . "<br>";
                    }
                    if ($movie->imdb) {
                        echo "<span style='color: orangered;'>" . $movie->imdb->attributes()['rating'] . "</span>" . "<br>";
                    }
                }
                ?>
            </div>
        </section>
        <section class="part_2">
            <div class="">
                <p>
                    Теперь переходим к основному и важному, а именно теперь напишем код для записи данных из xml файла в таблицу нашей БД.
                </p>
                <p>
                    Для начала нам надо создать новые переменные, так нам будет легче и проще использовать их для INSERT, т.е. код так будет более читаем.<br>
                    Новые переменные у нас будут иметь занчение null, т.е. это пременны без значения.
                </p>
                <p class="code_php_p">
                    И так создаем новые переменные:<br><br>
                    <span class="code_php_str">
                        $title=null;<br>
                        $title.orign=null;<br>
                        $post=null;<br>
                        $rating=null;<br>
                        $year=null;
                    </span>
                </p>
                <p>
                    Теперь пишем наш код под конкретную задачу, т.е. загрузку данных из xml файла в таблицу БД.<br>
                    При этом, наш код будет немного отличаться от написанного ранее.
                </p>
                <p class="code_php_p">
                    И так пишем наш код к циклу FOREACH:<br><br>
                    <span class="code_php_str">
                        foreach($xml as $movie_key->$movie)<br>
                        {<br>
                        $title=$movie->title_russian;<br>
                        $title_orign=$movie->title_original;<br>
                        $year=$movie->year;<br>
                        foreach($movie->poster->big->attributes() as poster.key=>$poster)<br>
                        {<br>
                        $post=$poster;<br>
                        }<br>
                        if($movie->imdb)<br>
                        {<br>
                        $rating=$movie->imdb->attribites()['rating'];<br>
                        }<br>
                        else {<br>
                        $rating=null;<br>
                        }<br>
                        }
                    </span>
                </p>
                <p class="code_php_p">
                    Теперь пишем код для INSERT с нашими новые переменными:<br><br>
                    <span class="code_php_str">
                        INSERT($title, $title_orign, $year, $rating, $post, 1);
                    </span><br>
                    в конце указали 1(один), так как у нас в столбце categoryes_id все фильмы имеют категорию 1.
                </p>
            </div>
        </section>
        <section class="">
            <div class="finish">
                <p>
                    Теперь запишем наш код полностью, т.е. так как он должен быть написан с самого начала.
                </p>
                <div class="">
                    <p class="code_php_p">
                        Вот как должен полностью выглядеть наш код для выгрузки даннх из xml файла в нашу таблицу БД:<br><br>
                        <span class="code_php_str">
                            '<'?php<br>
                                function insert($name, $desc, $year, $category_id, $rating, $poster)<br>
                                {<br>
                                $mysqli = new mysqli('localhost', 'root', '', 'study7.2lesson');<br>
                                if (mysqli_connect_errno()) {<br>
                                printf('Соединение не установлено', mysqli_connect_error());<br>
                                exit();<br>
                                }<br>
                                $mysqli->set_charset('utf8');<br><br>

                                $query = "INSERT INTO movie_list VALUES(null, '$name', '$desc', '$year', Now(), '$category_id', '$rating', '$poster')";<br><br>

                                $result = false;<br><br>

                                if ($mysqli->query($query)) {<br>
                                $result = true;<br>
                                }<br>
                                return $result;<br>
                                }<br><br>
                                $xml = simplexml_load_file("xml/movies.xml") or die("Error: Cannot create object");<br><br>
                                $title=null;<br>
                                $title.orign=null;<br>
                                $post=null;<br>
                                $rating=null;<br>
                                $year=null;<br><br>
                                foreach($xml as $movie_key=>$movie)<br>
                                {<br>
                                $title=$movie->title_russian;<br>
                                $title_orign=$movie->title_original;<br>
                                $year=$movie->year;<br>
                                foreach($movie->poster->big->attributes() as $poster_key=>$poster)<br>
                                {<br>
                                $post=$poster;<br>
                                }<br>
                                if($movie->imdb)<br>
                                {<br>
                                $rating=$movie->imdb->attributes()['rating'];<br>
                                }<br>
                                else {<br>
                                $rating=null;<br>
                                }<br>
                                INSERT($title, $title_orign, $year, 1, $rating, $post);<br>
                                }<br>
                                ?>
                        </span>
                    </p>
                </div>
                <p>
                    Теперь проверим наш код в действиии и чтобы убедиться, что информация записана в нашу таблицу в БД, нужно обновить страницу сайта(ctrl+F5) и дальше смотрим в таблицу в админ.панели phpMyAdmin.
                </p>
            </div>
        </section>
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
                $xml = simplexml_load_file("xml/movies.xml") or die("Error: Cannot create object");

                $title = null;
                $title_orign = null;
                $post = null;
                $rating = null;
                $year = null;

                foreach ($xml as $movie_key => $movie) {
                    $title = $movie->title_russian;
                    $title_orign = $movie->title_original;
                    $year = $movie->year;

                    foreach ($movie->poster->big->attributes() as $poster_key => $poster) {
                        $post = $poster;
                    }
                    if ($movie->imdb) {
                        $rating = $movie->imdb->attributes()['rating'];
                    } else {
                        $rating = null;
                    }
                    INSERT($title, $title_orign, $year, 1, $rating, $post);
                }
                echo "<pre>";
                print_r($xml);
                echo "</pre>";
                ?>
            </div>
        </section>
    </main>
    <footer></footer>
</body>

</html>