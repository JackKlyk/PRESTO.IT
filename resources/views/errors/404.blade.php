
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 404</title>

    <link rel="icon" type="image/x-icon" href="\img\presto.it_favicon.ico">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="container-fluid min-vh-100 p-0 page_404 d-grid align-items-center w-100">
            <div class="row g-0">
                <div class="col-12 p-0 d-flex justify-content-center">
                    <div class="col-sm-10 text-center">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center ">404</h1>
                        </div>
    
                        <div class="contant_box_404">
                            <h2>Sembra che ti sei perso...</h2>
    
                            <p>La pagina che stai cercando non è disponibile!</p>
    
                            <a href="{{ route('homepage') }}" class="link_404 rounded shadow">Torna alla Home</a>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>