---------------------------------------------------------------------------------------------------------------
--------- Querys datos.
---------------------------------------------------------------------------------------------------------------
INSERT INTO distance (id_distance, name, value, unit) VALUES (1 ,'Iniciante', 3, 'km');
INSERT INTO distance (id_distance, name, value, unit) VALUES (2 ,'1-Kilometro', 1, 'km');

INSERT INTO level (id_level, name, value) VALUES (1 ,'Iniciante', 1);

INSERT INTO rythm_per_km (id_rythm_per_km, name, fmc_percentaje_base, fmc_percentaje_limit) VALUES (1, 'Caminhada', 50, 65);
INSERT INTO rythm_per_km (id_rythm_per_km, name, fmc_percentaje_base, fmc_percentaje_limit) VALUES (2, 'Corrida Leve', 65, 75);
INSERT INTO rythm_per_km (id_rythm_per_km, name, fmc_percentaje_base, fmc_percentaje_limit) VALUES (3, 'Corrida Moderada', 75, 85);
INSERT INTO rythm_per_km (id_rythm_per_km, name, fmc_percentaje_base, fmc_percentaje_limit) VALUES (4, 'Corrida Forte', 85, 90);
INSERT INTO rythm_per_km (id_rythm_per_km, name, fmc_percentaje_base, fmc_percentaje_limit) VALUES (5, 'Corrida Muito Forte', 90, 95);

INSERT INTO duration (id_duration, name, value, unit) VALUES (1 ,'Iniciante', 5, 'semanas');
INSERT INTO duration (id_duration, name, value, unit) VALUES (2 ,'2 Minutos', 2, 'minutos');
INSERT INTO duration (id_duration, name, value, unit) VALUES (3 ,'5 Minutos', 5, 'minutos');
INSERT INTO duration (id_duration, name, value, unit) VALUES (4 ,'8 Minutos', 8, 'minutos');
INSERT INTO duration (id_duration, name, value, unit) VALUES (5 ,'25 Minutos', 25, 'minutos');
INSERT INTO duration (id_duration, name, value, unit) VALUES (6 ,'20 Minutos', 20, 'minutos');
INSERT INTO duration (id_duration, name, value, unit) VALUES (7 ,'3 Minutos', 3, 'minutos');
INSERT INTO duration (id_duration, name, value, unit) VALUES (8 ,'6 Minutos', 6, 'minutos');
INSERT INTO duration (id_duration, name, value, unit) VALUES (9 ,'7 Minutos', 7, 'minutos');
INSERT INTO duration (id_duration, name, value, unit) VALUES (10 ,'10 Minutos', 10, 'minutos');
INSERT INTO duration (id_duration, name, value, unit) VALUES (11 ,'12 Minutos', 12, 'minutos');


INSERT INTO training (name, photo, id_level, id_distance, id_duration) VALUES ('Iniciante','Iniciante.jpg',1,1,1);

--------------------- Creo los Checkpoint.
INSERT INTO checkpoint (id_checkpoint, id_distance, id_rythm_per_km, id_duration) VALUES 
-- Semana 1
(1, Null, 1, 3), 	--5 CA
(2, Null, 2, 2), 	--2 LE
(3, Null, 1, 4),    --8 CA
(4, Null, 1, 5),    --25 CA
(5,    2, 1, Null), --1 KM CA
(6, Null, 2, 7),    --3 LE
-- Semana 2
( 7, Null, 1, 8), 	--6 CA
( 8, Null, 1, 9),	--7 CA
( 9, Null, 1, 10),	--10 CA
(10, Null, 2, 3),	--5 LE

-- Semana 3
(11, Null, 2, 4),	--8 LE
(12, Null, 2, 11),	--12 LE
(13,    2, 2, Null),--1 KM LE

-- Semana 4
(14, Null, 3, 10),  --10 MO
(15, Null, 3, 6),   --20 LE

-- Semana 5
(16, Null, 2, 5),   --25 LE
(17, Null, 3, 6);  --20 MO


