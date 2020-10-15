<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
</head>
<body style='background: linear-gradient(45deg, rgba(34,193,195,1) 0%, rgba(241,6,20,1) 0%, rgba(252,47,108,1) 100%);'>
   <img src="man.svg" alt="" height="400px" width="375px"> 
    
   <div class="card" style="text-align: center;width: 100%;padding-top: 10px;padding-bottom: 10px">
    <form action="/verify.php" method="GET" >
        <input type="text" style="border-radius: 30px; border: 1px solid red;height: 30px;width: 300px;text-align: center;font-family: 'Piazzolla', serif;" name="number" placeholder='Enter Phone No' ><br>
        <button class="btn btn-warning" style="padding: 10px"><a style="padding: 5px">Submit</a></button>
    </form>
    </div>

</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    
</html>