<?php

function encryptData($input, $key_seed = "1234567890123") {
    $input = trim($input);
    $block = mcrypt_get_block_size('tripledes', 'ecb');
    $len = strlen($input);
    $padding = $block - ($len % $block);
    $input .= str_repeat(chr($padding), $padding);

    // generate a 24 byte key from the md5 of the seed 		 
    $key = substr(md5($key_seed), 0, 24);
    $iv_size = mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    // encrypt 		 
    $encrypted_data = mcrypt_encrypt(MCRYPT_TRIPLEDES, $key, $input, MCRYPT_MODE_ECB, $iv);
    // clean up output and return base64 encoded 
    $encrypted_data = base64_encode($encrypted_data);
    return $encrypted_data;
}

function decrypt($input, $key_seed = "1234567890123") {
    $input = base64_decode($input);
    $key = substr(md5($key_seed), 0, 24);

    $text = mcrypt_decrypt(MCRYPT_TRIPLEDES, $key, $input, MCRYPT_MODE_ECB, 'Mkd34ajdfka5');
    $block = mcrypt_get_block_size('tripledes', 'ecb');
    $packing = ord($text{strlen($text) - 1});

    if ($packing and ( $packing < $block)) {
        for ($P = strlen($text) - 1; $P >= strlen($text) - $packing; $P--) {
            if (ord($text{$P}) != $packing) {
                $packing = 0;
            }
        }
    }

    $text = substr($text, 0, strlen($text) - $packing);
    return $text;
}

//Hàm gọi sáng Alego
function postUrl($url, $data) {
    //Định nghĩa Header khi gọi
    $headerArray = array(
        'Content-Type: application/json; charset=UTF-8',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

    $result = curl_exec($ch);
    $result = json_decode($result, true);

    return $result;
}

function dataCard($telco, $cardPrice, $cardQuanlity) {
//ID tài khoản của đại lý
    $partnerCode = "962b3bff-b4a1-3148-84a6-71b34d65dd5f";
//Mã tham chiếu đại lý gửi sang (mã này là duy nhất trong mỗi lần gửi sang)
    $transId = "GT" . time() . rand(1000, 9999);
//Secret Key
    $secretKey = 'e100ff8075671756a4b16b5d0da1ed60';
//Ten ham ket noi
    $Func = "buyPrepaidCards";
//Phien ban API ket noi
    $ver = 'v1.0';
//Mảng dữ liệu thông tin đơn hàng
    $data = array(
        //Mã tham chiếu đại lý gửi sang
        'refName' => $transId,
        //Mã NPH do GTV quy định và cung cấp
        'Telco' => $telco,
        //Mệnh giá thẻ mua
        'cardPrice' => $cardPrice,
        //Số lượng thẻ
        'cardQuanlity' => $cardQuanlity
    );

//Tạo string json
    $data = json_encode($data);
//Mã hóa String data
    $EncData = encryptData($data);
    echo "<p>EncData:<br/>";
    var_dump($EncData);
    echo "</p><p>Decrypt:";
    echo decrypt($EncData);
    echo "</p>";
//Tạo mã checksum, chữ ký
    $token = md5($Func . $partnerCode . $EncData . $ver . $secretKey);
    echo "<p>Token:".$token."</p>";
//Khởi tạo mảng dữ liệu gọi sang GTV
    $inputs = array(
        'partnerCode' => $partnerCode,
        'Ver' => $ver,
        'Func' => $Func,
        'EncData' => $EncData,
        'token' => $token
    );
//Thực hiện tạo String json mảng
    echo $inputs = json_encode($inputs);
    return $inputs;
}
if(isset($_POST['buyCard'])){

    //$url = "http://localhost:8000/api/partnerCards";
    $url = "http://14.225.2.183:8000/api/partnerCards";
    set_time_limit(0);
    $data = postUrl($url, dataCard($_POST['telco'],$_POST['cardPrice'],$_POST['cardQuanlity']));

    echo '<p>Data Reponse encode: ';
    var_dump($data);
    echo '</p>';

    $encodeData = $data['resData'];
    $desData = decrypt($encodeData);

    echo '<p>Data Reponse decode: ';
    var_dump($desData);
    echo "</p><p>";
    var_dump(json_decode($desData),true);
    echo '</p>';
}
?>
<form action="" method="POST">
    <select name="telco">
        <option value="VTT">Viettel</option>
        <option value="VMS">Mobifone</option>
        <option value="VNP">Vinaphone</option>
        <option value="SFONE">Sfone</option>
        <option value="GTEL">Gfone</option>
        <option value="VNM">VnMobile</option>
    </select><br/>
    <select name="cardPrice">
        <option value="10000">10.000</option>
        <option value="20000">20.000</option>
        <option value="30000">30.000</option>
        <option value="50000">50.000</option>
        <option value="100000">100.000</option>
        <option value="200000">200.000</option>
        <option value="300000">300.000</option>
        <option value="500000">500.000</option>
    </select><br/>
    <input name="cardQuanlity" value="1" type="number"/>
    <input name="buyCard" type="submit" value="Buy Card"/>
</form>
