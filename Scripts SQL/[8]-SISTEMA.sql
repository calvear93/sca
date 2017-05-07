CREATE OR REPLACE FUNCTION tipo_perfil( run text ) -- 0 func, 1 estudiante, 2 profesor.
RETURNS integer AS $$
    BEGIN
		IF existe_estudiante( run ) THEN
			RETURN 1;
		END IF;
		IF existe_profesor( run ) THEN
			RETURN 2;	
		END IF;
		RETURN 0;
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION iniciar_sesion( usuario text, passwd text )
RETURNS integer AS $$
	DECLARE
		tipo smallint;
	BEGIN
		tipo := tipo_perfil( usuario );
		IF tipo = 1 AND verificar_password_estudiante( usuario, passwd ) THEN
			RETURN 1;
		ELSIF tipo = 2 AND verificar_password_profesor( usuario, passwd ) THEN
			RETURN 2;
		ELSIF verificar_password_funcionario( usuario, passwd ) THEN
			RETURN 0;
		END IF;
		RETURN -1;
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION vector_promedio_cursos( id_curso integer )
RETURNS TABLE( run_e text, promedio float ) AS $$
	BEGIN
		RETURN QUERY (
			SELECT run, promedio_estudiante( run ) AS promedio FROM estudiante
			WHERE curso_actual = id_curso
			ORDER BY run
		);
	END;
$$ LANGUAGE PLPGSQL;

CREATE OR REPLACE FUNCTION finalizar_periodo()
RETURNS void AS $$
	DECLARE
		tupla record;
    BEGIN
		FOR tupla IN SELECT * FROM estudiante LOOP
			SELECT calcular_promedio_estudiante( tupla.run );
			tupla.curso_actual = NULL;
		END LOOP;
    END;
$$ LANGUAGE PLPGSQL;