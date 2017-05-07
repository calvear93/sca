CREATE OR REPLACE FUNCTION existe_estudiante( run_estudiante text )
RETURNS boolean AS $$
    DECLARE
		tupla RECORD;
    BEGIN
		FOR tupla IN SELECT * FROM estudiante LOOP
			IF tupla.run = run_estudiante THEN
				RETURN TRUE;
			END IF;
		END LOOP;
		
		RETURN FALSE;
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION registrar_estudiante( run text, nombres text, apellido_paterno text, apellido_materno text, fono integer, email text, passwd text )
RETURNS text AS $$
	DECLARE
		id text;
    BEGIN
		INSERT INTO estudiante( run, nombres, apellido_paterno, apellido_materno, fono, email, passwd )
			VALUES ( run, nombres, apellido_paterno, apellido_materno, fono, email, passwd )
			RETURNING estudiante.run INTO id;
		RETURN id;		
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION editar_apoderado( run_estudiante text, run_a text, nombres_a text, apellido_paterno_a text, apellido_materno_a text, fono_a integer, email_a text )
RETURNS void AS $$
    BEGIN
		IF NOT existe_estudiante( run_estudiante ) THEN
			RAISE EXCEPTION '[EXCEPTION] Estudiante no existe.' USING ERRCODE = '26308';
		END IF;
		
		UPDATE estudiante SET run_apoderado = run_a, nombres_apoderado = nombres_a,
			apellido_paterno_apoderado = apellido_paterno_a, apellido_materno_apoderado = apellido_materno_a,
			fono_apoderado = fono_a, email_apoderado = email_a
		WHERE run = run_estudiante;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION editar_estudiante( run_estudiante text, n text, ap text, am text, f integer, e text )
RETURNS void AS $$
    BEGIN
		IF NOT existe_estudiante( run_estudiante ) THEN
			RAISE EXCEPTION '[EXCEPTION] Estudiante no existe!' USING ERRCODE = '26308';
		END IF;
		
		UPDATE estudiante SET nombres = n, apellido_paterno = ap, apellido_materno = am, fono = f, email = e
		WHERE run = run_estudiante;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION deshacer_registro_estudiante( run_estudiante text )
RETURNS void AS $$
    BEGIN
		IF NOT existe_estudiante( run_estudiante ) THEN
			RAISE EXCEPTION '[EXCEPTION] Estudiante no existe!' USING ERRCODE = '26308';
		END IF;
		
		DELETE FROM estudiante
		WHERE run = run_estudiante;		
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION matricular_estudiante_en_curso( run_estudiante text, curso bigint )
RETURNS void AS $$
    BEGIN
		IF NOT existe_estudiante( run_estudiante ) THEN
			RAISE EXCEPTION '[EXCEPTION] Estudiante no existe!' USING ERRCODE = '26308';
		END IF;
		
		IF NOT (
			SELECT curso_actual FROM estudiante
			WHERE run = run_estudiante
		) IS NULL THEN
			RAISE EXCEPTION '[EXCEPTION] Estudiante ya registra matricula!' USING ERRCODE = '26302';
		END IF;
		
		INSERT INTO lista_curso( run_estudiante, curso ) VALUES
			( run_estudiante, curso );
		UPDATE estudiante SET curso_actual = curso
		WHERE run = run_estudiante;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION desmatricular_estudiante_de_curso( run_e text )
RETURNS void AS $$
	DECLARE
		id_curso_actual bigint;
    BEGIN
		IF NOT existe_estudiante( run_e ) THEN
			RAISE EXCEPTION '[EXCEPTION] Estudiante no existe!' USING ERRCODE = '26308';
		END IF;
		
		SELECT curso_actual FROM estudiante INTO id_curso_actual
		WHERE run = run_e;
			
		IF id_curso_actual IS NULL THEN
			RAISE EXCEPTION '[EXCEPTION] Estudiante no registra matricula!' USING ERRCODE = '26301';
		END IF;
		
		DELETE FROM lista_curso
		WHERE run_estudiante = run_e AND curso = id_curso_actual;
		
		UPDATE estudiante SET curso_actual = NULL
		WHERE run = run_e;		
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION promedio_estudiante_asignatura( estudiante text, id_asignatura bigint )
RETURNS float AS $$
    BEGIN
		IF NOT existe_estudiante( estudiante ) THEN
			RAISE EXCEPTION '[EXCEPTION] Estudiante no existe!' USING ERRCODE = '26308';
		END IF;
		
		RETURN (
			SELECT AVG( valor ) FROM calificacion
			WHERE run_estudiante = estudiante AND asignatura = id_asignatura
		);
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION promedio_estudiante( run_e text )
RETURNS float AS $$
    BEGIN
		RETURN (
			SELECT AVG( promedio_estudiante_asignatura( run_e, id ) ) FROM asignatura
			WHERE curso = (
				SELECT curso_actual FROM estudiante
				WHERE run = run_e
			)
		);
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION promedio_estudiante_en_anio( run_e text, a integer )
RETURNS float AS $$
    BEGIN
		RETURN (
			SELECT promedio FROM lista_curso
			WHERE curso IN (
				SELECT id FROM curso
				WHERE anio = a
			) AND run_estudiante = run_e
		);
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION calcular_promedio_estudiante( run_e text )
RETURNS void AS $$
    BEGIN
		UPDATE lista_curso SET promedio = promedio_estudiante( run_e )
		WHERE run_estudiante = run_e AND curso = (
			SELECT curso_actual FROM estudiante
			WHERE run = run_e
		);
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION obtener_certificado_notas( run_e text )
RETURNS TABLE( asignatura bigint, nombre_asignatura text, promedio float ) AS $$
	BEGIN
		RETURN QUERY (
			SELECT id, nombre, promedio_estudiante_asignatura( run_e, id ) AS promedio FROM asignatura
			WHERE curso = (
				SELECT curso_actual FROM estudiante
				WHERE run = run_e
			) ORDER BY nombre
		);
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION obtener_certificado_notas_en_anio( run_e text, a integer )
RETURNS TABLE( asignatura bigint, nombre_asignatura text, promedio float ) AS $$
	BEGIN
		RETURN QUERY (
			SELECT id, nombre, promedio_estudiante_asignatura( run_e, id ) AS promedio FROM asignatura
			WHERE curso = (
				SELECT curso FROM lista_curso
				WHERE run_estudiante = run_e AND a = (
					SELECT anio FROM curso
					WHERE id = curso
				)
			) ORDER BY nombre
		);
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION verificar_password_estudiante( run_estudiante text, password text )
RETURNS boolean AS $$
    BEGIN
		RETURN password =(
			SELECT passwd FROM estudiante
			WHERE run = run_estudiante
		);
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION cambiar_password_estudiante( run_estudiante text, oldpassword text, newpassword text )
RETURNS void AS $$
    BEGIN
		IF NOT verificar_password_estudiante( run_estudiante, oldpassword ) THEN
			RAISE EXCEPTION '[EXCEPTION] Password invalida!' USING ERRCODE = '12403';
		END IF;
		UPDATE estudiante SET passwd = newpassword
		WHERE run = run_estudiante;
    END;
$$ LANGUAGE PLPGSQL;