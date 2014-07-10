<!DOCTYPE html>
<html>
<head>
    <title>Ops! Esta página não existe</title>
    <meta charset="utf-8" />
    <style type="text/css">
        body {
            background: url('{{ URL::to('/') }}/img/silvernoise.png') repeat;
            text-align: center;
            font-family: "Open Sans", sans-serif;
        }
        h1 {
            text-transform: uppercase;
            font-size: 3em;
        }
        .well {
            font-size: 10em;
        }
    </style>
</head>
<body>
    <h1>Esta página não existe</h1>
    <div class="well">:(</div>
    <p>Mas que tal ir até a página inicial do site e localizar o que está procurando?</p>
    <p>É só clicar {{ HTML::link('/', 'Aqui') }}</p>
</body>
</html>