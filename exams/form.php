<?//require 'index.php';
$Command = isset($_POST['Command']) ? $_POST['Command'] : null;
$NumFiscal = isset($_POST['NumFiscal']) ? $_POST['NumFiscal'] : null;
$Certificate_file = isset($_FILES['Certificate']) ? $_FILES['Certificate'] : null; 
if (isset($Certificate_file)) {
	$Certificate = base64_encode(file_get_contents($_FILES['Certificate']['tmp_name']));
}
$PrivateKey_file = isset($_FILES['PrivateKey']) ? $_FILES['PrivateKey'] : null;
if (isset($PrivateKey_file)) {
	$PrivateKey = base64_encode(file_get_contents($_FILES['PrivateKey']['tmp_name']));
}

$Password = isset($_POST['Password']) ? $_POST['Password'] : null;
$FromDate = isset($_POST['FromDate']) ? $_POST['FromDate'] : null;
$ToDate = isset($_POST['ToDate']) ? $_POST['ToDate'] : null;




$body_shift=[	

		'Command'=> $Command,
		'Certificate'=> $Certificate, 			
		'PrivateKey'=> $PrivateKey,
		'Password'=> $Password,
		'NumFiscal'=> $NumFiscal,
		'From'=> $FromDate,
		'TO'=> $ToDate,

	];

$data_string= json_encode($body_shift, JSON_UNESCAPED_UNICODE);
$curl = curl_init('http://192.168.110.8:7080/fsapi/');

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json; charset=UTF-8',
   )
);
$data_shift = json_decode(curl_exec($curl));
if (curl_errno($curl)) {
    print "Error: " . curl_error($curl);
    echo curl_exec($curl);
} else {

    curl_close($curl);
}
?>

