CREATE OR REPLACE FUNCTION unicidad_curso( )
RETURNS trigger AS $$
	DECLARE
		tupla record;
	BEGIN
		FOR tupla IN SELECT * FROM curso LOOP
			IF tupla.anio = NEW.anio AND tupla.letra = NEW.letra AND tupla.grado = NEW.grado AND tupla.nivel = NEW.nivel THEN
				RAISE EXCEPTION '[EXCEPTION] Curso ya existe!' USING ERRCODE = '23505';
			END IF;
		END LOOP;

		RETURN NEW;
	END;
$$ LANGUAGE PLPGSQL;

CREATE TRIGGER verificar_unicidad_curso
	BEFORE INSERT OR UPDATE ON curso
	FOR EACH ROW EXECUTE PROCEDURE unicidad_curso( );
	
CREATE OR REPLACE FUNCTION existe_curso( id_c bigint )
RETURNS boolean AS $$
    DECLARE
		tupla RECORD;
    BEGIN
		FOR tupla IN SELECT * FROM curso LOOP
			IF tupla.id = id_c THEN
				RETURN TRUE;
			END IF;
		END LOOP;
		
		RETURN FALSE;
	END;
$$ LANGUAGE PLPGSQL;
	
CREATE OR REPLACE FUNCTION registrar_curso( letra char, grado integer, nivel text )
RETURNS bigint AS $$
	DECLARE
		id_curso bigint;
		anio_actual integer;
    BEGIN
		SELECT EXTRACT( YEAR from current_date ) INTO anio_actual;
		INSERT INTO curso( anio, letra, grado, nivel )
			VALUES ( anio_actual, letra, grado, nivel )
			RETURNING id INTO id_curso;
		RETURN id_curso;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION editar_curso( id_curso bigint, a integer, l char, g integer, n text )
RETURNS void AS $$
    BEGIN
		IF NOT existe_curso( id_curso ) THEN
			RAISE EXCEPTION '[EXCEPTION] Asignatura no existe.' USING ERRCODE = '11258';
		END IF;
		
		UPDATE curso SET anio = a, letra = l, grado = g, nivel = n
		WHERE id = id_curso;
    END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION deshacer_registro_curso( id_curso bigint )
RETURNS void AS $$
    BEGIN
		DELETE FROM curso
		WHERE id = id_curso;		
    END;
$$ LANGUAGE PLPGSQL;