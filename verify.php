<?php
if(isset($_POST['number'])){
    $x =  $_POST['number'];
}
else{
    $x =  htmlspecialchars($_GET['number']);
}
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://firestore.googleapis.com/v1/projects/nineteenkg-3d2ea/databases/(default)/documents/usersData/".strval($x));
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
   ));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($curl),false);
curl_close($curl);
$providerid= $output->fields->providerid->stringValue;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://firestore.googleapis.com/v1/projects/nineteenkg-3d2ea/databases/(default)/documents/providerProfile/".strval($providerid));
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
   ));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$data2 = json_decode(curl_exec($curl),false);
$gasPrice = $data2->fields->price->stringValue;
$providerName = $data2->fields->provider_name->stringValue;
curl_close($curl);

if(isset($_POST['nodeliver']) and isset($_POST['nopickup'])){
    $temp='{"fields": {
                "noofcylinders": {
                    "stringValue": "'.strval($_POST['nodeliver']).'"
                },
                "phonenumber": {
                    "stringValue": "'.$x.'"
                },
                "provider": {
                    "stringValue": "'.$output->fields->providerid->stringValue.'"
                },
                "noofcylinderstopickup": {
                    "stringValue": "'.strval($_POST['nopickup']).'"
                },
                "id": {
                    "stringValue": "'.$output->fields->id->stringValue.'"
                },
                "orderedon": {
                    "timestampValue":"'.date("Y-m-d")."T".date("H:i:s")."Z".'"
                },
                "pricepercylinderwithdiscount": {
                    "stringValue": "'.strval(intval($gasPrice)-intval($output->fields->discount->stringValue)).'"
                },
                "status": {
                    "stringValue": "0"
                }
            }
            }';
$ch = curl_init('https://firestore.googleapis.com/v1/projects/nineteenkg-3d2ea/databases/(default)/documents/orders');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $temp);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($temp))
);
$result = curl_exec($ch);
curl_close($ch);
$temp='{
    "fields": {
        "stock": {
            "stringValue": "'.strval(intval($output->fields->stock->stringValue)+intval($_POST['nodeliver'])-intval($_POST['nopickup'])).'"
        }
    }
}';
$ch = curl_init('https://firestore.googleapis.com/v1beta1/projects/nineteenkg-3d2ea/databases/(default)/documents/usersData/'.$x.'?updateMask.fieldPaths=stock');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
curl_setopt($ch, CURLOPT_POSTFIELDS, $temp);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($temp))
);
$result = curl_exec($ch);
curl_close($ch);
header("Location: https://nineteenkg.herokuapp.com/confirm.html"); 
exit;

}

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  </head>
  <body style="background: linear-gradient(321deg, rgba(34,193,195,1) 0%, rgba(196,88,160,1) 0%, rgba(252,47,108,1) 100%);" class="text-center">
      
      
    <!--Top nav bar-->
    <div class="text-center" style="background-color:white;padding:10px">
        <img src="logo.png" height="50px" width="auto">
        <h3>19 Kg Online Gas Booking</h3>
    </div>  
    <div class="card " style="padding: 15px !important;border-radius: 5px;margin: 10px;">
        <div class="row">
            <div class="col-5">
                <p style="font-family: 'Work Sans', sans-serif;">Provider Name : </p>
            </div>
            <div class="col">
                <p style="font-family: 'Work Sans', sans-serif;"><?php echo $providerName ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <p style="font-family: 'Work Sans', sans-serif;">Name : </p>
            </div>
            <div class="col">
                 <p><?php
      echo $output->fields->name->stringValue;
      ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <p style="font-family: 'Work Sans', sans-serif;">Consumer ID : </p>
            </div>
            <div class="col">
                <p><?php
      echo $output->fields->id->stringValue;
      ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <p style="font-family: 'Work Sans', sans-serif;">Current Stock : </p>
            </div>
            <div class="col">
                 <p><?php
      echo $output->fields->stock->stringValue;
      ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <p style="font-family: 'Work Sans', sans-serif;">Phone No:</p>
            </div>
            <div class="col">
               <p style="font-family: 'Work Sans', sans-serif;"> 
                <?php echo $x?>
                </p>
            </div>
        </div>
    </div>
      

    <!--Price card-->
    <div class="card" style="padding: 10px; margin: 10px;border-radius: 10px;">
        <div>
            <h3 style="text-align: center;">
               Current Gas Price
            </h3>        
        </div>
        <div class="row" >
            <div class="col-7" style="font-family: 'Raleway', sans-serif;">
                Price Per Cylindar:
            </div>
            <div class="col">
                <?php echo $gasPrice ?>/-
            </div>
        </div>
         <div class="row">
            <div class="col-7" style="font-family: 'Raleway', sans-serif;">
               Discount:
            </div>
            <div class="col"><?php
      echo $output->fields->discount->stringValue;
      ?>/-</div>
        </div>
        <div class="row">
            <div class="col-7" style="font-family: 'Raleway', sans-serif;">
                Your Price Per Cylinder:
            </div>
            <div class="col"><?php 
                echo intval($gasPrice)-intval($output->fields->discount->stringValue)?>/-</div>
        </div>
    </div>

    <!--Book Cylinders Now-->
    <div class="card" style="padding: 10px; margin: 10px;">
        <form method="post" action="/verify.php?number=<?php echo $x ?>" name="bookingform">
            <div>
                <label for="deliver" style="padding: 5px;font-family: 'Roboto', sans-serif;">No of Cylinders you need</label>
                <br>
                <input type="text" class="form-control" name='nodeliver'placeholder='How many'>
            </div>
            
            <div>
                <label for="pickup" style="padding:5px;font-family: 'Roboto', sans-serif;">Empty Cylinders you have</label>
                <br>
                <input type="text" class="form-control" name="nopickup" placeholder="How many?">
            </div>
            <input type="number" name="number" value="<?php echo $x ?>" style="display:none">
            <div class="btn btn-primary btn-block" style="margin-top: 10px;" onClick="document.forms['bookingform'].submit();">Book Now</div>
        </form>
    </div>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>

  </body>
</html>
