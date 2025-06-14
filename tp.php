<!DOCTYPE html>
<html lang="en">

<head>
    <title>Se connecter à ENSAH Service</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description"
        content="Accédez facilement aux services de l'Ecole nationale des sciences appliquées d'Al Hoceima ">
    <meta name="keywords" content="ENSAH, Al Hoceima , E Service , Université Abdelmalek essaadi, Ecole nationale">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <link rel="icon" href="assets/images/logo-small_noBG.png" type="image/png"> <!-- icone dans l'onglet de site-->

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="../assets/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/style-preset.css">
    <style>
        .container {
            border: 1px solid black;
            height: 100%;
        }

        header {
            height: 30px;
            margin: 5px;
            border: 1px solid black;
            background-color: rgb(173, 173, 173);
        }

        nav {
            height: 20px;
            margin: 5px;
            border: 1px solid black;
            background-color: green;
        }

        main {
            border: 1px solid black;
            border: 1px solid black;
            margin: 3px;
            background-color: rgb(99, 99, 255);
        }

        main article {
            border: 1px solid black;
            margin: 5px;
            background-color: red;
        }

        main>aside {
            border: 1px solid black;
            margin: 3px;
        }

        main aside section {
            border: 1px solid black;
            background-color: burlywood;
        }

        section {
            border: 1px solid black;
            margin: 5px;
            background-color: aqua;
        }

        section article:first-child,
        section article:nth-child(2),
        section article:last-child {
            flex: 1;
            margin: 5px;
            border: 1px solid black;
        }

        section article:first-child {
            background-color: blueviolet;
        }

        section article:nth-child(2) {
            background-color: rgb(80, 226, 43);
        }

        section article:last-child {
            background-color: rgb(76, 43, 226);
        }

        footer {
            margin: 5px;
            border: 1px solid black;
            height: 30px;
            background-color: darkolivegreen;
        }

        .floating-box {
            float: left;
            width: 150px;
            height: 75px;
            margin: 10px;
            border: 3px solid #73ad21;
        }

        .floating-box {
            display: inline-block;
            width: 150px;
            height: 75px;
            margin: 10px;
            border: 3px solid #73ad21;
        }

        .after-box {
            clear: left;
        }

        @media (max-width: 1000px) {
            section {
                flex-direction: column;
            }

            main {
                flex-direction: column;
            }

            main article {
                flex: 1;
                height: 100%;
            }

            main aside {
                flex: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="row">Header</header>
        <nav class="row">Navbar</nav>
        <main class="row">
            <article class="col-lg-7">Article</article>
            <aside class="col-lg-4">
                <section >Section 1</section>
                <section >Section 2</section>
            </aside>
        </main>
        <section class="row">
            <article class="col-lg-4">Article 1</article>
            <article class="col-lg-4">Article 2</article>
            <article class="col-lg-4">Article 3</article>
        </section>
        <footer class="row">Footer</footer>
    </div>

    <div class="floating-box">Floating box</div>
    <div class="floating-box">Floating box</div>
    <div class="floating-box">Floating box</div>
    <div class="after-box">Another box, after the floating boxes...</div>
</body>

</html>