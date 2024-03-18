<?php

function sendMessageLandbot()
{
    /*https://api.landbot.io/v1/customers/255231301/send_template/
    {
        "template_id": 3424,
   "template_params": {
        "body": {
            "params": []
      }
   },
   "template_language": "en"
}
    $client = new Client();
    $headers = [
        'Authorization' => 'Token 9ecaf7965ba06dd9fea1332a0a83bcfc30dfd514',
        'Content-Type' => 'text/plain'
    ];
    $body = '{
   "template_id": 3424,
   "template_params": {
      "body": {
         "params": []
      }
   },
   "template_language": "en"
}';
    $request = new Request('POST', 'https://api.landbot.io/v1/customers/255231301/send_template/', $headers, $body);
    $res = $client->sendAsync($request)->wait();
    echo $res->getBody();*/
}
