CREATE TABLE IF NOT EXISTS users  (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  is_admin boolean NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(50)
);

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(50) NOT NULL,
  `image_url` varchar(250) DEFAULT NULL,
  `content` varchar(250) NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `publish_date` date NOT NULL DEFAULT current_timestamp(),
  `author_id` int(11) NOT NULL,
  CONSTRAINT fk_posts_user
    FOREIGN KEY (author_id)
    REFERENCES users (id)
    ON DELETE CASCADE
);

CREATE TABLE  IF NOT EXISTS comments (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  author_id int NOT NULL,
  content int NOT NULL,
  publish_date DATE NOT NULL,
  post_id int NOT NULL,
  CONSTRAINT fk_comment_user
    FOREIGN KEY (author_id)
    REFERENCES users (id)
    ON DELETE CASCADE
);