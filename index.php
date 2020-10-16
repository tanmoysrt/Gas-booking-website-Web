<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:wght@500&display=swap" rel="stylesheet">
</head>
<body style='background: linear-gradient(45deg, rgba(34,193,195,1) 0%, rgba(241,6,20,1) 0%, rgba(252,47,108,1) 100%);'>
   <img src="man.svg" alt="" height="400px" width="375px"> 
    
   <div style="text-align: center;width: 100%;height:500px;padding-top: 10px;padding-bottom: 10px">
    <form action="/verify.php" method="GET" >
        <input type="text" style="border-radius: 30px; border: 1px solid red;height: 30px;width: 300px;text-align: center;font-family: 'Piazzolla', serif;" name="number" placeholder='Enter Phone No' required ><br>
        <button class="btn btn-warning" style="padding: 10px"><a style="padding: 5px">Submit</a></button>
    </form>
    </div>

</body>

    
</html>
