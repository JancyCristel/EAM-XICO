<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        .footer {
            background-color: #222;
            /* Color de fondo oscuro */
            color: #ffffff;
            /* Texto blanco */
            padding: 40px;
            /* Espaciado interno más amplio */
            text-align: center;
            /* Centrar el texto */
            position: relative;
            /* Posicionamiento relativo para efectos de fondo */
        }

        /* Contenedor del footer */
        .footer-container {
            display: flex;
            /* Usar flexbox para organizar el contenido */
            justify-content: space-between;
            /* Espaciado entre columnas */
            align-items: flex-start;
            /* Alinear al inicio en el eje vertical */
            max-width: 1200px;
            /* Ancho máximo */
            margin: 0 auto;
            /* Centrar el contenedor */
        }

        /* Estilo para la sección de redes sociales en el footer */
        .social-media {
            text-align: center;
            /* Centrar el texto y los íconos */
        }

        .icons-container {
            display: flex;
            /* Usar flexbox para alinear los íconos en una fila */
            justify-content: center;
            /* Centrar los íconos horizontalmente */
            gap: 10px;
            /* Espacio entre los íconos */
            margin-top: 10px;
            /* Espacio superior para separar los íconos del texto */
        }

        .social-media img {
            width: 30px;
            /* Tamaño de los íconos */
            height: 30px;
            /* Tamaño de los íconos */
            transition: transform 0.3s;
            /* Transición para el efecto hover */
        }

        .social-media a {
            text-decoration: none;
            /* Quitar subrayado de los enlaces */
        }

        .social-media a:hover img {
            transform: scale(1.1);
            /* Aumentar tamaño del icono al pasar el ratón */
        }

        /* Estilo para la sección de contacto en el footer */
        .contact-info {
            max-width: 300px;
            /* Ancho máximo de la columna de contacto */
            text-align: left;
            /* Alinear texto a la izquierda */
        }

        .contact-info h3,
        .contact-info h4 {
            margin-bottom: 10px;
            /* Espacio inferior del título */
            font-size: 22px;
            /* Tamaño del título */
            border-bottom: 2px solid #ffffff;
            /* Línea debajo del título */
            padding-bottom: 5px;
            /* Espacio inferior del título */
        }

        /* Estilo para la sección "Quiero más información" en el footer */
        .info-request {
            max-width: 400px;
            /* Ancho máximo del formulario */
            background-color: #333;
            /* Fondo del formulario */
            border-radius: 8px;
            /* Bordes redondeados */
            padding: 20px;
            /* Espaciado interno del formulario */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            /* Sombra para profundidad */
            text-align: left;
            /* Alinear texto a la izquierda */
        }

        .info-request input,
        .info-request textarea {
            border: none;
            /* Sin borde */
            border-radius: 4px;
            /* Bordes redondeados */
            padding: 10px;
            /* Espacio interno */
            margin-top: 5px;
            /* Espacio entre el label y el campo */
            background-color: #444;
            /* Fondo de los campos */
            color: white;
            /* Color del texto */
        }

        .info-request input::placeholder,
        .info-request textarea::placeholder {
            color: white;
            /* Color del placeholder */
            opacity: 0.8;
            /* Opcional: ajuste de opacidad */
        }

        .info-request h3 {
            margin-bottom: 15px;
            /* Espacio inferior del título */
        }

        .info-request form {
            display: flex;
            flex-direction: column;
            /* Colocar los campos del formulario en columnas */
        }

        .info-request label {
            margin-top: 10px;
            /* Espacio entre etiquetas y campos */
            font-weight: bold;
            /* Hacer el texto en negrita */
        }

        .info-request button {
            margin-top: 15px;
            /* Espacio superior para el botón */
            padding: 10px;
            /* Espaciado interno */
            background-color: #007BFF;
            /* Color del botón */
            border: none;
            /* Sin borde */
            border-radius: 4px;
            /* Bordes redondeados */
            color: white;
            /* Color del texto del botón */
            cursor: pointer;
            /* Cambiar el cursor al pasar sobre el botón */
            transition: background-color 0.3s;
            /* Transición para el efecto hover */
        }

        .info-request button:hover {
            background-color: #0056b3;
            /* Color del botón al pasar el cursor */
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                /* Cambiar a columna en pantallas pequeñas */
                align-items: flex-start;
                /* Alinear al inicio en el eje vertical */
                text-align: left;
                /* Alinear el texto a la izquierda */
            }

            .contact-info,
            .info-request {
                width: 100%;
                /* Hacer que las columnas usen todo el ancho disponible */
            }
        }

        #copyright {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <footer class="footer">
        <div class="footer-container">
            <div class="social-media">
                <p>Síguenos en nuestras redes sociales:</p>
                <hr>
                <div class="icons-container">
                    <a href="https://www.facebook.com/profile.php?id=100057654879548&mibextid=LQQJ4d" target="_blank">
                        <img src="/img/facebook-icon.png" alt="Facebook">
                    </a>
                    <a href="https://www.youtube.com/@energiaactivademexico1925" target="_blank">
                        <img src="/img/youtube-icon.png" alt="YouTube">
                    </a>
                </div>
            </div>
            <div class="contact-info">
                <h3>Horario</h3>
                <p>Lunes a Viernes 9:00 AM - 6:00 PM</p>
                <p>Sábados de 8:00 AM - 2:00 PM</p>
                <br>
                <br>
                <h4>Línea Directa</h4>
                <p>Teléfono: 9612899090</p>
                <p>Email: ventas_ea@eademexico.com</p>
            </div>
            <div class="info-request">
                <h3>Quiero más información</h3>
                <form action="#" method="post">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" required placeholder="Ingresa tu nombre">

                    <label for="phone">Número telefónico:</label>
                    <input type="tel" id="phone" name="phone" required placeholder="Ingresa tu número a 10 dígitos">

                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required placeholder="Ingresa tu correo electrónico">

                    <label for="message">Mensaje:</label>
                    <textarea id="message" name="message" required placeholder="Escribe tu mensaje aquí"></textarea>

                    <button type="submit">Enviar información de contacto</button>
                </form>
            </div>
        </div>
        <p id="copyright">© <span id="year"></span> Todos los derechos reservados.</p>
    </footer>

    <script>
        // Actualiza el año actual en el footer
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>

</body>

</html>