<?php
require_once './db/connection.php';


$itemsPerPage = 10;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = intval($_GET['page']);
} else {
    $currentPage = 1;
}

$offset = ($currentPage - 1) * $itemsPerPage;

$sql = "SELECT * FROM `products`";
$result = $conn->query($sql);
$totalRows = mysqli_num_rows($result);

$totalPages = ceil($totalRows / $itemsPerPage);

if ($currentPage < 1) {
    $currentPage = 1;
} elseif ($currentPage > $totalPages) {
    $currentPage = $totalPages;
}

$offset = ($currentPage - 1) * $itemsPerPage;

$sql = "SELECT * FROM `products` LIMIT $itemsPerPage OFFSET $offset";
if($totalRows > 0){
    $result = $conn->query($sql);
}



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="empilhadeiraStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-align-v.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3fcdf21787.js" crossorigin="anonymous"></script>
    <title>Empresa</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="img/logo.png" height="70px" alt="Imagem Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="index.php">Início</a>
                    <a class="nav-link" href="empilhadeiras.php">Empilhadeiras</a>
                    <a class="nav-link" href="contato.php">Contato</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="containerImg" style="padding: 0;">
        <div class="container">
            <h1>Descubra uma variedade de empilhadeiras de alta qualidade para atender às suas necessidades.</h1>
            <p>Encontre a empilhadeira perfeita para otimizar suas operações.</p>
        </div>
    </div>

    </div>
    </div>
    <?php

        echo "<div class='container-card container-fluid'>";
    while ($products_data = mysqli_fetch_assoc($result)) {
        echo "<div class='card col-lg-10' style='width: 350px;'>";
        $img = $products_data['product_imgName'];
        $path = "./admin/imagesUpload/";
        $pathImg = ($path . $img);
        echo "<img src='$pathImg' class='card-img-top' alt='Imagem da '>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $products_data['product_name'] . "</h5>";
        echo "<hr class='mb-4'>";
        echo "<div class='information'>";
        echo "<div class='container text-center'>";
        echo "<div class='row'>";
        echo "<div class='col align-self-start'>";
        echo "<h5>Combustível:</h5>";
        echo "<p>" . $products_data['product_detail1'] . "</p>";
        echo "</div>";
        echo "<div class='col align-self-center'>";
        echo "<h5>Elevacão:</h5>";
        echo "<p>" . $products_data['product_detail2'] . "</p>";
        echo "</div>";
        echo "<div class='col align-self-start'>";
        echo "<h5>Capacidade de Carga:</h5>";
        echo "<p>" . $products_data['product_detail3'] . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<a href='informacao.php?id=" . $products_data['product_id'] . "'><button id='btnMoreProdutcs'>Saiba Mais</button></a>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
    
    ?>


    <nav id="NumberPages" aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item " . ($i == $currentPage ? 'active' : '') . "'>";
                echo "<a class='page-link' href='empilhadeiras.php?page=$i'>$i</a>";
                echo "</li>";
            }
            ?>
        </ul>
    </nav>


    <footer class="text-white bg-dark pt-5 pb-4">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">
                <div class="row text-center text-md-start">
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h5 class="mb-4"><img src="img/logo.png" height="150px" alt="Imagem Logo"></h5>
                    </div>

                    <div class="footerNav col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h5 class=" mb-4 font-weight-bold text-white">
                            Navegação
                        </h5>
                        <hr class="mb-4">
                        <p>
                            <a href="index.php">Início</a>
                        </p>
                        <p>
                            <a href="empilhadeiras.php">Empilhadeiras</a>
                        </p>
                        <p>
                            <a href="contato.php">Contato</a>
                        </p>
                    </div>
                    <div class="ContactBar col-md-2 col-lg-2 col-xl-3 mx-auto mt-3">
                        <h5 class=" mb-4 font-weight-bold text-white">
                            Contato
                        </h5>
                        <hr class="mb-4">
                        <p>
                            <a href="" class="bi bi-geo-alt-fill"> Seu endereço</a><br>
                        </p>
                        <p>
                            <a href="" class="bi bi-telephone-fill"> (xx) xxxx-xxxx</a><br>
                        </p>
                        <p>
                        </p>
                        <a href="" class="bi bi-envelope-fill"> seuemail@contato.com</a>
                        </p><br><br>
                    </div>
                    <hr class="mb-4">
                    <div class=" mediaIcon text-center">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item">
                                <a href="" class="text-white"><i class="bi bi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="" class="text-white"><i class="bi bi-whatsapp"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="" class="text-white"><i class="bi bi-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>

</html>