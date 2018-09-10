<?php
include 'functions.php';
include 'dbconnection.php';
$email = $_POST["email"];
$stmt = $pdo->query('SELECT * FROM customer');
$count = $stmt->rowCount();
$sql = 'SELECT * FROM customer WHERE email = :email';
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);
$customers = $stmt->fetchAll();
$count = $stmt->rowCount();
if ($count) {
    orders($pdo, $customers[0]['id']);
} else {
    $sql = 'INSERT INTO customer (name,email,tel,street,hose_num,corp,room,floor,
                                   comments,change_requered,card_payment,do_not_call) 
            VALUES(:name,:email,:tel,:street,:hose_num,:corp,:room,:floor,:comments,:change_requered,:card_payment,:do_not_call)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $_POST["name"],
            'email' => $_POST["email"],
            'tel' => $_POST["phone"],
            'street' => $_POST["street"],
            'hose_num' => $_POST["home"],
            'corp' => $_POST["part"],
            'room' => $_POST["appt"],
            'floor' => $_POST["floor"],
            'comments' => $_POST["comment"],
            'change_requered' => intval(filter_var($_POST["change"], FILTER_VALIDATE_BOOLEAN)),
            'card_payment' => intval(filter_var($_POST["cardPayment"], FILTER_VALIDATE_BOOLEAN)),
            'do_not_call' => intval(filter_var($_POST["callBack"], FILTER_VALIDATE_BOOLEAN)),
        ]
    );
    $sql = 'SELECT id  FROM customer WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $_POST["email"]]);
    $id = $stmt->fetch();
    orders($pdo, $id['id']);
}