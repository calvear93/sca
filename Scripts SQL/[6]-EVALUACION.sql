CREATE OR REPLACE FUNCTION existe_otra_evaluacion( fecha date, id_evaluacion bigint, id_curso bigint )
RETURNS boolean AS $$
    DECLARE
		tupla record;
    BEGIN
		FOR tupla IN SELECT * FROM evaluacion LOOP
			IF tupla.id != id_evaluacion THEN
				IF tupla.fecha = fecha AND curso_de_evaluacion( tupla.id ) = id_curso THEN
					RETURN TRUE;
				END IF;
			END IF;
		END LOOP;
		
		RETURN FALSE;
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION existe_evaluacion( id_e bigint )
RETURNS boolean AS $$
    DECLARE
		tupla RECORD;
    BEGIN
		FOR tupla IN SELECT * FROM evaluacion LOOP
			IF tupla.id = id_e THEN
				RETURN TRUE;
			END IF;
		END LOOP;
		
		RETURN FALSE;
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION curso_de_evaluacion( id_evaluacion bigint )
RETURNS bigint AS $$
    BEGIN
		RETURN (
			SELECT curso FROM asignatura
			WHERE id = (
				SELECT asignatura FROM evaluacion
				WHERE id = id_evaluacion
			)
		);
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION registrar_evaluacion( descripcion text, fecha date, hora_inicio time, hora_termino time, id_asignatura bigint )
RETURNS void AS $$
	DECLARE
		id_curso bigint;
    BEGIN		
		SELECT curso FROM asignatura INTO id_curso
		WHERE id = id_asignatura;
		
		IF existe_otra_evaluacion( fecha, NULL, id_curso ) THEN
			RAISE EXCEPTION '[EXCEPTION] Ya hay otra evaluacion ese dia!' USING ERRCODE = '21540';
		END IF;
		
		INSERT INTO evaluacion( descripcion, fecha, inicio, termino, asignatura )
			VALUES ( descripcion, fecha, hora_inicio, hora_termino, id_asignatura );
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION editar_evaluacion( id_evaluacion bigint, d text, f date, i time, t time )
RETURNS void AS $$
    BEGIN		
		IF existe_otra_evaluacion( f, id_evaluacion, curso_de_evaluacion( id_evaluacion ) ) THEN
			RAISE EXCEPTION '[EXCEPTION] Ya hay otra evaluacion ese dia!' USING ERRCODE = '21540';
		END IF;
		
		IF NOT existe_evaluacion( id_evaluacion ) THEN
			RAISE EXCEPTION '[EXCEPTION] Evaluacion no existe.' USING ERRCODE = '15258';
		END IF;
		
		UPDATE evaluacion SET descripcion = d, fecha = f, inicio = i, termino = t
			WHERE id = id_evaluacion;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION cancelar_evaluacion( id_evaluacion bigint )
RETURNS void AS $$
    BEGIN
		IF NOT existe_evaluacion( id_evaluacion ) THEN
			RAISE EXCEPTION '[EXCEPTION] Evaluacion no existe.' USING ERRCODE = '15258';
		END IF;
		
		DELETE FROM evaluacion
		WHERE id = id_evaluacion;	
    END;
$$ LANGUAGE PLPGSQL;