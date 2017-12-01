<?php

include 'CommonLanding.php';

$phone = $_POST['phone'];

$handled = CommonLanding::handlingForm1('feedback@malanka.pro', 'FeedBack form', $phone, '-');
echo json_encode($handled);
