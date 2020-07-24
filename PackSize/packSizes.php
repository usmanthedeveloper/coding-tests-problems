<html>
<form method="POST">
    Packet Size
    <br>
    <input type="text" name="reqPacketSize" id="reqPacketSize" value="<?php if (isset($_POST['reqPacketSize'])) echo $_POST['reqPacketSize']; ?>"></input>
    <br>
    <input type="submit"></input>
</form>

</html>
<br><br>Available Pack Sizes: 500, 250, 1000, 2000, 5000<br>

<?php

//The above is a form to help test this problem!

$packetReqUser = $_POST['reqPacketSize'];
print "<br>";

$requestPacksAmt = $packetReqUser;
$packSizesDelivered = getPacks($requestPacksAmt);
print "Packs Delivered:\t";

foreach ($packSizesDelivered as $packSize) {
    echo "| $packSize ";
}

function getPacks($requestNum)
{

    $packSizesAvailabile = [500, 250, 1000, 2000, 5000];
    asort($packSizesAvailabile);

    $min = min($packSizesAvailabile);
    $max = max($packSizesAvailabile);

    //Anything less than 0 we will not deal with of course!
    if ($requestNum <= 0) {
        return array();
    }

    //Simple cases where the requested amount is less than the smallest pack size should be issued immediately. E.g. 15 requested and the minimum pack size is 50...issued amount should be 50
    if ($requestNum <= $min) {
        return array($min);
    }

    //Simple case, if we have an exact match for packet size of a requested amount we will issue this and keep the packs at a minimum 1x!
    if (in_array($requestNum, $packSizesAvailabile)) {
        return array($requestNum);
    }

    //It would be wise to find out the value that is higher than the requested amount so we can work our way to pack sizes below that as anything much higher will be irrelevant.


    $requestAmountRemaining = $requestNum;
    $x = 0;
    $previousDiff = 0;
    $curDiff = 0;
    $maxPackSize = max($packSizesAvailabile);
    while ($requestAmountRemaining > 0) {
        $curMaxValue = findMaxValue($requestAmountRemaining, $packSizesAvailabile);
        $curMinValue = findLowValue($requestAmountRemaining, $packSizesAvailabile);

        print "START<br>";
        print "Request Amt Remaining | $requestAmountRemaining <br>";
        print "CURMAX: $curMaxValue <br>";
        print "CURMIN: $curMinValue <br>";
        if ($requestAmountRemaining > $curMaxValue && $curMaxValue == $maxPackSize) {
            $packToCheck = $curMaxValue;
        } else {
            $packToCheck = $curMinValue;
        }
        print "Pack to Check Value | $packToCheck <br>";
        if ($packToCheck < $requestAmountRemaining) {
        $requestAmountRemaining = $requestAmountRemaining % $packToCheck;
        if ($requestAmountRemaining != 0) {
            
                $division = floor($requestAmountRemaining / $packToCheck);
            }
        }

        print "DIVISION: $division <br>";
        print "MOD: $requestAmountRemaining <br>";
        print "DIVISION: $requestNum <br>";
        print "END<br><br>";

        $x++;
        if ($x > 10) break;
    }

    return array();
}

function findMaxValue($number, $array = array())
{
    $max = max($array);

    if ($number > $max) {
        return $max;
    }

    foreach ($array as $value) {

        if ($value >= $number) {
            return $value;
        }
    }
}

function findLowValue($number, $array = array())
{
    $min = min($array);
    $max = max($array);

    if ($number > $max) {
        $number = $max;
    }

    $previous = 0;
    foreach ($array as $value) {

        if ($value >= $number) {
            return $previous;
        }
        $previous = $value;
    }
}
