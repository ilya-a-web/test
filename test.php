<?php

function load_users_data($user_ids) {
    $data = [];
    $ids = preg_replace('/\D/', ' ', $user_ids);
    $ids = preg_replace( '/ {1,}/', ',', $ids );
    $ids = array_filter( array_map( 'intval', explode( ',', $ids ) ) );
    $ids = implode(',', $ids);
    $pdo = new PDO("mysql:host=localhost;dbname=database", 'root', '123123');
    $query = $pdo->prepare('SELECT * FROM users WHERE id IN(:ids)');
    $query->bindParam(':ids',$ids);
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