<html>
<form method="POST">
    Packet Size
    <br>
    <input type="text" name="reqPacketSize" id="reqPacketSize" value="<?php if(isset($_POST['reqPacketSize'])) echo $_POST['reqPacketSize']; ?>"></input>
    <br>
    <input type="submit"></input>
</form>

</html>
<br><br>Available Pack Sizes: 500, 250, 1000, 2000, 5000<br>

<?php
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
    if ($requestNum > $max) {
        $maxValue = $max;
    } else {
        $maxValue = findMaxValue($requestNum, $packSizesAvailabile);
        //Unsure if the low value is needed now!
        $lowValue = findLowValue($requestNum, $packSizesAvailabile);
    }

    $maxValueIndex = array_search($maxValue, $packSizesAvailabile);

    $requestAmountRemaining = $requestNum;
    $packAmtFinal = array();
    while ($requestAmountRemaining != 0) {
        $checkQtyPacks = 0;
        $remainderMod = $maxValue % $requestNum;
        if ($remainderMod == 0) {
            $checkQtyPacks = $maxValueIndex / $requestNum;
        } else {
            
        }

        for ($i = 0; $i < $checkQtyPacks; $i++) {
            $packAmtFinal[] = $maxValueIndex;
            $requestAmountRemaining -= $requestNum;
        }
    }
    return $packAmtFinal;
}

function findMaxValue($number, $array = array())
{

    foreach ($array as $value) {

        if ($value >= $number) {
            return $value;
        }
    }
}

function findLowValue($number, $array = array())
{

    $previous = 0;
    foreach ($array as $value) {
        if ($value >= $number) {
            return $previous;
        }
        $previous = $value;
    }
}