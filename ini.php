$email_url = 'https://api.sendpulse.com/addressbooks/930841/emails';
$books = 'https://api.sendpulse.com/addressbooks';
$id = '930841';

$token = 'https://api.sendpulse.com/oauth/access_token';

$data = array(
    'grant_type' => 'client_credentials',
    'client_id' => '599e2c1ff3d27dea53f29dc6cc74df43',
    'client_secret' => 'af08f59c8ca5bc260523ab5983d1d33e',
);

if($curl = curl_init()) {
    curl_setopt($curl, CURLOPT_URL, $token);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($curl);
    $res = json_decode($res, true);
    curl_close($curl);
}

$emails['emails'] = array(
    array(
        'email' => 'subscriber@example.com',
        'variables' => array(
            'phone' => '+12345678900',
            'name' => 'User Name',
        )
    )
);


if($res) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $email_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: " . $res['token_type'] . ' ' . $res['access_token'],
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, serialize($emails));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $xml = curl_exec($ch);
    curl_close($ch);
}



var_dump($xml);
