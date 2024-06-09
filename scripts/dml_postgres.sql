-- Users
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (1, 'noriega.mario@example.com', null, 'Rosa', 'Valdez', '$2y$12$uab2tYaT4MNqPpND7GLpcutDNZT2JZKIy11feuXKLXKTt2IbRRXaG', null, '2024-06-06 18:27:19', '2024-06-06 18:27:19');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (2, 'osalas@example.com', null, 'Alba', 'Delarosa', '$2y$12$VJNsmjmC0hW9HsbqWsrvUenh2G2FKi2UN2v.GljCn8b77ZdrB6huS', null, '2024-06-06 18:27:19', '2024-06-06 18:27:19');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (3, 'rodrigo.gaitan@example.net', null, 'Ana', 'Gaitán', '$2y$12$J.N7NJtWgE.n4T2vdM/zdOrKI2L.6vASnqQjB0jb/.PT0qi3kImNm', null, '2024-06-06 18:27:19', '2024-06-06 18:27:19');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (4, 'jose14@example.com', null, 'Isabel', 'Posada', '$2y$12$3h049x6cc9Hdvbg9dZgiQuH7WTCHzbXh1wrwVxPD/zlfYOX.H3HAG', null, '2024-06-06 18:27:19', '2024-06-06 18:27:19');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (5, 'luis85@example.com', null, 'Unai', 'Ojeda', '$2y$12$a3A8P5Nox/mYxZeXe5mzJO3G3rJWLBJDrVgL50rNL/N4Fwt5hlubq', null, '2024-06-06 18:27:19', '2024-06-06 18:27:19');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (6, 'eric.magana@example.org', null, 'Enrique', 'Loera', '$2y$12$zO9/23cKCz3rz7STghWQZOaGq7kwj.K8Lvn7XY1OL92vY3tKtx1z2', null, '2024-06-06 18:27:19', '2024-06-06 18:27:19');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (7, 'izan.delacruz@example.com', null, 'Gerard', 'Páez', '$2y$12$ffAIGoAeT2g13gAhL0PVHevzRLAiGbfyPdN3qc7oJer2zivicCEL2', null, '2024-06-06 18:27:19', '2024-06-06 18:27:19');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (10, 'aurora.collazo@example.net', null, 'Aitor', 'Carrasco', '$2y$12$1tMsg6whtoXSvkw8oG0VmelsXYvnNu2dYGR4WS6XPJZz6Uj6ZnRnS', null, '2024-06-06 18:27:19', '2024-06-06 18:27:19');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (11, 'mike@gmail.com', null, 'Miguel', 'Collado', '$2y$12$b.75ueCQ7DpplgGyAp.D7O9F7I.7oBoI8rF9MLdh2yYcUiGRsNR9K', null, '2024-06-06 18:28:08', '2024-06-09 13:36:50');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (13, 'mike3@gmail.com', null, 'Miguel', 'Collado', '$2y$12$KmQwkPvRVZW6.iB4dbBIHOtndWDSYIG3UlORq.MVqfqx3yzwc2B1S', null, '2024-06-09 15:16:40', '2024-06-09 15:16:40');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (12, 'mike2@gmail.com', null, 'Miguel', 'Collado', '$2y$12$Uczhn0aDb9con34FY416Q.OLShGHzXETOkqnkvfew8gSJ3MVpaYue', null, '2024-06-06 19:43:40', '2024-06-09 15:20:27');
INSERT INTO public.users (id, email, email_verified_at, name, surname, password, remember_token, created_at, updated_at) VALUES (14, 'paco@gmail.com', null, 'Paquito', 'Rodriguez', '$2y$12$R.2sTGvzEMo8Z5Q4Relcp.RJqMvtRrR2QizE038GEDr7Jc.K0uxG6', null, '2024-06-09 16:25:20', '2024-06-09 16:27:13');

