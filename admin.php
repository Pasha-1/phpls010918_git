<?php
include 'dbconnection.php';
echo 'Клиенты<br>';
$sql = 'SELECT * FROM customer';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$customers = $stmt->fetchAll();
echo '<table style="width:50%">
<tr>
    <th>id</th>
    <th>Имя</th> 
    <th>Мыло</th>
    <th>Телефон</th>
    <th>Улица</th>
    <th>Дом</th>
    <th>Корпус</th>
    <th>Квартира</th>
    <th>Этаж</th>
    <th>Комментарии</th>
    <th>Нужна сдача</th>
    <th>Оплата Картой</th>
    <th>Перезвонить</th>
  </tr>';
foreach ($customers as $customer) {
    echo "<tr>";
    echo "<td>" . $customer['id'] . "</td>";
    echo "<td>" . $customer['name'] . "</td>";
    echo "<td>" . $customer['email'] . "</td>";
    echo "<td>" . $customer['street'] . "</td>";
    echo "<td>" . $customer['hose_num'] . "</td>";
    echo "<td>" . $customer['corp'] . "</td>";
    echo "<td>" . $customer['room'] . "</td>";
    echo "<td>" . $customer['floor'] . "</td>";
    echo "<td>" . $customer['comments'] . "</td>";
    echo "<td>" . $customer['change_requered'] . "</td>";
    echo "<td>" . $customer['change_requered'] . "</td>";
    echo "<td>" . $customer['do_not_call'] . "</td>";
    echo "</tr>";
}
echo '</table> <br>';
echo '<br>Заказы<br>';
$sql = 'SELECT orders.OrderID, customer.name, customer.email  
       FROM orders
       RIGHT JOIN customer ON orders.personID = customer.id;';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll();
echo '<table style="width:50%">
<tr>
    <th>id</th>
    <th>Имя</th> 
    <th>Емейл</th>
  </tr>';
foreach ($orders as $order) {
    echo "<tr>";
    echo "<td>" . $order['OrderID'] . "</td>";
    echo "<td>" . $order['name'] . "</td>";
    echo "<td>" . $order['email'] . "</td>";
    echo "</tr>";
}
echo '</table> <br>';