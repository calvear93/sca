    switch( get_cookie( 'session_state' ) ) {
            case "student_registered" :
                success_notification( 'Registro Satisfactorio',
                    'El registro del estudiante se ha realizado correctamente.' );
            break;
            case "student_duplicated_key" :
                danger_notification( 'Registro Fallido',
                    'El registro del estudiante ya existe en el sistema.' );
            break;
            case "teacher_registered" :
                success_notification( 'Registro Satisfactorio',
                    'El registro del profesor se ha realizado correctamente.' );
            break;
            case "teacher_duplicated_key" :
                danger_notification( 'Registro Fallido',
                    'El registro del profesor ya existe en el sistema.' );
            break;
            case "course_registered" :
                success_notification( 'Registro Satisfactorio',
                    'El registro del curso se ha realizado correctamente.' );
            break;
            case "course_duplicated_key" :
                danger_notification( 'Registro Fallido',
                    'El registro del curso ya existe en el sistema.' );
            break;
            case "subject_registered" :
                success_notification( 'Registro Satisfactorio',
                    'El registro de la asignatura se ha realizado correctamente.' );
            break;
            case "subject_duplicated_key" :
                danger_notification( 'Registro Fallido',
                    'El registro de la asignatura ya existe en el sistema.' );
            break;
            case "last_teacher_register_deleted" :
                success_notification( 'Eliminación Satisfactoria',
                    'El registro del profesor se ha eliminado correctamente.' );
            break;
            case "last_teacher_register_invalid" :
                warning_notification( 'Registro Inválido',
                    'No se encuentra un registro de profesor válido para eliminar.' );
            break;
            case "last_student_register_deleted" :
                success_notification( 'Eliminación Satisfactoria',
                    'El registro del estudiante se ha eliminado correctamente.' );
            break;
            case "last_student_register_invalid" :
                warning_notification( 'Registro Inválido',
                    'No se encuentra un registro de estudiante válido para eliminar.' );
            break;
            case "last_course_register_deleted" :
                success_notification( 'Eliminación Satisfactoria',
                    'El registro del curso se ha eliminado correctamente.' );
            break;
            case "last_course_register_invalid" :
                warning_notification( 'Registro Inválido',
                    'No se encuentra un registro de curso válido para eliminar.' );
            break;
            case "last_subject_register_deleted" :
                success_notification( 'Eliminación Satisfactoria',
                    'El registro de la asignatura se ha eliminado correctamente.' );
            break;
            case "last_subject_register_invalid" :
                warning_notification( 'Registro Inválido',
                    'No se encuentra un registro de la asignatura válido para eliminar.' );
            break;
            case "course_edited" :
                success_notification( 'Edición Satisfactoria',
                    'El registro del curso se ha editado correctamente.' );
            break;
            case "course_duplicated_key_on_edit" :
                warning_notification( 'Edición Inválida',
                    'Los nuevos datos del registro del curso ya existen en el sistema.' );
            break;
            case "subject_duplicated_key" :
                warning_notification( 'Edición Inválida',
                    'Los nuevos datos del registro de la asignatura ya existen en el sistema.' );
            break;
            case "student_edited" :
                success_notification( 'Edición Satisfactoria',
                    'El registro del estudiante se ha editado correctamente.' );
            break;
            case "teacher_edited" :
                success_notification( 'Edición Satisfactoria',
                    'El registro del profesor se ha editado correctamente.' );
            break;
            case "subject_edited" :
                success_notification( 'Edición Satisfactoria',
                    'El registro de la asignatura se ha editado correctamente.' );
            break;
            case "enroll_student_already" :
                warning_notification( 'Matrícula Inválida',
                    'El estudiante ya registra una matrícula actual en el sistema.' );
            break;
            case "enroll_student" :
                success_notification( 'Matrícula Satisfactoria',
                    'El estudiante se ha matriculado en el curso correctamente.' );
            break;
            case "unenroll_student" :
                success_notification( 'Anulación de Matrícula Satisfactoria',
                    'La matrícula del estudiante se ha anulado correctamente.' );
            break;
            case "unenroll_student_yet" :
                warning_notification( 'Anulación de Matrícula Inválida',
                    'El estudiante no registra una matrícula actual en el sistema.' );
            break;
            case "teacher_enabled" :
                success_notification( 'Habilitación Satisfactoria',
                    'El profesor se ha habilitado correctamente.' );
            break;
            case "teacher_enabled_already" :
                warning_notification( 'Habilitación Inválida',
                    'El profesor ya está habilitado en el sistema.' );
            break;
            case "teacher_disabled" :
                success_notification( 'Inhabilitación Satisfactoria',
                    'El profesor se ha inhabilitado correctamente.' );
            break;
            case "teacher_belong_to_subject" :
                warning_notification( 'Inhabilitación Inválida',
                    'El profesor está vinculado a una asignatura en el sistema.' );
            break;
            case "teacher_linked" :
                success_notification( 'Vinculación Satisfactoria',
                    'El profesor se ha vinculado a la asignatura correctamente.' );
            break;
            case "subject_unlinked" :
                success_notification( 'Desvinculación Satisfactoria',
                    'El profesor se ha desvinculado de la asignatura correctamente.' );
            break;
            case "teacher_subject_has_teacher" :
                warning_notification( 'Vinculación Inválida',
                    'La asignatura ya tiene vinculado a un profesor en el sistema.' );
            break;
            case "teacher_disabled_link" :
                warning_notification( 'Vinculación Inválida',
                    'El profesor está inhabilitado en el sistema.' );
            break;
    };