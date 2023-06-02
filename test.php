<?php

function load_users_data($user_ids) {
    $data = [];
    $pdo = new PDO("mysql:host=localhost;dbname=database", 'root', '123123');
    $query = $pdo->prepare('SELECT * FROM users WHERE id IN(:ids)');
    $query->bindParam(':ids',$user_ids);
    $query->execute();
    while($row = $query->fetch(PDO::FETCH_OBJECT)) {
        $data[$row->id] = $row;
    }
    return $data;
}

$data = load_users_data($_GET['user_ids']);
foreach ($data as $user) {
    echo "<a href=\"/show_user.php?id=$user->id\">$user->name</a>";
}