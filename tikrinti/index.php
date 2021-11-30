<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['dk'])) {

  $dk = $_GET['dk'];

  if (substr($dk, -12, 2) == "D9") {
    checkTheCard($dk);
  }else {
    echo "Neteisingas dovanų kortelės numeris";
    Redirect('https://dovana.ciamarket.lt/?error="Patkrinkite kortelės numerį"', false);
  }



}elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dk'])) {

  $dk = $_POST['dk'];
 // echo $dk . "<br>";
 // echo (substr($dk, -12, 2));

  if (substr($dk, -12, 2) == "D9") {
    checkTheCard($dk);
  }else {
    echo "Neteisingas dovanų kortelės numeris";
    Redirect('https://dovana.ciamarket.lt/?error="Patkrinkite kortelės numerį"', false);
  }

}else {
  Redirect('https://dovana.ciamarket.lt', false);
}


function checkTheCard($id) {
  if (!empty($id)) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.manorivile.lt/client/v2',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
    "method": "GET_N77_LIST",
    "params": {
        "fil": "n77_kodas_dc=\''.$id.'\'"
    }
}',
      CURLOPT_HTTPHEADER => array(
        'ApiKey: xx',
        'Content-Type: application/json'
      ),
    ));

    if(curl_exec($curl) === false)
    {
      echo 'Curl error: ' . curl_error($curl);
      Redirect('https://dovana.ciamarket.lt/?api=er', false);
      //Redirect('http://localhost/korteles/?api=er', false);
    }
    else
    {
      $response = curl_exec($curl);
      curl_close($curl);

      $simpleXMLElement = simplexml_load_string($response);
      $nominalas = substr($simpleXMLElement->N77->N77_NOMINALAS, 0, 2);
      echo "nominalas: " . $nominalas . "<br>";
      $galioja = $simpleXMLElement->N77->N77_GALIOJA;
      echo "galioja: " . $galioja . "<br>";
      $galiojad = $simpleXMLElement->N77->N77_GALIOJA_D;
      echo "galioja dienų: " . $galiojad . "<br>";
      $galiojaiki = substr($simpleXMLElement->N77->T78_GALIOJA_IKI, 0, 10);
      //$galiojaiki = $simpleXMLElement->N77->N77_R_DATE;
      echo "galioja iki: " . substr($galiojaiki, 0, 10) . "<br>";


      Redirect('https://dovana.ciamarket.lt/?nominalas='.$nominalas.'&galioja='.$galiojaiki.'', false);
      //Redirect('http://localhost/korteles/?nominalas='.$nominalas.'&galioja='.$galiojaiki.'', false);


      //var_dump($simpleXMLElement->N77);
      //$description = (string)$simpleXMLElement->response->description;
      //$username = (string)$simpleXMLElement->transaction->userName;

    }

    //curl_close($curl);
    //var_dump ($response);

  }
}

function Redirect($url, $permanent = false)
{
  header('Location: ' . $url, true, $permanent ? 301 : 302);

  exit();
}

