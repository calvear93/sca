CREATE OR REPLACE FUNCTION curso_de_calificacion( id_calificacion bigint )
RETURNS bigint AS $$
    BEGIN
		RETURN (
			SELECT curso FROM asignatura
			WHERE id = (
				SELECT asignatura FROM calificacion
				WHERE id = id_calificacion
			)
		);
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION existe_calificacion( id_c bigint )
RETURNS boolean AS $$
    DECLARE
		tupla RECORD;
    BEGIN
		FOR tupla IN SELECT * FROM calificacion LOOP
			IF tupla.id = id_c THEN
				RETURN TRUE;
			END IF;
		END LOOP;
		
		RETURN FALSE;
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION registrar_calificacion( valor float, descripcion text, run_estudiante text, asignatura bigint )
RETURNS void AS $$
    BEGIN		
		INSERT INTO calificacion( valor, descripcion, run_estudiante, asignatura )
			VALUES ( valor, descripcion, run_estudiante, asignatura );
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION editar_calificacion( id_calificacion bigint, v float, d text )
RETURNS void AS $$
    BEGIN
		IF NOT existe_calificacion( id_calificacion ) THEN
			RAISE EXCEPTION '[EXCEPTION] Calificacion no existe.' USING ERRCODE = '17258';
		END IF;
		
		UPDATE calificacion SET valor = v, descripcion = d, fecha = current_date
		WHERE id = id_calificacion;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION eliminar_calificacion( id_calificacion bigint )
RETURNS void AS $$
    BEGIN
		IF NOT existe_calificacion( id_calificacion ) THEN
			RAISE EXCEPTION '[EXCEPTION] Calificacion no existe.' USING ERRCODE = '17258';
		END IF;
		
		DELETE FROM calificacion
		WHERE id = id_calificacion;	
    END;
$$ LANGUAGE PLPGSQL;