INSERT INTO checkpoint (id_checkpoint, id_distance, id_rythm_per_km, id_duration) VALUES 
(1, Null, 1, 3),(2, Null, 2, 2),(3, Null, 1, 4),(4, Null, 1, 5),(5,    2, 1, Null),
(6, Null, 2, 7),( 7, Null, 1, 8),( 8, Null, 1, 9),( 9, Null, 1, 10),(10, Null, 2, 3),
(11, Null, 2, 4),(12, Null, 2, 11),(13,    2, 2, Null),(14, Null, 3, 10),(15, Null, 3, 6),
(16, Null, 2, 5),(17, Null, 3, 6);

--------------------- Creo los stages.
-- SEMANA 1
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (1, Null, 1, 1);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (2, Null, 1, 2);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (3, Null, 1, 3);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (4, Null, 1, 4);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (5, Null, 1, 5);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (6, Null, 1, 6);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (7, Null, 1, 7);

-- SEMANA 2
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (8, Null, 2, 1);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (9, Null, 2, 2);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (10, Null, 2, 3);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (11, Null, 2, 4);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (12, Null, 2, 5);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (13, Null, 2, 6);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (14, Null, 2, 7);

-- SEMANA 3
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (15, Null, 3, 1);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (16, Null, 3, 2);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (17, Null, 3, 3);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (18, Null, 3, 4);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (19, Null, 3, 5);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (20, Null, 3, 6);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (21, Null, 3, 7);

-- SEMANA 4
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (22, Null, 4, 1);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (23, Null, 4, 2);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (24, Null, 4, 3);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (25, Null, 4, 4);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (26, Null, 4, 5);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (27, Null, 4, 6);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (28, Null, 4, 7);

-- SEMANA 5
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (29, Null, 5, 1);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (30, Null, 5, 2);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (31, Null, 5, 3);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (32, Null, 5, 4);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (33, Null, 5, 5);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (34, Null, 5, 6);
INSERT INTO stage (id_stage, id_achievement, week, day) VALUES (35, Null, 5, 7);

--------------------- Creo las relaciones.
-- SEMANA 1
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (1, 1);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (1, 2);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (1, 3);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (3, 4);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (6, 5);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (6, 6);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (6, 5);

-- SEMANA 2
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (8, 7);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (8, 2);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (10, 8);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (10, 6);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (13, 9);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (13, 10);

-- SEMANA 3
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (15, 1);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (15, 10);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (17, 11);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (17, 12);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (20, 13);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (20, 1);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (20, 13);

-- SEMANA 4
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (22, 1);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (22, 14);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (24, 15);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (27, 15);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (27, 1);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (27, 10);

-- SEMANA 5
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (29, 16);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (31, 17);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (33, 13);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (33, 1);
INSERT INTO stage_checkpoint (id_stage, id_checkpoint) VALUES (33, 13);

INSERT INTO training_stage (id_training, id_stage) VALUES
(1, 1),(1, 2),(1, 3),(1, 4),(1, 5),(1, 6),(1, 7),(1, 8),(1, 9),(1, 10),(1, 11),(1, 12),
(1, 13),(1, 14),(1, 15),(1, 16),(1, 17),(1, 18),(1, 19),(1, 20),(1, 21),(1, 22),(1, 23),
(1, 24),(1, 25),(1, 26),(1, 27),(1, 28),(1, 29),(1, 30),(1, 31),(1, 32),(1, 33),(1, 34),(1, 35);

INSERT INTO modality (id_modality​, title, description, photo, link) VALUES
(1,"ModalidadA","ModalidadA","ModalidadA.jpg","www.modalidadA.com"),
(2,"ModalidadB","ModalidadB","ModalidadB.jpg","www.modalidadB.com");


---------------------------------------------------------------------------------------------------------------
--------- Parte 2.
---------------------------------------------------------------------------------------------------------------
INSERT INTO operator (id_operator, name) VALUES (1, "Claro"),(2, "Vivo");

INSERT INTO operator_plan (id_operator_plan, name, cost, id_operator) VALUES 
(NULL, "Mensual",5.4,1),
(NULL, "Semanal",1.0,1),
(NULL, "Diario",8.9,1),
(NULL, "Mensual",5.4,2),
(NULL, "Semanal",6.3,2),
(NULL, "Diario",5.0,2);

