<?php
require_once('includes/config.php');
require_once('includes/RD_Station.php');

//ENVIO DE E-MAILS
if ($_SESSION['emailEnviado']) {
    $checaemail = explode("@", $_REQUEST["Email"]);
    if ($checaemail[1] != "teste.com" || $checaemail[1] != "dowbis.com.br" || $checaemail[1] != "gamartins.com.br") {
         $now       = gmdate("Y-m-d H:i:s", time() + 3600 * (-3 + date("I")));
        $sql
            = "INSERT INTO matricula (
                  matricula_instituicao,
                  matricula_codigo,
                  matricula_nome,
                  matricula_email,
                  matricula_celular,
                  matriculaCurso_area,
                  matricula_cidade,
                  matricula_tipo,
                  matricula_dataCadastro
              ) VALUES (
                  '{$universidade}',
                  '{$campanha}',
                  '{$_REQUEST['NomeCompleto']}',
                  '{$_REQUEST['Email']}',
                  '{$_REQUEST['Telefone']}',
                  '{$_REQUEST['AreaPretendida']}',
                  '{$_REQUEST['Estado']}',
                  'lp',
                  '{$now}'
              )";



        if (mysqli_query($sqlconex, $sql)) {
            //echo "New record created successfully";
            $lastid = mysqli_insert_id($sqlconex);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($sqlconex);
        }
    }

  
}

//INTEGRAÇÃO COM ACTIVE CAMPAIGN
if ($rowscamp['campanha_activecampaign'] == 1) {
    $url = 'https://grupoandrademartins.api-us1.com/';
    $params = array(
        'api_key'    => '38536f92aa5f18e16ae4371dfd838cf5589e56cad61b447fccc003812e7e482e2011eb2a',
        'api_action' => 'contact_add',
        'api_output' => 'serialize',
    );

    $post = array(
        'first_name' => $_REQUEST["NomeCompleto"],
        'email'      => $_POST["Email"],
        'field[7]'   => $_POST["Telefone"],
        'field[24]'  => $_POST["AreaPretendida"],
        'field[14]'  => $_REQUEST['Estado'],
        'form'       => 229,
    );

    $query = "";
    foreach ($params as $key => $value) $query .= urlencode($key) . '=' . urlencode($value) . '&';
    $query = rtrim($query, '& ');

// This section takes the input data and converts it to the proper format
    $data = "";
    foreach ($post as $key => $value) $data .= urlencode($key) . '=' . urlencode($value) . '&';
    $data = rtrim($data, '& ');
    $url = rtrim($url, '/ '); // clean up the url

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
    if (!function_exists('curl_init')) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
    if ($params['api_output'] == 'json' && !function_exists('json_decode')) {
        die('JSON not supported. (introduced in PHP 5.2.0)');
    }

    $api = $url . '/admin/api.php?' . $query; // define a final API request - GET

    $request = curl_init($api); // initiate curl object
    curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
    curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
    curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

    $response = (string)curl_exec($request); // execute curl post and store results in $response

    curl_close($request); // close curl object

    if (!$response) {
        die('Nothing was returned. Do you have a connection to Email Marketing server?');
    }
    $result = unserialize($response);
}


header('Location: obrigado.php');