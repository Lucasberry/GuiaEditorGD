<?php

require "config/connection.php";

$categories = $conn->query("SELECT * FROM categorias");


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia del Editor</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>

    <!-- Creditos -->
    <div class="overlay hidden" id="credits">
        <div class="dialog">
            <img class="arrow left hidden" src="assets/img/left.png">
            <img class="close" src="assets/img/close.png"
                onclick="document.getElementById('credits').classList.add('hidden');">
            <div class="credits-page 01">
                <span>Creditos</span>
                <img class="icon" src="assets/img/credits/whisp.png">
                <a href="https://twitter.com/whispgd" target="_blank" class="gold">ItsWhisp</a>
                <span class="small">Diseño y estructura de la pagina</span>
            </div>
            <div class="credits-page 02 hidden">
                <span>Creditos</span>
                <img class="icon" style="height: 60px; padding: 10px 0;" src="assets/img/credits/jorge603.gif">
                <a href="https://youtube.com/@Jorge603" target="_blank" class="gold">Jorge603</a>
                <span class="small">Hosting, dominio y funciones</span>
            </div>
            <div class="credits-page 03 hidden">
                <span style="color: rgb(0, 255, 0);">Agradecimientos Especiales</span>
                <div class="thanks-container">
                    <div class="thanks-item">
                        <img class="icon" style="height: 60px; padding: 10px 0;" src="assets/img/credits/colon.png">
                        <a href="https://twitter.com/TheRealGDColon" target="_blank" class="gold">Colon</a>
                    </div>
                    <div class="thanks-item">
                        <img class="icon" style="height: 60px; padding: 10px 0;"
                            src="assets/img/credits/spacedream.png">
                        <a href="https://twitter.com/space_sd" target="_blank" class="gold">SpaceDream</a>
                    </div>
                </div>
                <p class="disclaimer unselectable">"Geometry Dash", sus texturas y demás archivos utilizados dentro
                    de este sitio web son propiedad de RobTop Games.</p>
            </div>
            <img class="arrow right" src="assets/img/right.png">
        </div>
    </div>
    <a href="https://github.com/ItsWhisp/GuiaEditorGD" target="_blank" class="github unselectable"><img
            src="assets/img/github.png"></a>
    <img class="logo unselectable" src="assets/img/logo.png">
    <span class="unselectable">Guia del editor</span>
    <span class="gold small unselectable">(En Construccion)</span>
    <div class="section menu unselectable">
        <a data-tippy-content="Servidor de Discord de Geometry Dash Español" target="_blank"
            class="menu-button disabled">
            <img src="assets/img/buttons/discord.png">
        </a>
        <a data-tippy-content="Guia oficial del editor (En Ingles)"
            href="https://www.robtopgames.com/files/GDEditor.pdf" target="_blank" class="menu-button">
            <img src="assets/img/buttons/guia-oficial.png">
        </a>
        <a data-tippy-content="Creditos y agradecimientos especiales" href="#creditos"
            onclick="document.getElementById('credits').classList.remove('hidden');" class="menu-button">
            <img src="assets/img/buttons/creditos.png">
        </a>
    </div>


    <!-- Carga de categorias y secciones -->

    <?php if ($categories->rowCount() == 0): ?>
    <?php echo "No hay contenido en la pagina"; ?>
    <?php endif ?>
    <?php foreach ($categories as $category): ?>
    <div class="section unselectable">
        <span>
            <?= $category["titulo"] ?>
        </span>
        <div class="section-links">
            <?php $sections = $conn->query("SELECT * FROM secciones WHERE id_categoria = {$category['id_categoria']}"); ?>
            <?php foreach ($sections as $section): ?>
            <?php if ($section["has_img"] == 0): ?>
            <a class="gd-button" href="pagina.php?g=<?= $section["nombre_seccion"] ?>">
                <?= $section["titulo"] ?>
            </a>
            <?php elseif ($section["has_img"] == 1): ?>
            <?php if ($section["has_multiple_img"] == 0): ?>
            <a class="gd-button" href="pagina.php?g=<?= $section["nombre_seccion"] ?>">
                <img src="<?= $section["imagen_uri"] ?>">
                <?= $section["titulo"] ?>
            </a>
            <?php elseif ($section["has_multiple_img"] == 1): ?>
            <a class="gd-button" href="pagina.php?g=<?= $section["nombre_seccion"] ?>">
                <?php
                                $imgs = $conn->query("SELECT * FROM imagenes WHERE id_seccion = {$section['id_seccion']}");
                                foreach ($imgs as $img):
                                    ?>
                <img src="<?= $img["uri_img"] ?>">
                <?php endforeach ?>
                <?= $section["titulo"] ?>
            </a>
            <?php endif ?>
            <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
    <?php endforeach ?>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="assets/js/index.js"></script>
</body>

</html>