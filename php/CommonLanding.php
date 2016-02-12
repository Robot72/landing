<?php

/**
 * CommonLanding is class for work landing page
 *
 * @author Robert Kuznetsov
 */
class CommonLanding 
{
    private static $_errors = array();
    private static $_fields = array();
    private static $_sendMail = 'mrrobot@gmail.com';
    
    public static function validateEmail($email)
    {
        if(empty($email)) {
            self::$_errors['email'] = 'Е-майл адрес не введен';
        }
        
        if(preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email) == 1) {
            self::$_sendMail = $email;
            return TRUE;
        }            
        else {
            self::$_errors['email'] = 'Не верно введен е-майл адрес.';
        }
            
    }
    
    public static function issetField($field, $type, $errorMessage)
    {
        if(empty($field)) {
            self::$_errors[$type] = $errorMessage;
        } else {
            self::$_fields[$type] = $field;
        }
    }
    
    /**
     * Проверка формы с четырьмя полями, три из них обязательные(передаются параметрами
     * в метод), последний параметр - это тема сообщения в отсылаемом сообщении на
     * е-майл
     * @param string $email
     * @param string $name
     * @param string $phone
     * @param string $subject
     * @return boolean||array - возвращает либо
     */
    public static function handlingForm1($email, $name, $phone, $subject = '')
    {
        self::validateEmail($email);
        self::issetField($name, 'name', 'Не введено имя.');
        self::issetField($phone, 'phone', 'Не введен номер телефона.');
        if(empty(self::$_errors)) {
            self::sendMail($subject);
            return ['status' => 'good'];
        } else {
            return array_merge(['status' => 'bad'], self::$_errors);
        }
    }
    
    public static function sendMail($subject)
    {
        $headers = "From: ".self::$_fields['name']."<".self::$_fields['email'].">\r\n".
           "MIME-Version: 1.0" . "\r\n" .
           "Content-type: text/html; charset=UTF-8" . "\r\n"; 
        
        $body = '<h3>Имя:</h3><p>'.self::$_fields['name'].'</p><h3>Е-майл:</h3><p>'.
                self::$_fields['email'].'</p>Текст:'.self::$_fields['text'].'</p>';
        mail(self::$_sendMail, $subject, $body, $headers);
    }
}
