<?php

    function SendOtp($mobile,$message)
    {
        //API URL
        $url="http://atozsms.in/api/sendhttp.php";
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'authkey' => '99520AyXFP5dOed572472d4',
                'mobiles' => $mobile,
                'message' => $message,
                'sender' => 'TITBPL',
                'route' => 4
            )
        ));
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //get response
        return curl_exec($ch);
        curl_close($ch);
    }


?>