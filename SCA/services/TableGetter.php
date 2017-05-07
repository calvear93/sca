<?php
require_once( '../cfg/constants.php' );
require_once( '../utilities/Connector.php' );
require_once( 'DataGetter.php' );
class TableGetter {
    
    private $connection;

    function __construct() {
        $this->connection = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );
    }

    private function save_list( $filename, $list ) {
        file_put_contents( '../data/' . $filename . '.table', json_encode( $list ) );
        return '../data/' . $filename . '.table';
    }

    // Courses data.
    function save_course_list_by_year( $year ) {
        $result = DataGetter::get_course_list_by_year( $this->connection, $year );
        return $this->save_list( 'course_list' . $year, $result );
    }

    function save_course_list() {
        $result = DataGetter::get_course_list( $this->connection );
        return $this->save_list( 'course_list', $result );
    }

    // Subjects data.
    function save_subject_list_without_teacher() {
        $result = DataGetter::get_subject_list_without_teacher( $this->connection );
        return $this->save_list( 'subject_list_without_teacher-', $result );
    }

    function save_subject_list_by_course( $course ) {
        $result = DataGetter::get_subject_list_by_course( $this->connection, $course );
        return $this->save_list( 'subject_list_course-' . $course, $result );
    }

    function save_subject_list_by_teacher( $run_teacher ) {
        $result = DataGetter::get_subject_list_by_teacher( $this->connection, $run_teacher );
        return $this->save_list( 'subject_list_teacher-' . $run_teacher, $result );
    }

    // Students data.
    function save_student_list() {
        $result = DataGetter::get_student_list( $this->connection );
        return $this->save_list( 'student_list', $result );
    }

    function save_student_list_by_course( $course ) {
        $result = DataGetter::get_student_list_by_course( $this->connection, $course );
        return $this->save_list( 'student_list_course-' . $course, $result );
    }

    function save_student_list_by_subject( $subject ) {
        $result = DataGetter::get_student_list_by_subject( $this->connection, $subject );
        return $this->save_list( 'student_list_subject-' . $subject, $result );
    }

    // Teachers data.
    function save_teacher_list() {
        $result = DataGetter::get_teacher_list( $this->connection );
        return $this->save_list( 'teacher_list', $result );
    }
    
    function save_teacher_list_disabled() {
        $result = DataGetter::get_teacher_list( $this->connection, 'FALSE' );
        return $this->save_list( 'teacher_list_disabled', $result );
    }

    function save_teacher_list_by_course( $course ) {
        $result = DataGetter::get_teacher_list_by_course( $this->connection, $course );
        return $this->save_list( 'teacher_list_course-' . $course, $result );
    }

    // Scores data.
    function save_score_list_of_student_by_subject( $run_student, $subject ) {
        $result = DataGetter::get_score_list_of_student_by_subject( $this->connection, $run_student, $subject );
        return $this->save_list( 'score_list_student-' . $run_student . '_subject-' . $subject, $result );
    }

    function save_score_list_by_student( $run_student ) {
        $result = DataGetter::get_score_list_by_student( $this->connection, $run_student );
        return $this->save_list( 'score_list_-' . $run_student, $result );
    }

    // Exams data.
    function save_exams_list_by_teacher( $run_teacher ) {
        $result = DataGetter::get_exam_list_by_teacher( $this->connection, $run_teacher );
        return $this->save_list( 'exam_list_-' . $run_teacher, $result );
    }

    function save_exams_list_by_course( $course ) {
        $result = DataGetter::get_exam_list_by_course( $this->connection, $course );
        return $this->save_list( 'exam_list_-' . $course, $result );
    }

    // Historical data.
    function save_historical_subject_list_by_teacher( $run_teacher ) {
        $result = DataGetter::get_historical_subject_list_by_teacher( $this->connection, $run_teacher );
        return $this->save_list( 'historical_subject_list_teacher-' . $run_teacher, $result );
    }

    function save_historical_exam_list_by_course( $course ) {
        $result = DataGetter::get_historical_exam_list_by_course( $this->connection, $course );
        return $this->save_list( 'historical_exam_list_course-' . $course, $result );
    }

    function save_historical_exam_list_by_teacher( $run_teacher ) {
        $result = DataGetter::get_historical_exam_list_by_teacher( $this->connection, $run_teacher );
        return $this->save_list( 'historical_exam_list_teacher-' . $run_teacher, $result );
    }
}
?>