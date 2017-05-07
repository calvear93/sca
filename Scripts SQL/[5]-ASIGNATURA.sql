CREATE OR REPLACE FUNCTION unicidad_asignatura( )
RETURNS trigger AS $$
	DECLARE
		tupla record;
		counter int;
	BEGIN
		counter = 0;
		IF ( TG_OP = 'UPDATE' ) THEN
			FOR tupla IN SELECT * FROM asignatura LOOP
				IF counter > 1 THEN
					RAISE EXCEPTION '[EXCEPTION] Asignatura ya existe!' USING ERRCODE = '23505';
				END IF;
				IF tupla.nombre = NEW.nombre AND tupla.curso = NEW.curso THEN
					counter = counter + 1;
				END IF;
			END LOOP;
			RETURN NEW;
		END IF;
		
		FOR tupla IN SELECT * FROM asignatura LOOP
			IF tupla.nombre = NEW.nombre AND tupla.curso = NEW.curso THEN
				RAISE EXCEPTION '[EXCEPTION] Asignatura ya existe!' USING ERRCODE = '23505';
			END IF;
		END LOOP;

		RETURN NEW;
	END;
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER verificar_unicidad_asignatura
	BEFORE INSERT OR UPDATE ON asignatura
	FOR EACH ROW EXECUTE PROCEDURE unicidad_asignatura( );
	
CREATE OR REPLACE FUNCTION registrar_asignatura( nombre text, descripcion text, curso bigint )
RETURNS integer AS $$
	DECLARE
		id_asignatura bigint;
    BEGIN
		INSERT INTO asignatura( nombre, descripcion, curso )
			VALUES ( nombre, descripcion, curso )
			RETURNING id INTO id_asignatura;
		RETURN id_asignatura;		
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION existe_asignatura( id_a bigint )
RETURNS boolean AS $$
    DECLARE
		tupla RECORD;
    BEGIN
		FOR tupla IN SELECT * FROM asignatura LOOP
			IF tupla.id = id_a THEN
				RETURN TRUE;
			END IF;
		END LOOP;
		
		RETURN FALSE;
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION editar_asignatura( id_asignatura bigint, n text, d text )
RETURNS void AS $$
    BEGIN
		IF NOT existe_asignatura( id_asignatura ) THEN
			RAISE EXCEPTION '[EXCEPTION] Asignatura no existe.' USING ERRCODE = '16258';
		END IF;
		
		UPDATE asignatura SET nombre = n, descripcion = d
		WHERE id = id_asignatura;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION deshacer_registro_asignatura( id_asignatura bigint )
RETURNS void AS $$
    BEGIN
		IF NOT existe_asignatura( id_asignatura ) THEN
			RAISE EXCEPTION '[EXCEPTION] Asignatura no existe.' USING ERRCODE = '16258';
		END IF;
		
		DELETE FROM asignatura
		WHERE id = id_asignatura;		
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION vincular_profesor_asignatura( run_p text, id_asignatura bigint )
RETURNS void AS $$
    BEGIN
		IF NOT existe_profesor( run_p ) THEN
			RAISE EXCEPTION '[EXCEPTION] Profesor no existe!' USING ERRCODE = '22308';
		END IF;
		
		IF NOT existe_asignatura( id_asignatura ) THEN
			RAISE EXCEPTION '[EXCEPTION] Asignatura no existe.' USING ERRCODE = '16258';
		END IF;
		
		IF NOT (
			SELECT habilitado FROM profesor
			WHERE run = run_p
		) THEN
			RAISE EXCEPTION '[EXCEPTION] Profesor esta inhabilitado!' USING ERRCODE = '22112';
		END IF;
		
		IF NOT (
			SELECT run_profesor FROM asignatura
			WHERE id = id_asignatura
		) IS NULL THEN
			RAISE EXCEPTION '[EXCEPTION] Asignatura ya tiene profesor!' USING ERRCODE = '27204';
		END IF;
		
		UPDATE asignatura SET run_profesor = run_p
		WHERE id = id_asignatura;	
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION desvincular_profesor_asignatura( id_asignatura bigint )
RETURNS void AS $$
    BEGIN
		IF NOT existe_asignatura( id_asignatura ) THEN
			RAISE EXCEPTION '[EXCEPTION] Asignatura no existe.' USING ERRCODE = '16258';
		END IF;
		
		UPDATE asignatura SET run_profesor = NULL
		WHERE id = id_asignatura;	
    END;
$$ LANGUAGE PLPGSQL;