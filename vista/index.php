<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC API DATACRM - Prueba Tecnica</title>
    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="../css/style.css">
    <!--    CSS de los iconos-->
    <link rel="stylesheet" href="https://www.datacrm.com/css/fontawesome620.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <!-- Icono -->
    <link rel="icon" href="https://www.datacrm.com/front/images/favicon.ico">
    <!-- Tipo de letra -->
    <link rel="prefetch" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
</head>
<body>
<div class="container-fluid" style="margin: 0px; padding: 0px;">
    <div class="home-background" style="width: 100%; height:4.5rem; position: fixed; z-index: 1000;">
        <nav class="navbar navbar-expand-md px-5 py-1 navbar-fixed mobile-nav justify-content-between">
            <div class="d-md-inline-block">
                <div class="d-none d-lg-block">
                    <a href="https://www.datacrm.com/">
                        <picture>
                            <source srcset="https://www.datacrm.com/front/images/Logodata_Horizontalblanco180x58.webp">
                            <img src="https://www.datacrm.com/front/images/Logodata_Horizontalblanco180x58.webp"
                                 alt="DataCRM" width="180" height="58" class="img-logo" loading="lazy">
                        </picture>
                    </a>
                </div>
                <div class="d-sd-block d-lg-none" style="float: right;">
                    <a href="https://www.datacrm.com/">
                        <picture>
                            <img src="https://www.datacrm.com/front/images/Logodata_Horizontalblanco210x65.webp"
                                 alt="DataCRM" width="140" height="38" class="img-logo lazyload mt-2" loading="lazy"
                                 style="width: 120px !important;">
                        </picture>
                    </a>
                </div>
            </div>
            <ul class="navbar-nav">
                <li class="nav-contact typ-montserrat">
                    <a class="btn txt-white mx-2 myNavbarFont" href="#" style="font-weight: bold;">
                        <i class="fa-regular fa-circle-user"></i>&nbsp; Prueba Técnica : Jordan E. García Pertuz</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="container p-1" id="1">
        <div class="row section-resize section-init-index">
            <div class="col-lg-6 col-md-6 col-12 mt-5 px-5">
                <h1 class="text-uppercase myTitleBlue mt-5 typ-montserrat ft-h2 br-wd text-center text-md-left">
                    <span class="span-border-b-w font-weight-bold">Prueba Técnica</span>
                    <br>
                    <span class="txt-orange font-weight-bold">Desarrollador PHP Semi Senior</span>
                </h1>
                <p class="typ-os-regular typ-montserrat f-sz-m mt-3 d-none d-lg-block">Este sistema utiliza el patrón
                    de diseño MVC y está desarrollado con PHP, HTML, CSS y JavaScript Puro.</p>
                <p class="typ-os-regular typ-montserrat f-sz-m mt-3 d-none d-lg-block">
                    Para probarlo, simplemente haz clic en el botón "Consultar API".
                </p>

                <div class="row d-none d-lg-block">
                    <div class="col-lg-10 pr-0 d-lg-block" style="float: right;">
                        <!-- Botón que contiene la instrucción en el id mostrarDatos para mostrar la información en la tabla -->
                        <button class="modalPruebaGratis3 btn2 btn-orange mt-3 f-sz-m my-3 p-2 px-4 typ-montserrat effect-zoom p-2 btn myBtnBlue typ-montserrat px-4 f-sz-m mt-3 effect-zoom p-2"
                                id="mostrarDatos">
                            <b class="">Consultar API <i class="fa-solid fa-terminal"></i></b>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 align-self-center mt-5">
                <div class="d-sm-block d-md-none justify-content-center text-center align-contacts-center mb-5">
                    <img src="https://i.imgur.com/ziRVm6l.png"
                         alt="sistema-crm-con-whatsapp" class="img-fluid" width="290" height="227">
                </div>
                <div class="d-none d-md-block">
                    <img src="https://i.imgur.com/ziRVm6l.png"
                         alt="sistema-crm-con-whatsapp" class="img-fluid" width="461" height="360" loading="lazy">
                </div>
            </div>
        </div>
    </div>

    <br>

    <div id="datos">
        <!-- Aquí se visualizarán los datos del API en una tabla -->
    </div>

    <script>
        document.getElementById('mostrarDatos').addEventListener('click', function () {
            fetch('../controlador/DataCRM.php') // Consultar el API desde el controlador
                .then(response => response.json()) // Recibir la respuesta en JSON
                .then(data => { // Pintar la tabla de acuerdo a los datos
                    let table = '<div class="col-md-12 col-12 text-center"> <h2 class="text-uppercase mt-4 txt-blue typ-montserrat ft-h2 myTitleBlue">MIS CONTACTOS</h2> <hr class="hr-silver30"><br> </div><table class="container p-1">';
                    table += '<tr class="botonOutline txt-black changePlan myButton2 myButtonL"><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">ID</th><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">N° Contacto</th><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">Apellido</th><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">Fecha y hora de creación</th></tr>';
                    data.forEach(contact => {
                        table += `<tr><td class="myButton2 text-center">${contact.id}</td class="myButton2 text-center"><td class="myButton2 text-center">${contact.contact_no}</td class="myButton2 text-center"><td class="myButton2 text-center">${contact.lastname}</td class="myButton2 text-center"><td class="myButton2 text-center">${contact.createdtime}</td class="myButton2 text-center"></tr>`;
                    });
                    table += '</table></br>';
                    document.getElementById('datos').innerHTML = table; // Muestra la tabla con los datos en el Div
                    // Scroll hacia abajo automáticamente para ver la tabla cargada
                    window.scrollBy({
                        top: document.getElementById('datos').offsetTop - window.scrollY,
                        behavior: 'smooth'
                    });
                })
                .catch(error => console.error('Error:', error)); // Si ocurre algún error en el API, mostrarlo en la consola
        });
    </script>
</div>
</body>
</html>
