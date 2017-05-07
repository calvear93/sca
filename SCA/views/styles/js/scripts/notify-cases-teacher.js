    switch( get_cookie( 'session_state' ) ) {
            case "exam_registered" :
                success_notification( 'Registro Satisfactorio',
                    'El registro de la evaluación se ha realizado correctamente.' );
            break;
            case "exam_duplicated" :
                danger_notification( 'Registro Fallido',
                    'El curso ya tiene una evaluación ese día.' );
            break;
            case "exam_edited" :
                success_notification( 'Edición Satisfactoria',
                    'La evaluación se ha editado correctamente.' );
            break;
            case "exam_canceled" :
                success_notification( 'Cancelación Satisfactoria',
                    'La evaluación se ha cancelado correctamente.' );
            break;
            case "score_registered" :
                success_notification( 'Registro Satisfactorio',
                    'La calificación se ha registrado correctamente.' );
            break;
            case "score_edited" :
                success_notification( 'Edición Satisfactoria',
                    'La calificación se ha editado correctamente.' );
            break;
            case "score_deleted" :
                success_notification( 'Eliminación Satisfactoria',
                    'La calificación se ha eliminado correctamente.' );
            break;
            case "wrong_password" :
                danger_notification( 'Contraseña Inválida',
                    'La contraseña actual que ingresó es inválida.' );
            break;
            case "password_changed" :
                success_notification( 'Contraseña Cambiada',
                    'Su contraseña ha sido cambiada correctamente.' );
            break;
    };