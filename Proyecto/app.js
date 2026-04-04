$(document).ready(function() {
    // 1. Menú Hamburguesa
    $('#hamburger').click(function() {
        $('#nav-links').toggleClass('active');
    });

    // 2. Control de Modales
    $('#btn-login').click(function() {
        $('#loginModal').css('display', 'flex');
        $('#nav-links').removeClass('active'); // Ocultar menú en móvil
    });

    $('.close-btn').click(function() {
        $('.modal').css('display', 'none');
    });

    // Cerrar modal al clickear afuera
    $(window).click(function(e) {
        if ($(e.target).hasClass('modal')) {
            $('.modal').css('display', 'none');
        }
    });

    // Inicializar Select2 en el modal de registro
    $('#reg-genre').select2({
        dropdownParent: $('#registerModal')
    });

    // 3. Simulación de Validación de Usuario con AJAX
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        
        let user = $('#login-user').val();
        let pass = $('#login-pass').val();

        // SIMULACIÓN: Aquí harías un $.ajax() real a un archivo PHP.
        // Simulamos que el único usuario en BD es "admin" con clave "1234"
        
        if(user === "admin" && pass === "1234") {
            // Usuario existe
            $('#loginModal').css('display', 'none');
            Swal.fire({
                icon: 'success',
                title: '¡Bienvenido!',
                text: 'Has iniciado sesión correctamente.',
                background: '#1e293b',
                color: '#fff'
            });
        } else {
            // Usuario no existe
            $('#loginModal').css('display', 'none');
            Swal.fire({
                icon: 'error',
                title: 'Usuario no encontrado',
                text: 'Las credenciales no coinciden. ¿Deseas crear una cuenta?',
                showCancelButton: true,
                confirmButtonText: 'Sí, registrarme',
                cancelButtonText: 'Cancelar',
                background: '#1e293b',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#registerModal').css('display', 'flex');
                }
            });
        }
    });

    // 4. Registro de Usuario
    $('#registerForm').submit(function(e) {
        e.preventDefault();
        $('#registerModal').css('display', 'none');
        
        Swal.fire({
            icon: 'success',
            title: '¡Cuenta Creada!',
            text: 'Tu usuario ha sido registrado en la base de datos.',
            background: '#1e293b',
            color: '#fff'
        });
        
        // Limpiar formularios
        $(this)[0].reset();
        $('#loginForm')[0].reset();
    });
});