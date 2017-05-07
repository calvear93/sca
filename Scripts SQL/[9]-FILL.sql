
SELECT registrar_curso( 'j', 4, 'medio' );
SELECT registrar_curso( 'd', 7, 'basico' );
SELECT registrar_curso( 'z', 2, 'medio' );
SELECT registrar_curso( 'a', 3, 'medio' );
SELECT registrar_curso( 'b', 1, 'medio' );
SELECT registrar_curso( 'c', 7, 'basico' );
SELECT registrar_curso( 'd', 1, 'medio' );
SELECT registrar_curso( 'e', 3, 'medio' );
SELECT registrar_curso( 'm', 2, 'medio' );

SELECT editar_curso( 3, 2012, 'z', 2, 'medio' );
SELECT editar_curso( 5, 2014, 'b', 1, 'basico' );

SELECT registrar_estudiante( '18489730k', 'cristopher alejandro', 'alvear', 'candia', 92641781, 'crialvea@alumnos.ubiobio.cl', '123');
SELECT registrar_estudiante( '170497503', 'juan alberto', 'machuca', 'mendez', 65489584, 'juan@correo.cl', '123');
SELECT registrar_estudiante( '227113194', 'daniel ignacio', 'castro', 'gutierrez', 13464859, 'dani@correo.cl', '123');
SELECT registrar_estudiante( '209200285', 'esteban fernando', 'suarez', 'jiménez', 85783545, 'estebita@correo.cl', '123');
SELECT registrar_estudiante( '238631905', 'brayatan erick', 'perez', 'gonzalez', 64876521, 'el.brayatan@correo.cl', '123');
SELECT registrar_estudiante( '173795623', 'enriqueta angelica', 'jimenez', 'vergara', 24576898, 'enrica@correo.cl', '123');
SELECT registrar_estudiante( '114964894', 'branco gote', 'far', 'ponce', 65872198, 'branquito@correo.cl', '123');
SELECT registrar_estudiante( '136250935', 'elias miguel', 'fuentes', 'cerda', 95425124, 'elias.miguel@correo.cl', '123');

SELECT editar_apoderado( '18489730k', '17401372', 'jaime manuel', 'alvear', 'corvalán', 416455, 'apoderado@correo.cl' );

SELECT matricular_estudiante_en_curso( '18489730k', 1 );
SELECT matricular_estudiante_en_curso( '170497503', 1 );
SELECT matricular_estudiante_en_curso( '227113194', 2 );
SELECT matricular_estudiante_en_curso( '238631905', 3 );
SELECT matricular_estudiante_en_curso( '136250935', 3 );

SELECT registrar_profesor( '13268517k', 'marta veronica', 'candia', 'cerda', 65470084, 'marta@correo.cl', 'pedagogia en educación básica', '123');
SELECT registrar_profesor( '14506957k', 'juan de las mercedes', 'perez', 'gamboa', 89305094, 'don.juan@correo.cl', 'ingenieria en dar ejemplos', '123');
SELECT registrar_profesor( '16551728k', 'yoselyn solange', 'arancibia', 'basoalto', 66919473, 'layose@correo.cl', 'algo estudio', '123');
SELECT registrar_profesor( '17499324k', 'esmeralda rubí', 'silver', 'forest', 23940271, 'rubi_silver@correo.cl', 'ingenieria civil', '123');

SELECT deshabilitar_profesor( '16551728' );

SELECT registrar_asignatura( 'lenguaje y comunicacion', 'no', 1 );
SELECT registrar_asignatura( 'matematicas', 'no', 1 );
SELECT registrar_asignatura( 'vagologia', 'no', 1 );
SELECT registrar_asignatura( 'ingenieria de software', 'no', 1 );
SELECT registrar_asignatura( 'educacion fisica', 'no', 2 );
SELECT registrar_asignatura( 'matematicas', 'no', 2 );
SELECT registrar_asignatura( 'lenguaje y comunicacion', 'no', 3 );
SELECT registrar_asignatura( 'ciencias', 'no', 3 );

SELECT vincular_profesor_asignatura( '13268517k', 1 );
SELECT vincular_profesor_asignatura( '13268517k', 4 );
SELECT vincular_profesor_asignatura( '14506957k', 2 );
SELECT vincular_profesor_asignatura( '14506957k', 3 );
SELECT vincular_profesor_asignatura( '14506957k', 5 );
SELECT vincular_profesor_asignatura( '17499324k', 6 );
SELECT vincular_profesor_asignatura( '17499324k', 7 );

SELECT registrar_evaluacion( 'nada por aquí', '2015-11-5', '14:10', '15:30', 1 );
SELECT registrar_evaluacion( 'nada por aquí', '2015-12-11', '14:10', '15:30', 1 );
SELECT registrar_evaluacion( 'nada por aquí', '2015-12-23', '14:10', '15:30', 2 );
SELECT registrar_evaluacion( 'nada por aquí', '2015-11-17', '14:10', '15:30', 3 );
SELECT registrar_evaluacion( 'nada por aquí', '2015-9-9', '14:10', '15:30', 1 );
SELECT registrar_evaluacion( 'nada por aquí', '2015-10-2', '14:10', '15:30', 4 );
SELECT registrar_evaluacion( 'nada por aquí', '2015-10-11', '14:10', '15:30', 4 );

SELECT registrar_calificacion( 7.0, 'sin descripcion', '18489730k', 1 );
SELECT registrar_calificacion( 5.0, 'sin descripcion', '18489730k', 1 );
SELECT registrar_calificacion( 5.3, 'sin descripcion','18489730k', 1 );
SELECT registrar_calificacion( 5.8, 'sin descripcion', '18489730k', 2 );
SELECT registrar_calificacion( 5.9, 'sin descripcion', '170497503', 1 );
SELECT registrar_calificacion( 6.7, 'sin descripcion', '170497503', 1 );


