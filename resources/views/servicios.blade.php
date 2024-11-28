@extends('layouts.app')
@section('titulo', 'Servicios')
<link rel="stylesheet" href="/css/servicios.css">
@section('contenido')

   <center> <h1>Servicios</h1></center>
    <center><p>Ayudamos a las personas, empresas y comunidades a lograr más con proyectos que amplían su desarrollo y mejoran su calidad de vida.</p></center>

    <div class="servicios">
        <div class="servicio-card">
            <h3>Venta</h3>
            <img src="img/venta.png" alt="Venta" class="servicio-imagen">
            <p>Implementamos soluciones para mejorar la seguridad y eficiencia en el control de acceso.</p>
        </div>

        <div class="servicio-card">
            <h3>Instalación</h3>
            <img src="img/instalacion.jpeg" alt="Instalación" class="servicio-imagen">
            <p>Preparamos e instalamos tu equipo dejándolo a punto para que trabaje adecuadamente.</p>
        </div>

        <div class="servicio-card">
            <h3>Dimensionamiento</h3>
            <img src="img/dim.png" alt="Dimensionamiento" class="servicio-imagen">
            <p>Te ayudamos y asesoramos en buscar la solución adecuada a tu necesidad. Contamos con especialistas en cada área para tu seguridad y tranquilidad.</p>
        </div>

        <div class="servicio-card">
            <h3>Asesoría</h3>
            <img src="img/asesoria.png" alt="Asesoría" class="servicio-imagen">
            <p>Te ayudamos a que saques el máximo provecho a tus equipos.</p>
        </div>

        <div class="servicio-card">
            <h3>Mantenimiento</h3>
            <img src="img/mantenimiento.png" alt="Mantenimiento" class="servicio-imagen">
            <p>Nuestro servicio post venta te ayuda a mantener tus equipos siempre funcionando al 100%.</p>
        </div>
    </div>

    <!-- Sección de Testimonios -->
    <!-- Sección de Testimonios -->
    <div class="testimonios">
        <h2>Testimonios</h2>
        
        <div class="testimonio-card">
            <div class="testimonio-contenido">
                <p>"Excelente servicio, trabajo muy profesional y excelente calidad"</p>
                <div class="calificacion">
                    <span class="estrella">★</span>
                    <span class="estrella">★</span>
                    <span class="estrella">★</span>
                    <span class="estrella">★</span>
                    <span class="estrella">★</span>
                </div>
                <p><strong>- Héctor Herrera</strong></p>
            </div>
            <img src="img/hombre.jpg" alt="Sandra Gómez" class="testimonio-imagen">
        </div>
        <div class="testimonio-card">
            <div class="testimonio-contenido">
                <p>"Excelente servicio, superaron mis expectativas. Definitivamente recomendaría a Energía Activa de México."</p>
                <div class="calificacion">
                    <span class="estrella">★</span>
                    <span class="estrella">★</span>
                    <span class="estrella">★</span>
                    <span class="estrella">★</span>
                    <span class="estrella">★</span>
                </div>
                <p><strong>- Sandra Gómez</strong></p>
            </div>
            <img src="img/mujer.jpg" alt="Sandra Gómez" class="testimonio-imagen">
        </div>
    </div>
@endsection

