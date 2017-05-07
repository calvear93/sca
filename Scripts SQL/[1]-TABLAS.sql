CREATE TABLE nivel ( 
	grado smallint NOT NULL,
	nivel text NOT NULL,
	CONSTRAINT pk_nivel PRIMARY KEY ( grado, nivel )
);

CREATE TABLE curso ( 
	id bigserial NOT NULL,
	anio integer NOT NULL,
	letra char NOT NULL,
	grado smallint NOT NULL,
	nivel text NOT NULL,
	CONSTRAINT pk_curso PRIMARY KEY ( id ),
	CONSTRAINT fk_curso_nivel FOREIGN KEY ( grado, nivel ) REFERENCES nivel( grado, nivel ) ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE estudiante (
	run text NOT NULL,
	nombres text NOT NULL,
	apellido_paterno text NOT NULL,
	apellido_materno text NOT NULL,
	fono integer,
	email text,
	run_apoderado text,
	nombres_apoderado text,
	apellido_paterno_apoderado text,
	apellido_materno_apoderado text,
	fono_apoderado integer,
	email_apoderado text,
	curso_actual bigint,
	passwd text NOT NULL,
	CONSTRAINT pk_estudiante PRIMARY KEY ( run ),
	CONSTRAINT fk_estudiante_curso FOREIGN KEY ( curso_actual ) REFERENCES curso( id ) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE profesor (
	run text NOT NULL,
	nombres text NOT NULL,
	apellido_paterno text NOT NULL,
	apellido_materno text NOT NULL,
	fono integer,
	email text,
	titulo text NOT NULL,
	habilitado boolean DEFAULT TRUE,
	passwd text NOT NULL,
	CONSTRAINT pk_profesor PRIMARY KEY ( run )
);
 
CREATE TABLE lista_curso ( 
	run_estudiante text NOT NULL,
	curso bigint NOT NULL,
	promedio float DEFAULT 0.0,
	CONSTRAINT pk_lc PRIMARY KEY ( run_estudiante, curso ),
	CONSTRAINT fk_lc_estudiante FOREIGN KEY ( run_estudiante ) REFERENCES estudiante( run ) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_lc_curso FOREIGN KEY ( curso ) REFERENCES curso( id ) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE asignatura ( 
	id bigserial NOT NULL,
	nombre text NOT NULL,
	descripcion text DEFAULT 'Sin descripcion',
	run_profesor text,
	curso bigint NOT NULL,
	CONSTRAINT pk_asignatura PRIMARY KEY ( id ),
	CONSTRAINT fk_asignatura_profesor FOREIGN KEY ( run_profesor ) REFERENCES profesor( run ) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_asignatura_curso FOREIGN KEY ( curso ) REFERENCES curso( id ) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE evaluacion ( 
	id bigserial NOT NULL,
	descripcion text DEFAULT 'Sin descripcion',
	fecha date NOT NULL,
	inicio time NOT NULL,
	termino time NOT NULL,
	asignatura bigint NOT NULL,
	CONSTRAINT pk_evaluacion PRIMARY KEY ( id ),
	CONSTRAINT fk_evaluacion_asignatura FOREIGN KEY ( asignatura ) REFERENCES asignatura( id ) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE calificacion ( 
	id bigserial NOT NULL,
	valor float NOT NULL,
	descripcion text DEFAULT 'Sin descripcion',
	fecha date DEFAULT current_date,
	run_estudiante text NOT NULL,
	asignatura bigint NOT NULL,
	CONSTRAINT pk_calificacion PRIMARY KEY ( id ),
	CONSTRAINT fk_calificacion_estudiante FOREIGN KEY ( run_estudiante ) REFERENCES estudiante( run ) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_calificacion_asignatura FOREIGN KEY ( asignatura ) REFERENCES asignatura( id ) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE funcionario (
	usuario text NOT NULL,
	passwd text NOT NULL,
	CONSTRAINT pk_funcionario PRIMARY KEY ( usuario )
);

INSERT INTO funcionario ( usuario, passwd ) VALUES ( 'user', '123' );

CREATE OR REPLACE FUNCTION verificar_password_funcionario ( u text, pass text )
RETURNS boolean AS $$
	BEGIN
		RETURN pass = (
			SELECT passwd FROM funcionario
			WHERE usuario = u
		);
	END;
$$ LANGUAGE PLPGSQL;

INSERT INTO nivel( grado, nivel ) VALUES
	( 1, 'basico' ),
	( 2, 'basico' ),
	( 3, 'basico' ),
	( 4, 'basico' ),
	( 5, 'basico' ),
	( 6, 'basico' ),
	( 7, 'basico' ),
	( 8, 'basico' ),
	( 1, 'medio' ),
	( 2, 'medio' ),
	( 3, 'medio' ),
	( 4, 'medio' );