<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

$c = curl_init();
curl_setopt($c,CURLOPT_URL,'https://bitbay.net/API/Public/BTCUSD/market.json');
curl_setopt($c,CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
$txt = curl_exec($c);

$array = json_decode($txt, true);

$lowestAskBitbay = $array['asks']['0']['0'];
$highestBidBitbay = $array['bids']['0']['0'];

echo '<ul class="crypto_list col-md-4">';
echo "<h3>BitBay</h3>";
echo "<li>Najtańsza sprzedaż: ".$lowestAskBitbay."$</li>";
echo "<li>Najdroższe kupno: ".$highestBidBitbay."$</li>";
echo '</ul>';
curl_close($c);



$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,'https://api.binance.com/api/v3/ticker/bookTicker?symbol=BTCUSDT');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);



$result = curl_exec($ch);

$array2 = json_decode($result, true);


$lowestAskBinance = $array2['askPrice'];
$highestBidBinance = $array2['bidPrice'];


echo '<ul class="crypto_list col-md-4">';
echo "<h3>Binance</h3>";
echo "<li>Najtańsza sprzedaż: ".round($lowestAskBinance, 2)."USDT</li>";
echo "<li>Nadroższe kupno: ".round($highestBidBinance, 2)."USDT</li>";
echo "</ul>";    
    
curl_close($ch);

$ch2 = curl_init();
curl_setopt($ch2,CURLOPT_URL,'https://bittrex.com/api/v1.1/public/getorderbook?market=USDT-BTC&type=both');
curl_setopt($ch2,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2,CURLOPT_FOLLOWLOCATION, true);
    
$result2 = curl_exec($ch2);
    
$array3 = json_decode($result2, true);

#print_r($array3);    
    
$lowestAskBittrex = $array3['result']['sell']['0']['Rate'];
$highestBidBittrex = $array3['result']['buy']['0']['Rate'];

echo '<ul class="crypto_list col-md-4"><h3>Bittrex</h3>';
echo '<li>Najtańsza sprzedaż: '.round($lowestAskBittrex, 2).'USDT</li>';
echo '<li>Najdroższe kupno: '.round($highestBidBittrex, 2).'USDT</li></ul>';
        
curl_close($ch2);

$ch3 = curl_init();
curl_setopt($ch3,CURLOPT_URL,'https://yobit.net/api/2/btc_usd/ticker');
curl_setopt($ch3,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch3,CURLOPT_FOLLOWLOCATION, true);
$result3 = curl_exec($ch3);

$array4 = json_decode($result3,true);

$lowestAskYobit = $array4['ticker']['sell'];
$highestBidYobit = $array4['ticker']['buy'];

curl_exec($ch3);
echo '<ul class="crypto_list col-md-4">';
echo "<h3>Yobit</h3>";
echo "<li>Najtańsza sprzedaż: ".round($lowestAskYobit, 2)."$</li>";
echo "<li>Nadroższe kupno: ".round($highestBidYobit, 2)."$</li>";
echo "</ul>";
curl_close($ch3);
        
$ch4 = curl_init();
curl_setopt($ch4,CURLOPT_URL,'https://api.bitfinex.com/v1/book/btcusd');
curl_setopt($ch4,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch4,CURLOPT_FOLLOWLOCATION,true);
$result4 = curl_exec($ch4);

$array5 = json_decode($result4,true);
        
$lowestAskBitfinex = $array5['asks']['0']['price'];
$highestBidBitfinex = $array5['bids']['0']['price'];

echo '<ul class="crypto_list col-md-4">';
echo "<h3>Bitfinex</h3>";
echo "<li>Najtańsza sprzedaż: ".round($lowestAskBitfinex, 2)."$</li>";
echo "<li>Nadroższe kupno: ".round($highestBidBitfinex, 2)."$</li>";
echo "</ul>";
        
curl_close($ch4);
        
$ch5 = curl_init();
curl_setopt($ch5,CURLOPT_URL,'https://www.bitstamp.net/api/order_book/');
curl_setopt($ch5,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch5,CURLOPT_FOLLOWLOCATION,true);
$result5 = curl_exec($ch5);
$array6 = json_decode($result5,true);
        
$lowestAskBitstamp = $array6['asks']['0']['0'];
$highestBidBitstamp = $array6['bids']['0']['0'];

echo '<ul class="crypto_list col-md-4">';
echo "<h3>Bitstamp</h3>";
echo "<li>Najtańsza sprzedaż: ".round($lowestAskBitstamp, 2)."$</li>";
echo "<li>Nadroższe kupno: ".round($highestBidBitstamp, 2)."$</li>";
echo "</ul>";
        
curl_close($ch5);

        $lowestAskAll = array(
            "Bitbay" => $lowestAskBitbay,
            "Binance" => $lowestAskBinance,
            "Bittrex" => $lowestAskBittrex,
            "Yobit" => $lowestAskYobit,
            "Bitfinex" => $lowestAskBitfinex,
            "Bitstamp" => $lowestAskBitstamp,
        );
        $lowestAskAll2 = array(
            $lowestAskBitbay => "Bitbay",
            $lowestAskBinance => "Binanace",
            $lowestAskBittrex => "Bittrex",
            $lowestAskYobit => "Yobit",
            $lowestAskBitfinex => "Bitfinex",
            $lowestAskBitstamp => "Bitstamp",
        );
        $highestBidAll = array(
            "Bitbay" => $highestBidBitbay,
            "Binance" => $highestBidBinance,
            "Bittrex" => $highestBidBittrex,
            "Yobit" => $highestBidYobit,
            "Bitfinex" => $highestBidBitfinex,
            "Bitstamp" => $highestBidBitstamp,
        );
        $highestBidAll2 = array (
            $highestBidBitbay => "Bitbay",
            $highestBidBinance => "Binance",
            $highestBidBittrex => "Bittrex",
            $highestBidYobit => "Yobit",
            $highestBidBitfinex => "Bitfinex",
            $highestBidBitstamp => "Bitstamp",
        );
        $lowestValue = array_keys($lowestAskAll,min($lowestAskAll));
        #echo $lowestValue[0];
        $lowestMarket = $lowestValue[0];
        #echo $lowestValue2[0];
        $lowestAsk = min(array_keys($lowestAskAll2));
        $highestValue = array_keys($highestBidAll,max($highestBidAll));
        #echo $highestValue[0];
        $highestMarket = $highestValue[0];
        $highestBid = max(array_keys($highestBidAll2));
        #echo $highestBid;
    ?>
    <div class="container col-md-6" style="margin-left:0;">
<table class="table table-bordered">
    <tr>
        <th>Kupujesz</th>
        <th>Sprzedajesz</th>
        <th>Zarobek (wliczone prowizje)</th>
    </tr>
    <tr>
        <td><?php echo $lowestMarket . $lowestAsk;?></td>
        <td><?php echo $highestMarket . $highestBid; ?></td>
        <td><?php $percentBitBin = $highestBid/$lowestAsk;
            $DiffBitBin = number_format(($percentBitBin-1)*100, 4) . '%';
            echo $DiffBitBin; ?>
        </td>
    </tr>
</table>
    </div>
       
</body>


</html>


