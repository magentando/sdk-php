<?php

namespace Intelipost;
require_once '../intelipost.inc.php';
use Intelipost\Intelipost;

//Para testar efetuando a chamada com o conteudo deste mesmo arquivo
$jsonRequest = '
		{
		  "history": {
		    "created": 1427143660196,
		    "created_iso": "2015-03-23T17:47:40.196-03:00",
		    "event_date": 1427143660182,
		    "event_date_iso": "2015-03-23T17:47:40.182-03:00",
		    "provider_message": "Pedido criado",
		    "provider_state": "NOVO",
		    "esprinter_message": null,
		    "shipment_order_volume_id": 234,
		    "shipment_order_volume_state": "NEW",
		    "shipment_order_volume_state_history": 3597,
		    "shipment_order_volume_state_localized": "Criado"
		  },
		  "invoice": {
		    "invoice_key": "41140502834982004563550010000084111000132317",
		    "invoice_number": "1000",
		    "invoice_series": "1"
		  },
		  "order_number": "sad",
		  "tracking_code": "SW123456789BR",
		  "volume_number": "1"
		}
		';

//Para testar efetuando a chamada externamente
//$jsonRequest = file_get_contents('php://input');

$intelipost = new Intelipost();
var_dump($intelipost->GetPedido()->RecebimentoStatus($jsonRequest));


