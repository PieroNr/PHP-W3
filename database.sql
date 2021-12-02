CREATE TABLE comments (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  author_id int NOT NULL,
  content int NOT NULL,
  publish_date DATE NOT NULL,
  post_id int NOT NULL,
  CONSTRAINT FK_CommentUser FOREIGN KEY (author_id) REFERENCES users(id),
  CONSTRAINT FK_CommentPost FOREIGN KEY (post_id) REFERENCES posts(id)
);

CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  is_admin boolean NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(50)
);

CREATE TABLE posts (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  is_published boolean NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(50),
  author_id int NOT NULL,
  CONSTRAINT FK_PostUser FOREIGN KEY (author_id) REFERENCES users(id)
);