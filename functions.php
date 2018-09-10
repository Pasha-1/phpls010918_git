<?php
require_once 'vendor/autoload.php';
function sendMail($email, $message, $subject)
{
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
        ->setUsername('')
        ->setPassword('');
    $mailer = new Swift_Mailer($transport);
    $message = (new Swift_Message($subject))
        ->setFrom(['' => 'Burger maker'])
        ->setTo([$email])
        ->setBody($message);
    $result = $mailer->send($message);
}

function orders($pdo, $id)
{
    $sql = 'INSERT INTO orders (personID) VALUES(:id)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $lastOrderId = $pdo->lastInsertId();
    $sql = 'SELECT customer.street, customer.hose_num, customer.floor, customer.email
            FROM customer 
            INNER JOIN orders ON customer.id = orders.PersonID AND customer.id = :id
            ORDER BY orders.personID';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $customer = $stmt->fetchAll();
    $orderQnty = $stmt->rowCount();
    if ($orderQnty > 1) {
        $lastMsg = "Это ваш $orderQnty заказ";
    } else {
        $lastMsg = "Это ваш первый заказ";
    }
    $subject = "Заказ № $lastOrderId";
    $message = $subject . PHP_EOL .
        'Ваш заказ будет доставлен по адресу' . PHP_EOL .
        "Улица " . $customer[0]['street'] . ' Дом ' . $customer[0]['hose_num'] . ' Этаж ' . $customer[0]['floor'] . PHP_EOL .
        'Cодержание заказа: DarkBeefBurger за 500 рублей, 1 шт' . PHP_EOL .
        $lastMsg;
    echo 'Спасибо за заказ ';
    $file = 'messages/' . date("d-m-Y H-i-s") . '.txt';
    file_put_contents($file, $message);
    sendMail($customer[0]['email'], $message, $subject);
}