INSERT INTO country (id_country, name, country_code) VALUES (NULL, 'Brazil', '+55'); 

---------------------------------------------------------------------------------------------------------------
--------- Extras.
---------------------------------------------------------------------------------------------------------------
DELETE FROM stage_checkpoint;
DELETE FROM training_stage;
DELETE FROM checkpoint;
DELETE FROM stage;
DELETE FROM training;
DELETE FROM achievement;
DELETE FROM distance;
DELETE FROM duration;
DELETE FROM level;
DELETE FROM rythm_per_km;

training 	-> entrenamiento
stage 		-> etapa
achievement -> logro
rythmPerKm 	-> ritmo por km
checkpoint 	-> control




{"profile":
	{
		"userSubscription":
		{
			"id_operator_plan":2,
			"is_valid":true
		},
		"information":
		{
			"name_last_name":"Facundo Merchan",
			"city":"Sao Pablo",
			"email":"facundo@gmail.com",
			"notification_available":true,
			"gender":"M",
			"weight":80,
			"height":1.80,
			"photo":"aaaaa",
			"id_country":1,
			"id_phone_number":{
				"id_country":1,
				"area_code":54,
				"number":1125454122
			}
		}
	}
}


---------------------------------------------------------------------------------------------------------------
--------- Curl GET.
---------------------------------------------------------------------------------------------------------------

---- Training.
curl -i -X GET -H 'Content-Type: application/json' "http://localhost:8000/training/"
curl -i -X GET -H 'Content-Type: application/json' "http://localhost:8000/training/find-name/[NAME]"
curl -i -X GET -H 'Content-Type: application/json' "http://localhost:8000/training/find-id/[ID]"

---- Modality.
curl -i -X GET -H 'Content-Type: application/json' "http://localhost:8000/modality/"
curl -i -X GET -H 'Content-Type: application/json' "http://localhost:8000/modality/find-name/[NAME]"
curl -i -X GET -H 'Content-Type: application/json' "http://localhost:8000/modality/find-id/[ID]"




---- Duration.
curl -i -X GET -H 'Content-Type: application/json' "http://127.0.0.1:8000/duration/"
curl -i -X GET -H 'Content-Type: application/json' "http://127.0.0.1:8000/duration/exist/?name=Iniciante&value=5.00&unit=semanas"
curl -i -X GET -H 'Content-Type: application/json' "http://127.0.0.1:8000/duration/save/?name=Iniciante&value=5.00&unit=semanasss"


---- Distance.
curl -i -X GET -H 'Content-Type: application/json' "http://127.0.0.1:8000/distance/"
curl -i -X GET -H 'Content-Type: application/json' "http://127.0.0.1:8000/distance/exist/?name=Iniciante&value=5.00&unit=semanas"
curl -i -X GET -H 'Content-Type: application/json' "http://127.0.0.1:8000/distance/save/?name=Iniciante&value=5.00&unit=semanasss"


---- Level.
curl -i -X GET -H 'Content-Type: application/json' "http://127.0.0.1:8000/level/"
curl -i -X GET -H 'Content-Type: application/json' "http://127.0.0.1:8000/level/exist/?name=Iniciante&value=1"
curl -i -X GET -H 'Content-Type: application/json' "http://127.0.0.1:8000/level/save/?name=Iniciante&value=5.00"



curl -i -X GET -H 'Content-Type: application/json' ""
curl -i -X GET -H 'Content-Type: application/json' ""
curl -i -X GET -H 'Content-Type: application/json' ""


---------------------------------------------------------------------------------------------------------------
--------- Curl Post.
---------------------------------------------------------------------------------------------------------------
---- Save Prfile
curl -i -X POST -H 'Content-Type: application/json' -d '{"profile":{"userSubscription":{"id_operator_plan":2,"is_valid":true},"information":{"name_last_name":"Facundo Merchan","city":"Sao Pablo","email":"facundo@gmail.com","notification_available":true,"gender":"M","weight":80,"height":1.80,"photo":"aaaaa","id_country":1,"id_phone_number":{"id_country":1,"area_code":54,"number":1125454122}}}}' http://localhost:8000/profile/











