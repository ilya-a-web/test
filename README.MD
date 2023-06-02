<pre>
<div style="text-align: justify;">
Задача №1
Имеется база со следующими таблицами:
CREATE TABLE `users` (
`id`         INT(11) NOT NULL AUTO_INCREMENT,
`name`       VARCHAR(255) DEFAULT NULL,
`gender`     INT(11) NOT NULL COMMENT '0 - не указан, 1 - мужчина, 2 - женщина.',
`birth_date` INT(11) NOT NULL COMMENT 'Дата в unixtime.',
PRIMARY KEY (`id`)
);
CREATE TABLE `phone_numbers` (
`id`      INT(11) NOT NULL AUTO_INCREMENT,
`user_id` INT(11) NOT NULL,
`phone`   VARCHAR(255) DEFAULT NULL,
PRIMARY KEY (`id`)
);
Напишите запрос, возвращающий имя и число указанных телефонных номеров девушек в возрасте от 18 до 22 лет. Оптимизируйте таблицы и запрос при необходимости.
</div>
<div style="color: red">
Полям тамблицы users - gender - добавил бы индекс
Полям таблицы phone_numbers - user_id - добавил бы индекс

ответ на запрос в файле test.sql
</div>

<div style="text-align: justify;">
Задача №2
Проведите рефакторинг, исправьте баги и продокументируйте в стиле PHPDoc код, приведённый ниже (таблица users здесь аналогична таблице users из задачи №1). Примечание: код написан исключительно в тестовых целях, это не "жизненный пример" :)
function load_users_data($user_ids) {
$user_ids = explode(',', $user_ids);
foreach ($user_ids as $user_id) {
$db = mysqli_connect("localhost", "root", "123123", "database");
$sql = mysqli_query($db, "SELECT * FROM users WHERE id=$user_id");
while($obj = $sql->fetch_object()){
$data[$user_id] = $obj->name;
}
mysqli_close($db);
}
return $data;
}
// Как правило, в $_GET['user_ids'] должна приходить строка
// с номерами пользователей через запятую, например: 1,2,17,48
$data = load_users_data($_GET['user_ids']);
foreach ($data as $user_id=>$name) {
echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";
}
Плюсом будет, если укажете, какие именно уязвимости присутствуют в исходном варианте (если таковые, на ваш взгляд, имеются), и приведёте примеры их проявления.
</div>

<div style="color: red">
Было бы здорово если бы все запросы проходили через pdo.
Ответ в файле test.php
Не нужно каждый раз в цикле создавать новое подключение к бд и каждого пользователя выделять в отдельный запрос к бд.
Проще сразу передать строку с номерами пользователей и отсортировать запрос через IN;
В итоге запрос один.
Опасно передавать любые параметры без обработки в базу. Это sql injection;
Поэтому я решил сделать через обертку pdo и экранировать переданные параметры.
</div>


</pre>
