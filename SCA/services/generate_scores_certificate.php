<?php
    require_once( '../cfg/constants.php' );
    require_once( '../utilities/Connector.php' );
    require_once( '../utilities/Normalizer.php' );
    require_once( 'DataGetter.php' );
    require_once( 'fpdf/fpdf.php' );


    session_start();
        
    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    $_SESSION[ 'student_data' ] = DataGetter::get_student_data( $_SESSION[ 'db_connection' ], $_COOKIE[ 'session_user' ] );
    $_SESSION[ 'course_averages' ] = DataGetter::get_averages_subject_list_by_student( $_SESSION[ 'db_connection' ], $_COOKIE[ 'session_user' ] );

    $names = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'nombres' ] );
    $first_name = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'apellido_paterno' ] );
    $last_name = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'apellido_materno' ] );
    $current_course = $_SESSION[ 'student_data' ][ 'curso_actual' ];

    if ( $current_course != NULL ) {
        $course = DataGetter::get_course_data( $_SESSION[ 'db_connection' ], $current_course );
        $level = $course[ 'grado' ] . "° " .  Normalizer::output_normalize_name( $course[ 'nivel' ] ) . " " . Normalizer::output_normalize_name( $course[ 'letra' ] );
    } else {
        $level = 'Estudiante sin matrícula';
    }

    $names_attorney = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'nombres_apoderado' ] );
    $first_name_attorney = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'nombres_apoderado' ] );
    $last_name_attorney = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'nombres_apoderado' ] );
    $phone_attorney = $_SESSION[ 'student_data' ][ 'fono_apoderado' ];
    $email_attorney = $_SESSION[ 'student_data' ][ 'email_apoderado' ];

    $run = Normalizer::output_normalize_run( $_SESSION[ 'student_data' ][ 'run' ] );
    $average = DataGetter::get_student_average_score_from_current_course( $_SESSION[ 'db_connection' ], $_SESSION[ 'student_data' ][ 'run' ] );

    $pdf = new FPDF();
$pdf->AddFont('Phalcon\Mvc\UrlInterface;rier','','courier.php');
$pdf->AddPage();
$pdf->SetFont('Courier','',12 );
    $pdf->Cell(0,10,'CERTIFICADO DE NOTAS');
    $pdf->Ln();
$pdf->Ln();

    $pdf->Ln();
    $pdf->Write(8, 'NOMBRES:'.$names );
    $pdf->Ln();
    $pdf->Write(8, 'APELLIDO PATERNO:'.$first_name );
    $pdf->Ln();
    $pdf->Write(8, 'APELLIDO MATERNO:'.$last_name );
    $pdf->Ln();
    $pdf->Write(8, 'CURSO:'.$level );
    $pdf->Ln();


    $pdf->Ln();

    $pdf->Write(8, 'ASIGNATURAS' );
    $pdf->Ln();

    foreach($_SESSION[ 'course_averages' ] as $row)
    {
        $pdf->Write(8, $row['nombre'] . ' ' . $row[ 'promedio'] );
        $pdf->Ln();
    }
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Write(8, 'PROMEDIO FINAL: ' . $average );
    $pdf->Ln();$pdf->Ln();
    $pdf->Write(8, date("d-m-Y (H:i:s)") );
    
 

$pdf->Output('cn-' . date("d-m-Y (H:i:s)") . '_' . $run . '.pdf', 'D');
?>