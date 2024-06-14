<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC API DATACRM - Prueba Técnica</title>
    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- CSS de los iconos -->
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
                        <button class="modalActualizar btn2 btn-orange mt-3 f-sz-m my-3 p-2 px-4 typ-montserrat effect-zoom p-2 btn myBtnBlue typ-montserrat px-4 f-sz-m mt-3 effect-zoom p-2"
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

    <div id="datoscontacto">
        <!-- Aquí se visualizarán los datos de los contactos desde el API -->
    </div>

    <!-- Aquí se visualizarán los datos de los negocios desde el API -->
    <div id="negocios"></div>

    <br><br>
<!--   modal para actualizar -->

      <div id="modalActualizar" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Actualizar Contacto <span id="contactId"></span></h2>
            <form id="formActualizar">
                <div class="form-group">
                    <label for="lastname">Apellidos:</label>
                    <input type="text" id="lastname" class=" form-control typ-os-regular txt-greenblue-strong mt-3 form-radius" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="assigned_user_id">ID Usuario Asignado:</label>
                    <input type="text" id="assigned_user_id" class=" form-control typ-os-regular txt-greenblue-strong mt-3 form-radius" name="assigned_user_id" required>
                </div>
                <input type="hidden" id="contact_id" name="id" value="">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>

    <!--   FIN modal para actualizar -->

    <script>
        document.getElementById('mostrarDatos').addEventListener('click', function () {
            // Cargar datos de contactos
            fetch('../controlador/DataCRM.php')
                .then(response => response.json())
                .then(responseData => {
                    let data = responseData.data;

                    if (Array.isArray(data)) {
                        let table = '<div class="col-md-12 col-12 text-center"> <h2 class="text-uppercase mt-4 txt-blue typ-montserrat ft-h2 myTitleBlue">MIS CONTACTOS</h2> <hr class="hr-silver30"><br> </div><table class="container p-1">';
                        table += '<tr class="botonOutline txt-black changePlan myButton2 myButtonL"><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">ID</th><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">N° Contacto</th><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">Apellido</th><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">Fecha/hora de creación</th><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">Fecha/hora de actualización</th><th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">Acciones</th></tr>';
                        data.forEach(contact => {
                            table += `<tr><td class="myButton2 text-center">${contact.id}</td><td class="myButton2 text-center">${contact.contact_no}</td><td class="myButton2 text-center">${contact.lastname}</td><td class="myButton2 text-center">${contact.createdtime}</td><td class="myButton2 text-center">${contact.modifiedtime}</td><td class="myButton2 text-center"><button style="font-size: 14px;" class="modalActualizar btn-orange f-sz-m typ-montserrat effect-zoom btn myBtnBlue typ-montserrat f-sz-m effect-zoom p-2 actualizar-btn" data-id="${contact.id}">Actualizar</button></td></tr>`;
                        });
                        table += '</table></br>';
                        document.getElementById('datoscontacto').innerHTML = table;

                        // Scroll hacia abajo automáticamente
                        window.scrollBy({
                            top: document.getElementById('datoscontacto').offsetTop - window.scrollY,
                            behavior: 'smooth'
                        });

                        // Configuración de los botones de actualización
                        document.querySelectorAll('.actualizar-btn').forEach(button => {
                            button.addEventListener('click', function () {
                                let id = this.getAttribute('data-id');
                                let modal = document.getElementById('modalActualizar');
                                let form = document.getElementById('formActualizar');

                                // Mostrar el modal
                                modal.style.display = 'block';

                                // Obtener datos del contacto correspondiente desde el nuevo endpoint
                                fetch(`https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php?operation=retrieve&sessionName=49fba335666b91b0a62ec&id=${id}`)
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Error al cargar los datos del servidor.');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        console.log('Datos del contacto:', data);
                                        let contact = data.result;
                                        form.querySelector('#lastname').value = contact.lastname || '';
                                        form.querySelector('#assigned_user_id').value = contact.assigned_user_id || '';
                                        form.querySelector('#contact_id').value = id;
                                    })
                                    .catch(error => {
                                        console.error('Error al obtener los datos del contacto desde el API:', error);
                                    });

                                // Cerrar el modal al hacer clic en la "X" y afuera
                                let spanClose = modal.querySelector('.close');
                                spanClose.addEventListener('click', function () {
                                    modal.style.display = 'none';
                                });

                                window.addEventListener('click', function (event) {
                                    if (event.target === modal) {
                                        modal.style.display = 'none';
                                    }
                                });

                                form.addEventListener('submit', function (event) {
                                    event.preventDefault(); // Evitar el envío del formulario
                                    actualizarContacto();
                                });
                            });
                        });

                        // Función para enviar la actualización del contacto
                        function actualizarContacto() {
                            let form = document.getElementById('formActualizar');
                            let lastname = form.querySelector('#lastname').value;
                            let assigned_user_id = form.querySelector('#assigned_user_id').value;
                            let contact_id = form.querySelector('#contact_id').value;

                            // Datos a enviar
                            let element = {
                                'lastname': lastname,
                                'assigned_user_id': assigned_user_id,
                                'id': contact_id
                            };

                            // Enviar solicitud POST para actualizar
                            fetch(`https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php?operation=update&sessionName=49fba335666b91b0a62ec`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: new URLSearchParams({
                                    'element': JSON.stringify(element)
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert('Registro actualizado correctamente');
                                        let modal = document.getElementById('modalActualizar');
                                        modal.style.display = 'none'; // Cerrar modal después de éxito
                                    } else {
                                        console.error('Error al actualizar el contacto:', data.message);
                                        alert('Error al actualizar el contacto. Por favor, inténtalo nuevamente.');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error al actualizar el contacto:', error);
                                    alert('Error al actualizar el contacto. Por favor, inténtalo nuevamente.');
                                });
                        }
                    }
                })
                .catch(error => console.error('Error fetching data:', error));

            // Endpoint URL PARA NEGOCIOS
            const endpoint = 'https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php?operation=describe&sessionName=49fba335666b91b0a62ec&elementType=Potentials';

            // Fetch para obtener los datos del endpoint
            fetch(endpoint)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al cargar los datos del servidor.');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos de NEGOCIOS:', data.result);

                    // Obtener los datos de name y idPrefix
                    const name = data.result.name;
                    const idPrefix = data.result.idPrefix;

                    // Construir el HTML para mostrar los datos
                    let table = `<div class="col-md-12 col-12 text-center"> <h2 class="text-uppercase mt-4 txt-blue typ-montserrat ft-h2 myTitleBlue">MIS NEGOCIOS</h2> <hr class="hr-silver30"><br> </div>
                        <div class="container p-1">
                            <table class="container">
                                <tr class="botonOutline txt-black changePlan">
                                    <th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">ID</th>
                                    <th class="text-center botonOutline txt-black changePlan effect-zoom myButton2 myButtonL">Nombre Negocio</th>
                                </tr>
                                <tr>
                                    <td class="myButton2 text-center">${idPrefix}</td>
                                    <td class="myButton2 text-center">${name}</td>
                                </tr>
                            </table>
                        </div>`;

                    // Insertar los datos en el div con id "negocios"
                    document.getElementById('negocios').innerHTML = table;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });  //fin clic en el boton de mostrar

    </script>

</div>
</body>
</html>

