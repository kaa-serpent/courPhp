DROP DATABASE IF EXISTS api;

CREATE DATABASE api;

CREATE TABLE api.user(
id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
login VARCHAR(50) NOT NULL,
password VARCHAR(100) NOT NULL
);


-- hachage du mot de passe : algorithme argon2 sur intenet
INSERT INTO api.user
VALUE(NULL, 'admin', '$argon2i$v=19$m=16,t=2,p=1$dktVajdmcmEyaVc0VnljbA$e/ZrF5YP/6dBod+lK3gHbg');