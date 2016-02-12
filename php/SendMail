<?php

include 'CommonLanding.php';

$email = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$text = $_POST['text'];

$handled = CommonLanding::handlingForm1($email, $name, $phone, 'Заявка');
echo json_encode($handled);
