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