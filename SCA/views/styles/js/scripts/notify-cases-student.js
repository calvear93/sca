    switch( get_cookie( 'session_state' ) ) {
            case "wrong_password" :
                danger_notification( 'Contraseña Inválida',
                    'La contraseña actual que ingresó es inválida.' );
            break;
            case "password_changed" :
                success_notification( 'Contraseña Cambiada',
                    'Su contraseña ha sido cambiada correctamente.' );
            break;
    };