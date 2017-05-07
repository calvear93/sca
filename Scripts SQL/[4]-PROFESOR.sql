CREATE OR REPLACE FUNCTION existe_profesor( run_profesor text )
RETURNS boolean AS $$
    DECLARE
		tupla RECORD;
    BEGIN
		FOR tupla IN SELECT * FROM profesor LOOP
			IF tupla.run = run_profesor THEN
				RETURN TRUE;
			END IF;
		END LOOP;
		
		RETURN FALSE;
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION registrar_profesor( run text, nombres text, apellido_paterno text, apellido_materno text, fono integer, email text, titulo text, passwd text )
RETURNS text AS $$
	DECLARE
		id text;
    BEGIN
		INSERT INTO profesor( run, nombres, apellido_paterno, apellido_materno, fono, email, titulo, passwd )
			VALUES ( run, nombres, apellido_paterno, apellido_materno, fono, email, titulo, passwd )
			RETURNING profesor.run INTO id;
		RETURN id;		
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION editar_profesor( run_profesor text, n text, ap text, am text, f integer, e text, t text )
RETURNS void AS $$
    BEGIN
		IF NOT existe_profesor( run_profesor ) THEN
			RAISE EXCEPTION '[EXCEPTION] Profesor no existe!' USING ERRCODE = '22308';
		END IF;
		
		UPDATE profesor SET nombres = n, apellido_paterno = ap,
			apellido_materno = am, fono = f, email = e, titulo = t
		WHERE run = run_profesor;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION deshacer_registro_profesor( run_profesor text )
RETURNS void AS $$
    BEGIN
		IF NOT existe_profesor( run_profesor ) THEN
			RAISE EXCEPTION '[EXCEPTION] Profesor no existe!' USING ERRCODE = '22308';
		END IF;
		
		DELETE FROM profesor
		WHERE run = run_profesor;		
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION imparte_asignaturas_actualmente( run_p text )
RETURNS boolean AS $$
    BEGIN
		RETURN (
			SELECT COUNT( * ) FROM asignatura
			WHERE run_profesor = run_p AND curso IN (
				SELECT id FROM curso
				WHERE anio = EXTRACT( YEAR FROM current_date )
			)
		) > 0;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION habilitar_profesor( run_profesor text )
RETURNS void AS $$
    BEGIN
		IF (
			SELECT habilitado FROM profesor
			WHERE run = run_profesor
		) THEN
			RAISE EXCEPTION '[EXCEPTION] Profesor ya esta habilitado!' USING ERRCODE = '22113';
		END IF;
		
		IF NOT existe_profesor( run_profesor ) THEN
			RAISE EXCEPTION '[EXCEPTION] Profesor no existe!' USING ERRCODE = '22308';
		END IF;
		
		UPDATE profesor SET habilitado = TRUE
		WHERE run = run_profesor;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION deshabilitar_profesor( run_profesor text )
RETURNS void AS $$
    BEGIN
		IF NOT (
			SELECT habilitado FROM profesor
			WHERE run = run_profesor
		) THEN
			RAISE EXCEPTION '[EXCEPTION] Profesor no esta habilitado!' USING ERRCODE = '22112';
		END IF;
		
		IF imparte_asignaturas_actualmente( run_profesor ) THEN
			RAISE EXCEPTION '[EXCEPTION] Profesor imparte asignaturas actualmente!' USING ERRCODE = '22318';
		END IF;
		
		IF NOT existe_profesor( run_profesor ) THEN
			RAISE EXCEPTION '[EXCEPTION] Profesor no existe!' USING ERRCODE = '22308';
		END IF;
		
		UPDATE profesor SET habilitado = FALSE
		WHERE run = run_profesor;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION verificar_password_profesor( run_profesor text, password text )
RETURNS boolean AS $$
    BEGIN
		RETURN password =(
			SELECT passwd FROM profesor
			WHERE run = run_profesor
		);
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION cambiar_password_profesor( run_profesor text, oldpassword text, newpassword text )
RETURNS void AS $$
    BEGIN
		IF NOT verificar_password_profesor( run_profesor, oldpassword ) THEN
			RAISE EXCEPTION '[EXCEPTION] Password invalida!' USING ERRCODE = '12403';
		END IF;
		UPDATE profesor SET passwd = newpassword
		WHERE run = run_profesor;
    END;
$$ LANGUAGE PLPGSQL;