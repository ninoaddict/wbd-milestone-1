CREATE TYPE role_enum AS ENUM('jobseeker', 'company');
CREATE TYPE job_enum AS ENUM('full-time', 'part-time', 'internship');
CREATE TYPE location_enum AS ENUM('on-site', 'hybrid', 'remote');
CREATE TYPE status_enum AS ENUM('accepted', 'rejected', 'waiting');

CREATE TABLE IF NOT EXISTS users (
  user_id SERIAL PRIMARY KEY,
  email varchar(255) UNIQUE NOT NULL,
  password varchar(128) NOT NULL,
  role role_enum NOT NULL,
  nama varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS company_detail (
  user_id SERIAL PRIMARY KEY,
  lokasi varchar(255) NOT NULL,
  about text NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS lowongan (
  lowongan_id SERIAL PRIMARY KEY,
  company_id INT NOT NULL,
  posisi varchar(255) NOT NULL,
  deskripsi text DEFAULT '' NOT NULL,
  jenis_pekerjaan job_enum NOT NULL,
  jenis_lokasi location_enum NOT NULL,
  is_open BOOLEAN DEFAULT TRUE NOT NULL,
  created_at timestamp NOT NULL DEFAULT NOW(),
  updated_at timestamp NOT NULL DEFAULT NOW(),
  FOREIGN KEY(company_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS lowongan_attachment (
  attachment_id SERIAL PRIMARY KEY,
  lowongan_id INT NOT NULL,
  file_path text NOT NULL,
  FOREIGN KEY(lowongan_id) REFERENCES lowongan(lowongan_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS lamaran (
  lamaran_id SERIAL PRIMARY KEY,
  user_id INT NOT NULL,
  lowongan_id INT NOT NULL,
  cv_path text NOT NULL,
  video_path text,
  status status_enum NOT NULL DEFAULT 'waiting',
  status_reason text,
  created_at timestamp DEFAULT NOW(),
  FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE,
  FOREIGN KEY(lowongan_id) REFERENCES lowongan(lowongan_id) ON DELETE CASCADE
);

CREATE OR REPLACE FUNCTION trigger_set_timestamp()
RETURNS TRIGGER AS $$
BEGIN
  NEW.updated_at = NOW();
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER set_timestamp
AFTER UPDATE ON lowongan
FOR EACH ROW
EXECUTE FUNCTION trigger_set_timestamp();

insert into users (email, role, nama, password) values ('sveldman0@canalblog.com', 'jobseeker', 'Stewart Veldman', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('isanbroke1@biblegateway.com', 'company', 'Tokopedia', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('dlonsbrough2@ebay.com', 'jobseeker', 'Denise Lonsbrough', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ocubin3@spotify.com', 'jobseeker', 'Odette Cubin', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('gjope4@1688.com', 'jobseeker', 'Gilli Jope', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('cmayo5@zdnet.com', 'jobseeker', 'Collete Mayo', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('srevening6@bing.com', 'jobseeker', 'Simona Revening', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('igillaspy7@so-net.ne.jp', 'jobseeker', 'Ilyse Gillaspy', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('fbute8@unicef.org', 'jobseeker', 'Farleigh Bute', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('tbodle9@studiopress.com', 'jobseeker', 'Ty Bodle', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('edakersa@yahoo.co.jp', 'company', 'Flipstorm', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('kcharityb@opera.com', 'jobseeker', 'Kristopher Charity', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('eemersonc@google.com.au', 'jobseeker', 'Enrico Emerson', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ppoznanskid@yandex.ru', 'jobseeker', 'Pip Poznanski', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('nwatmane@nydailynews.com', 'jobseeker', 'Nicole Watman', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('dfriesf@rakuten.co.jp', 'jobseeker', 'Dunn Fries', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ocharletg@wsj.com', 'jobseeker', 'Obie Charlet', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('crollinshawh@usnews.com', 'jobseeker', 'Cristian Rollinshaw', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('lhazeldenei@usgs.gov', 'jobseeker', 'Laetitia Hazeldene', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('cstoltingj@latimes.com', 'jobseeker', 'Cobb Stolting', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ajiroutkak@wikia.com', 'jobseeker', 'Adore Jiroutka', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('bduminil@noaa.gov', 'jobseeker', 'Bard Dumini', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('mwilcherm@geocities.com', 'company', 'Zooxo', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('srustedgen@europa.eu', 'jobseeker', 'Si Rustedge', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('tharbishero@ifeng.com', 'company', 'Yabox', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('mpetegreep@odnoklassniki.ru', 'jobseeker', 'Morry Petegree', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('cwaughq@webnode.com', 'jobseeker', 'Claudetta Waugh', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('kgreghr@networkadvertising.org', 'jobseeker', 'Kamilah Gregh', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('pmackrills@wisc.edu', 'jobseeker', 'Phaidra Mackrill', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('dbernardtt@phpbb.com', 'jobseeker', 'Dniren Bernardt', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('yabelevitzu@devhub.com', 'jobseeker', 'Yasmeen Abelevitz', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('jliddiattv@google.fr', 'jobseeker', 'Jaymee Liddiatt', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('cduddyw@army.mil', 'company', 'Skynoodle', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('wrowledgex@si.edu', 'jobseeker', 'Wandis Rowledge', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('gsherrocky@statcounter.com', 'jobseeker', 'Garreth Sherrock', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('blewisz@jigsy.com', 'jobseeker', 'Becky Lewis', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('daxton10@biblegateway.com', 'jobseeker', 'Darius Axton', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('gkiebes11@flavors.me', 'jobseeker', 'Garreth Kiebes', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('mskingle12@etsy.com', 'jobseeker', 'Marietta Skingle', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('rtrembath13@baidu.com', 'company', 'Photospace', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('larrandale14@yolasite.com', 'jobseeker', 'Lauraine Arrandale', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ediboll15@techcrunch.com', 'jobseeker', 'Elva Diboll', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('akubacek16@dell.com', 'jobseeker', 'Avivah Kubacek', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('mgabotti17@omniture.com', 'company', 'Zoom', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('tnoulton18@bizjournals.com', 'company', 'Shopee', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ayorath19@harvard.edu', 'jobseeker', 'Ashien Yorath', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('cloddy1a@statcounter.com', 'jobseeker', 'Cymbre Loddy', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ahandes1b@reverbnation.com', 'jobseeker', 'Albina Handes', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('dsomers1c@unc.edu', 'jobseeker', 'Donn Somers', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('adudgeon1d@yale.edu', 'jobseeker', 'Archibald Dudgeon', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('rorodane1e@abc.net.au', 'jobseeker', 'Rich O''Rodane', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('vmechem1f@last.fm', 'company', 'Google', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('fbryan1g@cnn.com', 'company', 'Meta', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('bgebby1h@last.fm', 'jobseeker', 'Borg Gebby', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('etidder1i@forbes.com', 'jobseeker', 'Elonore Tidder', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('katcherley1j@mail.ru', 'company', 'Amazon', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('mbollins1k@ovh.net', 'jobseeker', 'Marya Bollins', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('wleddy1l@zimbio.com', 'jobseeker', 'Walden Leddy', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('kgarm1m@stanford.edu', 'company', 'Netflix', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('dpitkeathley1n@adobe.com', 'company', 'Disney', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('edriscoll1o@opera.com', 'jobseeker', 'Eydie Driscoll', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('cbodman1p@phpbb.com', 'company', 'Sony', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('rwestman1q@imageshack.us', 'jobseeker', 'Rodi Westman', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('dvanyard1r@miitbeian.gov.cn', 'jobseeker', 'Dev Vanyard', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('rlavery1s@symantec.com', 'jobseeker', 'Rudy Lavery', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ecraigs1t@blogspot.com', 'jobseeker', 'Elise Craigs', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('fskamal1u@macromedia.com', 'jobseeker', 'Felizio Skamal', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('dferandez1v@earthlink.net', 'jobseeker', 'Dinny Ferandez', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('bbruce1w@theglobeandmail.com', 'jobseeker', 'Bayard Bruce', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('teles1x@pbs.org', 'jobseeker', 'Tobi Eles', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('arappa1y@amazonaws.com', 'company', 'Apple', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('mmcmonnies1z@nyu.edu', 'jobseeker', 'Marcelle McMonnies', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('awestrip20@gravatar.com', 'jobseeker', 'Anna Westrip', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('fladdle21@jugem.jp', 'jobseeker', 'Florenza Laddle', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('gcabane22@columbia.edu', 'jobseeker', 'Garland Cabane', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('vthraves23@com.com', 'jobseeker', 'Verge Thraves', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('lmiroy24@wordpress.org', 'jobseeker', 'Lara Miroy', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ffreeberne25@pbs.org', 'jobseeker', 'Francklyn Freeberne', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('bhans26@reverbnation.com', 'jobseeker', 'Boycie Hans', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('bdodd27@a8.net', 'jobseeker', 'Bride Dodd', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('hbradburne28@loc.gov', 'jobseeker', 'Hildy Bradburne', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('jmudge29@de.vu', 'jobseeker', 'Jsandye Mudge', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('hde2a@toplist.cz', 'jobseeker', 'Helen De Ortega', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('jcounsell2b@google.com', 'jobseeker', 'Jacynth Counsell', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('sorourke2c@acquirethisname.com', 'jobseeker', 'Saraann O''Rourke', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('fmeddemmen2d@deliciousdays.com', 'company', 'Samsung', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ctruluck2e@umich.edu', 'jobseeker', 'Claudius Truluck', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ehussy2f@a8.net', 'jobseeker', 'Elsey Hussy', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('bbrydell2g@wired.com', 'jobseeker', 'Bell Brydell', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('gandrewartha2h@spiegel.de', 'jobseeker', 'Gene Andrewartha', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('cmacaughtrie2i@google.ru', 'jobseeker', 'Corey MacAughtrie', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('adougal2j@answers.com', 'jobseeker', 'Aubrette Dougal', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('vsapena2k@usnews.com', 'jobseeker', 'Vassili Sapena', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('dmaddin2l@adobe.com', 'jobseeker', 'Dona Maddin', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('speret2m@thetimes.co.uk', 'jobseeker', 'Shena Peret', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('lcornbell2n@paypal.com', 'jobseeker', 'Lonny Cornbell', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('mde2o@tmall.com', 'jobseeker', 'Mattheus De Mitris', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('gmeace2p@mashable.com', 'company', 'Grab', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('ltearle2q@nsw.gov.au', 'company', 'Uber', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');
insert into users (email, role, nama, password) values ('jsoper2r@yahoo.co.jp', 'jobseeker', 'Joann Soper', '$2y$10$KCDl.0iEQL7kqyewJQI9J.qgIdOoB/tF7AIsD4vjyiqtwscczAAQa');

insert into company_detail (user_id, lokasi, about) values (2, '14862 Debra Avenue', 'morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est');
insert into company_detail (user_id, lokasi, about) values (11, '06749 Springview Alley', 'augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices');
insert into company_detail (user_id, lokasi, about) values (23, '7750 Oriole Way', 'sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper');
insert into company_detail (user_id, lokasi, about) values (25, '5 Hudson Court', 'penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum');
insert into company_detail (user_id, lokasi, about) values (33, '48 Birchwood Court', 'vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in');
insert into company_detail (user_id, lokasi, about) values (40, '03545 Kropf Pass', 'pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non');
insert into company_detail (user_id, lokasi, about) values (44, '34927 Kenwood Lane', 'lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc');
insert into company_detail (user_id, lokasi, about) values (45, '7889 Darwin Center', 'donec semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat');
insert into company_detail (user_id, lokasi, about) values (52, '6593 Hintze Alley', 'amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo');
insert into company_detail (user_id, lokasi, about) values (53, '9404 Hooker Plaza', 'molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum');
insert into company_detail (user_id, lokasi, about) values (56, '6484 Kipling Road', 'a pede posuere nonummy integer non velit donec diam neque vestibulum eget');
insert into company_detail (user_id, lokasi, about) values (59, '79 Dunning Drive', 'pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien');
insert into company_detail (user_id, lokasi, about) values (60, '8 Springview Plaza', 'pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate');
insert into company_detail (user_id, lokasi, about) values (62, '2 International Junction', 'magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum');
insert into company_detail (user_id, lokasi, about) values (71, '84 Warbler Circle', 'sed augue aliquam erat volutpat in congue etiam justo etiam');
insert into company_detail (user_id, lokasi, about) values (86, '123 Riverside Hill', 'lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut');
insert into company_detail (user_id, lokasi, about) values (98, '29113 Pierstorff Court', 'ut ultrices vel augue vestibulum ante ipsum primis in faucibus');
insert into company_detail (user_id, lokasi, about) values (99, '1 Oakridge Way', 'ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam');

insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (45, 'Project Manager', 'duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat', 'part-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (44, 'Recruiter', 'vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere', 'internship', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (33, 'Senior Cost Accountant', 'sed tristique in tempus sit amet sem fusce consequat nulla nisl nunc nisl', 'part-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (44, 'Legal Assistant', 'imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis', 'full-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (45, 'Clinical Specialist', 'sit amet nulla quisque arcu libero rutrum ac lobortis vel dapibus at diam', 'part-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (56, 'Sales Representative', 'maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros', 'part-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (45, 'Senior Financial Analyst', 'ullamcorper purus sit amet nulla quisque arcu libero rutrum ac lobortis vel dapibus at diam', 'full-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (40, 'Director of Sales', 'at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget', 'internship', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (60, 'Environmental Tech', 'morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus nec molestie sed justo pellentesque', 'internship', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (44, 'VP Sales', 'mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit amet', 'full-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (25, 'Associate Professor', 'adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque eget nunc', 'part-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (2, 'Database Administrator IV', 'ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id', 'full-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (71, 'Accountant III', 'bibendum imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce', 'internship', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (40, 'Accounting Assistant I', 'aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan', 'full-time', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (98, 'Food Chemist', 'eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi', 'part-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (11, 'Executive Secretary', 'platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum', 'full-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (45, 'Structural Engineer', 'lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada in imperdiet et commodo', 'full-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (2, 'Systems Administrator II', 'nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque', 'part-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (44, 'Staff Accountant IV', 'at ipsum ac tellus semper interdum mauris ullamcorper purus sit amet nulla quisque arcu libero', 'part-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (98, 'Office Assistant II', 'ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes', 'internship', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (33, 'Junior Executive', 'quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue', 'internship', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (33, 'Pharmacist', 'viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit amet nulla', 'internship', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (59, 'Accountant II', 'ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id', 'part-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (23, 'Nurse Practicioner', 'tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare', 'full-time', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (62, 'Senior Sales Associate', 'sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed', 'internship', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (44, 'Web Designer II', 'consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede', 'internship', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (33, 'VP Accounting', 'in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin', 'internship', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (45, 'Research Assistant I', 'commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi', 'full-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (45, 'Product Engineer', 'diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien', 'full-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (11, 'Assistant Media Planner', 'nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque', 'part-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (45, 'VP Product Management', 'duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat eleifend donec', 'part-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (33, 'VP Quality Control', 'in lectus pellentesque at nulla suspendisse potenti cras in purus eu', 'full-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (86, 'Senior Financial Analyst', 'et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien', 'full-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (52, 'Assistant Media Planner', 'vel augue vestibulum ante ipsum primis in faucibus orci luctus et', 'full-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (2, 'Business Systems Development Analyst', 'elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi', 'full-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (52, 'Project Manager', 'non quam nec dui luctus rutrum nulla tellus in sagittis dui vel nisl duis ac nibh', 'internship', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (33, 'Mechanical Systems Engineer', 'porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet', 'full-time', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (52, 'Account Coordinator', 'eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in', 'full-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (99, 'Associate Professor', 'vitae quam suspendisse potenti nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non', 'full-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (86, 'Chemical Engineer', 'vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut massa', 'part-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (62, 'Help Desk Technician', 'sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes', 'internship', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (52, 'Administrative Assistant I', 'ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam', 'full-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (44, 'Legal Assistant', 'viverra pede ac diam cras pellentesque volutpat dui maecenas tristique est et tempus semper est', 'full-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (99, 'Cost Accountant', 'faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus dolor vel est donec odio justo sollicitudin ut', 'full-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (86, 'Desktop Support Technician', 'leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit', 'internship', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (56, 'Marketing Manager', 'placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel', 'part-time', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (2, 'Recruiting Manager', 'ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia', 'internship', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (56, 'Recruiter', 'justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis', 'part-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (2, 'Tax Accountant', 'nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas', 'internship', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (23, 'Geologist I', 'turpis eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus tortor', 'part-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (71, 'Sales Representative', 'sapien placerat ante nulla justo aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse', 'part-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (2, 'Design Engineer', 'quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum', 'internship', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (2, 'Senior Developer', 'tellus in sagittis dui vel nisl duis ac nibh fusce lacus', 'full-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (33, 'Operator', 'ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam', 'part-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (60, 'Research Nurse', 'libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis', 'internship', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (71, 'Automation Specialist IV', 'dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque', 'full-time', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (86, 'VP Sales', 'amet consectetuer adipiscing elit proin risus praesent lectus vestibulum quam', 'part-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (23, 'Desktop Support Technician', 'adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a pede', 'part-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (86, 'Computer Systems Analyst II', 'mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia', 'part-time', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (45, 'Engineer IV', 'orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh', 'internship', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (60, 'Desktop Support Technician', 'ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel', 'part-time', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (62, 'Staff Accountant I', 'orci luctus et ultrices posuere cubilia curae nulla dapibus dolor vel est donec odio justo sollicitudin ut suscipit a', 'internship', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (25, 'Office Assistant III', 'suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit amet nulla quisque arcu libero', 'internship', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (71, 'Administrative Assistant IV', 'eleifend donec ut dolor morbi vel lectus in quam fringilla', 'full-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (56, 'Structural Analysis Engineer', 'ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio', 'internship', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (59, 'Quality Engineer', 'id massa id nisl venenatis lacinia aenean sit amet justo morbi ut', 'full-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (52, 'Assistant Media Planner', 'libero convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet', 'part-time', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (52, 'Internal Auditor', 'praesent id massa id nisl venenatis lacinia aenean sit amet', 'internship', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (33, 'Senior Cost Accountant', 'neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus', 'full-time', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (56, 'Recruiter', 'ultrices mattis odio donec vitae nisi nam ultrices libero non mattis pulvinar nulla', 'full-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (99, 'Pharmacist', 'ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt', 'full-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (98, 'Project Manager', 'id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl', 'part-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (99, 'Environmental Specialist', 'vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat', 'part-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (62, 'Programmer Analyst II', 'a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus', 'part-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (23, 'GIS Technical Architect', 'donec ut mauris eget massa tempor convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque', 'full-time', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (53, 'Administrative Officer', 'nisl duis ac nibh fusce lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in', 'internship', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (98, 'Actuary', 'ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non mattis pulvinar nulla', 'internship', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (98, 'Junior Executive', 'porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus', 'full-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (99, 'Geological Engineer', 'nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu', 'internship', 'on-site', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (59, 'Product Engineer', 'ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede', 'full-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (62, 'Senior Financial Analyst', 'eu felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet', 'part-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (44, 'Desktop Support Technician', 'integer ac leo pellentesque ultrices mattis odio donec vitae nisi', 'internship', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (40, 'Software Consultant', 'nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet diam', 'full-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (52, 'Financial Analyst', 'magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi', 'full-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (11, 'Software Engineer II', 'etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit', 'part-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (56, 'Database Administrator III', 'quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse', 'internship', 'remote', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (99, 'Sales Associate', 'sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit', 'internship', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (11, 'Environmental Specialist', 'tempus sit amet sem fusce consequat nulla nisl nunc nisl', 'part-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (44, 'Compensation Analyst', 'ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse potenti nullam', 'full-time', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (99, 'Civil Engineer', 'turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh', 'internship', 'remote', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (86, 'Geologist II', 'eget nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio', 'internship', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (86, 'Accountant III', 'erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut', 'internship', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (11, 'Recruiting Manager', 'sit amet lobortis sapien sapien non mi integer ac neque', 'internship', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (23, 'Accountant II', 'tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse', 'internship', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (33, 'Assistant Manager', 'vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa', 'internship', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (59, 'Desktop Support Technician', 'ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non mattis pulvinar nulla pede', 'internship', 'hybrid', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (62, 'Financial Analyst', 'nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut', 'part-time', 'hybrid', false);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (53, 'Account Representative II', 'convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis', 'full-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (62, 'Data Coordinator', 'vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit', 'full-time', 'on-site', true);
insert into lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open) values (11, 'Help Desk Operator', 'nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo', 'part-time', 'hybrid', true);
