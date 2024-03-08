<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athentification</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="logins/login.css">

   
</head>

<body>


    <div class="container">
       

    
        <form action="{{ route('login') }}" method="post">
        <div class="drop drop-1"><img src="..\images\cidep.jpg"></div>
            <p>S'AUTHENTIFIER</p><br>
           
            @csrf

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br><br>
            @enderror
            <input id="email" type="email" placeholder="E-mail"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                required autocomplete="off" autofocus><br><br>

            <input id="password" type="password" placeholder="Mot de passe"
                class="form-control @error('password') is-invalid @enderror" name="password" required
                autocomplete="off" ><br><br><br><br><br>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
            <button type="submit">Se connecter</button>

            <br>

        </form>

    </div>

</body>

</html>