-- Access tokens
INSERT INTO public.oauth_access_tokens (id, user_id, client_id, name, scopes, revoked, created_at, updated_at, expires_at) VALUES ('c4b18ff8c2905f778f2fd1d17d48168fc97de78e35c9cb9328a173ac8fd6ff39c95df3bea277d661', 11, 1, 'Patataflastico', '[]', false, '2024-06-06 18:47:32', '2024-06-06 18:47:32', '2025-06-06 18:47:32');

-- OAuth Clients
INSERT INTO public.oauth_clients (id, user_id, name, secret, provider, redirect, personal_access_client, password_client, revoked, created_at, updated_at) VALUES (1, null, 'Laravel Personal Access Client', 'zada37ZRICxttLcacxOJ86kVlJQg08J17CNzANJ2', null, 'http://localhost', true, false, false, '2024-06-06 18:47:26', '2024-06-06 18:47:26');
INSERT INTO public.oauth_clients (id, user_id, name, secret, provider, redirect, personal_access_client, password_client, revoked, created_at, updated_at) VALUES (2, null, 'Laravel Password Grant Client', 'QtxU78eW775ygvIuRYy6FBV2eg5eod0RaOLxIXvG', 'users', 'http://localhost', false, true, false, '2024-06-06 18:47:26', '2024-06-06 18:47:26');

-- OAuth Personal Access
INSERT INTO public.oauth_personal_access_clients (id, client_id, created_at, updated_at) VALUES (1, 1, '2024-06-06 18:47:26', '2024-06-06 18:47:26');

-- Sports
INSERT INTO public.sports (id, name, created_at, updated_at) VALUES (1, 'Tenis', '2024-06-07 19:03:47', '2024-06-07 19:03:47');
INSERT INTO public.sports (id, name, created_at, updated_at) VALUES (2, 'Paddle', '2024-06-07 19:04:46', '2024-06-07 19:04:46');
INSERT INTO public.sports (id, name, created_at, updated_at) VALUES (3, 'Futbol', '2024-06-07 19:04:54', '2024-06-07 19:04:54');
INSERT INTO public.sports (id, name, created_at, updated_at) VALUES (4, 'Voleibol', '2024-06-07 19:05:02', '2024-06-07 19:06:24');
INSERT INTO public.sports (id, name, created_at, updated_at) VALUES (7, 'Baloncesto', '2024-06-07 19:09:53', '2024-06-07 19:09:53');

-- Fields
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (1, 1, '2024-06-07 19:38:42', '2024-06-07 19:45:07');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (2, 2, '2024-06-07 20:03:46', '2024-06-07 20:03:46');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (3, 2, '2024-06-07 20:04:02', '2024-06-07 20:04:02');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (4, 1, '2024-06-07 20:04:08', '2024-06-07 20:04:08');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (5, 3, '2024-06-07 20:04:14', '2024-06-07 20:04:14');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (6, 3, '2024-06-07 20:04:17', '2024-06-07 20:04:17');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (7, 2, '2024-06-07 20:04:22', '2024-06-07 20:04:22');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (8, 2, '2024-06-07 20:04:23', '2024-06-07 20:04:23');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (9, 4, '2024-06-07 20:04:26', '2024-06-07 20:04:26');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (12, 4, '2024-06-07 20:06:12', '2024-06-07 20:06:12');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (14, 7, '2024-06-09 16:28:40', '2024-06-09 16:29:14');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (15, 7, '2024-06-09 16:31:14', '2024-06-09 16:31:14');
INSERT INTO public.fields (id, sport_id, created_at, updated_at) VALUES (16, 7, '2024-06-09 16:31:14', '2024-06-09 16:31:14');

