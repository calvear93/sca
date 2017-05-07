<?php
require_once( '../utilities/exceptions/ForeignKeyException.php' );
require_once( '../utilities/exceptions/StudentDoesntExistsException.php' );
class DataGetter {
    static function get_list( $connector, $table_name, $attributes = '*', $sql_condition = '' ) {
        return $connector->get_matrix_from_table( $table_name, PGSQL_ASSOC, $attributes, $sql_condition );
    }

    // Level information.
    static function get_level_list( $connector ) {
        return self::get_list( $connector, 'nivel' );
    }

    // Course information.
    static function get_course_list_by_year( $connector, $year ) {
        return self::get_list( $connector, 'curso', '*',
            "WHERE anio = $year ORDER BY anio" );
    }

    static function get_course_list( $connector ) {
        return self::get_course_list_by_year( $connector, date( 'Y' ) );
    }

    // Subject information.
    static function get_subject_list_by_course( $connector, $course ) {
        return self::get_list( $connector, 'asignatura', '*', "WHERE curso = $course ORDER BY nombre" );
    }

    static function get_subject_list_by_teacher( $connector, $run_teacher ) {
        return self::get_list( $connector, 'asignatura', '*', "WHERE run_profesor = '$run_teacher' 
            AND curso IN ( SELECT id FROM curso WHERE anio = EXTRACT( YEAR FROM current_date ) ) ORDER BY nombre" );
    }

    static function get_subject_list_without_teacher( $connector ) {
        return self::get_list( $connector, 'asignatura', '*', "WHERE run_profesor IS NULL 
            AND curso IN ( SELECT id FROM curso WHERE anio = EXTRACT( YEAR FROM current_date ) ) ORDER BY nombre" );
    }

    // Exams information.
    static function get_exam_list_by_course( $connector, $course ) {
        return self::get_list( $connector, 'evaluacion', '*',
            "WHERE asignatura IN ( SELECT id FROM asignatura WHERE curso = $course ) 
            AND fecha >= current_date ORDER BY fecha" );
    }

    static function get_exam_list_by_teacher( $connector, $run_teacher ) {
        return self::get_list( $connector, 'evaluacion', '*',
            "WHERE asignatura IN ( SELECT id FROM asignatura WHERE run_profesor = '$run_teacher' )
            AND fecha >= current_date ORDER BY fecha" );
    }
    
    // Student information.
    static function get_student_list( $connector ) {
        return self::get_list( $connector, 'estudiante',
            'run, nombres, apellido_paterno, apellido_materno, fono, email,
            run_apoderado, nombres_apoderado, apellido_paterno_apoderado, apellido_materno_apoderado,
            fono_apoderado, email_apoderado, curso_actual',
            "ORDER BY run, apellido_paterno, apellido_materno, nombres" );
    }

    static function get_student_list_by_course( $connector, $course ) {
        return self::get_list( $connector, 'estudiante',
            'run, nombres, apellido_paterno, apellido_materno, fono, email,
            run_apoderado, nombres_apoderado, apellido_paterno_apoderado, apellido_materno_apoderado,
            fono_apoderado, email_apoderado, curso_actual',
            "WHERE curso_actual = $course ORDER BY run, apellido_paterno, apellido_materno, nombres" );
    }

    static function get_student_list_by_subject( $connector, $subject ) {
        return self::get_list( $connector, 'estudiante',
            'run, nombres, apellido_paterno, apellido_materno, fono, email,
            run_apoderado, nombres_apoderado, apellido_paterno_apoderado, apellido_materno_apoderado,
            fono_apoderado, email_apoderado, curso_actual',
            "WHERE curso_actual = ( SELECT curso FROM asignatura WHERE id = $subject ) 
            ORDER BY run, apellido_paterno, apellido_materno, nombres" );
    }

    static function get_student_average_score_by_subject( $connector, $run_student, $subject ) {
        try {
            return pg_fetch_result( $connector->inject_smart_query(
                "SELECT promedio_estudiante_asignatura( '$run_student', $subject );" ), 0, 0 );
        } catch ( StudentDoesntExistsException $e ) {
            echo $e->getMessage();
        } catch ( ForeignKeyException $e ) {
            echo $e->getMessage();
        }
    }

    static function get_student_average_score_from_current_course( $connector, $run_student ) {
        try {
            return pg_fetch_result( $connector->inject_smart_query(
                "SELECT promedio_estudiante( '$run_student' );" ), 0, 0 );
        } catch ( StudentDoesntExistsException $e ) {
            echo $e->getMessage();
        }
    }

    static function get_averages_list_by_course( $connector, $course ) {
        $array = [];
        $result = $connector->inject_query( "SELECT run, (
            SELECT promedio FROM lista_curso
            WHERE run = run_estudiante AND curso = curso_actual ) as promedio
            FROM estudiante WHERE curso_actual = $course;" );
        while( $row = pg_fetch_array( $result, NULL, PGSQL_ASSOC ) )
            array_push( $array, $row );
        return $array;
    }

    static function get_averages_subject_list_by_student( $connector, $run_student ) {
        $array = [];
        $result = $connector->inject_query( "SELECT nombre,
            COALESCE( promedio_estudiante_asignatura( '$run_student', id ), 0 ) as promedio
            FROM asignatura WHERE curso = (
                SELECT curso_actual FROM estudiante
                WHERE run = '$run_student'
            );" );
        while( $row = pg_fetch_array( $result, NULL, PGSQL_ASSOC ) )
            array_push( $array, $row );
        return $array;
    }
    
    // Teacher information.
    static function get_teacher_list( $connector, $state = 'TRUE' ) {
        return self::get_list( $connector, 'profesor',
            'run, nombres, apellido_paterno, apellido_materno, fono, email, titulo',
            "WHERE habilitado = $state ORDER BY apellido_paterno, apellido_materno, nombres" );
    }

    static function get_teacher_list_by_course( $connector, $course ) {
        return self::get_list( $connector, 'profesor',
            'run, nombres, apellido_paterno, apellido_materno, fono, email, titulo',
            "WHERE run IN ( SELECT run_profesor FROM asignatura WHERE curso = $course ) 
            ORDER BY apellido_paterno, apellido_materno, nombres" );
    }

    // Score information.
    static function get_score_list_by_course( $connector, $course ) {
        return self::get_list( $connector, 'calificacion', '*',
            "WHERE asignatura IN ( SELECT id FROM asignatura WHERE curso = $course ) ORDER BY fecha" );
    }

    static function get_score_list_of_student_by_subject( $connector, $run_student, $subject ) {
        return self::get_list( $connector, 'calificacion', '*',
            "WHERE asignatura = $subject AND run_estudiante = '$run_student' ORDER BY fecha" );
    }

    static function get_score_list_by_student( $connector, $run_student ) {
        return self::get_list( $connector, 'calificacion', '*',
            "WHERE asignatura IN ( SELECT id FROM asignatura WHERE curso = (
                SELECT curso_actual FROM estudiante 
                WHERE run = '$run_student' ) ) ORDER BY fecha" );
    }

    // Individual information.
    static function get_data( $connector, $table_name, $attributes = '*', $sql_condition = '' ) {
        return $connector->get_row_from_table( $table_name, 0, PGSQL_ASSOC, $attributes, $sql_condition );
    }
    
    static function get_student_data( $connector, $run ) {
        return self::get_data( $connector, 'estudiante',
            'run, nombres, apellido_paterno, apellido_materno, fono, email,
            run_apoderado, nombres_apoderado, apellido_paterno_apoderado, apellido_materno_apoderado,
            fono_apoderado, email_apoderado, curso_actual',
            "WHERE run = '$run'" );
    }
    
    static function get_teacher_data( $connector, $run ) {
        return self::get_data( $connector, 'profesor',
            'run, nombres, apellido_paterno, apellido_materno, fono, email, titulo, habilitado',
            "WHERE run = '$run'" );
    }
    
    static function get_course_data( $connector, $id ) {
        return self::get_data( $connector, 'curso', '*', "WHERE id = $id" );
    }
    
    static function get_subject_data( $connector, $id ) {
        return self::get_data( $connector, 'asignatura', '*', "WHERE id = $id" );
    }

    static function get_exam_data( $connector, $id ) {
        return self::get_data( $connector, 'evaluacion', '*', "WHERE id = $id" );
    }

    static function get_score_data( $connector, $id ) {
        return self::get_data( $connector, 'calificacion', '*', "WHERE id = $id" );
    }

    // Historical data.
    static function get_historical_subject_list_by_teacher( $connector, $run_teacher ) {
        return self::get_list( $connector, 'asignatura', '*', "WHERE run_profesor = '$run_teacher' 
            AND curso IN ( SELECT id FROM curso WHERE anio < EXTRACT( YEAR FROM current_date ) ) ORDER BY nombre" );
    }

    static function get_historical_course_list( $connector, $run_teacher ) {
        return self::get_list( $connector, 'asignatura', '*', "WHERE run_profesor = '$run_teacher' 
            AND curso IN ( SELECT id FROM curso WHERE anio < EXTRACT( YEAR FROM current_date ) ) ORDER BY nombre" );
    }

    static function get_historical_exam_list_by_course( $connector, $course ) {
        return self::get_list( $connector, 'evaluacion', '*',
            "WHERE asignatura IN ( SELECT id FROM asignatura WHERE curso = $course ) 
            AND fecha < current_date ORDER BY fecha" );
    }

    static function get_historical_exam_list_by_teacher( $connector, $run_teacher ) {
        return self::get_list( $connector, 'evaluacion', '*',
            "WHERE asignatura IN ( SELECT id FROM asignatura WHERE run_profesor = '$run_teacher' )
            AND fecha < current_date ORDER BY fecha" );
    }
}
?>