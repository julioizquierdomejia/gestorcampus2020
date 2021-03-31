<?php
	// Cargamos Requests y Culqi PHP
	require 'requests/library/Requests.php';
	Requests::register_autoloader();
	require 'culqi/lib/culqi.php';

	// Configurar tu API Key y autenticación
	$SECRET_KEY = "sk_test_258tD9bjcHOSz1rb";
	$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));

	$culqi->Charges->create(
		array(
            "amount" => $_POST['precio'],
			"capture" => true,
            "currency_code" => "PEN",
			"description" => $_POST['producto'],
			"customer_id" => $_POST['customer_id'],
			"address" => $_POST['address'],
            "email" => $_POST['email'],
            "installments" => 0,

            "antifraud_details" => array(
                "address" => $_POST['address'],
                "address_city" => "LIMA",
                "country_code" => "PE",
                "first_name" => $_POST['first_name'],
                "last_name" => $_POST['last_name'],
                "phone_number" => $_POST['telephone'],
            ),

            "source_id" => $_POST['token']
        )

	);

	echo "exito";

	exit();
?>