-- Members
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (1, 'mcepeda@example.com', 'Ariadna', 'Hernández', '69068741V', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (2, 'javier99@example.com', 'Francisco Javier', 'Calero', '72002157J', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (3, 'marroquin.valentina@example.net', 'Fátima', 'Castro', '84904126V', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (4, 'pgil@example.com', 'Jesús', 'Aguirre', '31307676F', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (5, 'ainara73@example.org', 'José Antonio', 'Ferrer', '52219103H', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (6, 'amaya.daniel@example.net', 'Martina', 'Tejeda', '82061626H', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (7, 'ntapia@example.net', 'José Antonio', 'Navarrete', '62432534T', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (8, 'zfigueroa@example.com', 'Paola', 'Fierro', '60817972S', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (9, 'carla.alcala@example.net', 'Gabriela', 'De Anda', '05093927W', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (11, 'marina.yanez@example.org', 'Samuel', 'Salvador', '73490704T', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (12, 'sholguin@example.net', 'Carlos', 'Casillas', '60754376Z', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (13, 'sonia25@example.org', 'Santiago', 'Enríquez', '35292814G', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (14, 'martina32@example.org', 'Inés', 'Ibáñez', '85613226G', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (15, 'isantos@example.com', 'Unai', 'Pagan', '52525483S', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (16, 'samuel51@example.net', 'Nicolás', 'Cazares', '15454573E', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (17, 'jaime23@example.org', 'Ian', 'Madrid', '67877748X', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (18, 'gjaquez@example.com', 'Ángeles', 'Izquierdo', '06269484Y', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (19, 'alicia75@example.net', 'Jon', 'Jaimes', '79079568W', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (20, 'clara.esteban@example.com', 'Alma', 'Téllez', '11663215F', '2024-06-07 22:17:44', '2024-06-07 22:17:44');
INSERT INTO public.members (id, email, name, surname, dni, created_at, updated_at) VALUES (23, 'mike@gmail.com', 'Miguel', 'Collado', '12345678D', '2024-06-07 23:42:34', '2024-06-07 23:43:23');

-- Bookings
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (5, '2024-06-09 06:00:00 +00:00', 1, 1, '2024-06-08 10:45:59', '2024-06-08 10:45:59');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (9, '2024-06-09 08:00:00 +00:00', 2, 1, '2024-06-08 20:10:32', '2024-06-08 20:10:32');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (7, '2024-06-09 09:00:00 +00:00', 2, 1, '2024-06-08 20:00:23', '2024-06-08 20:24:39');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (10, '2024-06-09 08:00:00 +00:00', 1, 2, '2024-06-08 20:36:17', '2024-06-08 20:36:17');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (11, '2024-06-09 07:00:00 +00:00', 1, 1, '2024-06-08 23:11:48', '2024-06-08 23:11:48');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (12, '2024-06-09 10:00:00 +00:00', 2, 1, '2024-06-08 23:12:01', '2024-06-08 23:12:01');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (13, '2024-06-09 11:00:00 +00:00', 3, 1, '2024-06-08 23:12:09', '2024-06-08 23:12:09');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (14, '2024-06-09 12:00:00 +00:00', 3, 1, '2024-06-08 23:12:13', '2024-06-08 23:12:13');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (15, '2024-06-09 13:00:00 +00:00', 3, 1, '2024-06-08 23:12:16', '2024-06-08 23:12:16');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (16, '2024-06-09 14:00:00 +00:00', 4, 1, '2024-06-08 23:12:24', '2024-06-08 23:12:24');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (17, '2024-06-09 15:00:00 +00:00', 4, 1, '2024-06-08 23:12:33', '2024-06-08 23:12:33');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (18, '2024-06-09 16:00:00 +00:00', 4, 1, '2024-06-08 23:18:35', '2024-06-08 23:18:35');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (19, '2024-06-09 18:00:00 +00:00', 5, 1, '2024-06-08 23:18:45', '2024-06-08 23:18:45');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (20, '2024-06-09 19:00:00 +00:00', 5, 1, '2024-06-08 23:18:48', '2024-06-08 23:18:48');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (21, '2024-06-09 17:00:00 +00:00', 5, 1, '2024-06-08 23:19:10', '2024-06-08 23:19:10');
INSERT INTO public.bookings (id, date, member_id, field_id, created_at, updated_at) VALUES (23, '2024-06-10 17:00:00 +00:00', 23, 15, '2024-06-09 16:42:49', '2024-06-09 16:42:49');
