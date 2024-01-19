<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title></title>
 <meta name="description" content="">
 <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/style.css">

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@200&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class=" " >
            <form class="form-control pl-3 p-3 rounded" style="background-color: #048abf38 !important;" action="./Connection/isAccesGranted.php" method="post">
                <div class="row mb-2">
                    <div class="col-12">
                        <h3 class="text-center text-white">Connexion</h3>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 form-group">
                        <label class="form-check-label" for="">Login</label>
                        <input type="text" name="login" id="" class="form-control" placeholder="Login" aria-describedby="helpId">
                    </div>
                </div>
                <br>
                <div class="row mb-2">
                    <div class="col-12 form-group">
                        <label class="form-check-label" for="">Mot de passe</label>
                        <input type="password" name="pwd" id="" class="form-control" placeholder="MotDePasse" aria-describedby="helpId" required>
                    </div>
                </div>
                <br>
                <div class="row mb-2">
                    <div class="col-12 form-group">
                        <input type="submit" value="Connexion" class="btn btn-primary">
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>