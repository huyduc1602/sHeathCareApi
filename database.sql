CREATE TABLE IF NOT EXISTS company(
	id int PRIMARY KEY AUTO_INCREMENT,
	address VARCHAR(100) NOT NULL,
	city VARCHAR(100),
	imageCompany VARCHAR(1000),
    latitude VARCHAR(100),
    longtitude VARCHAR(100),
    name VARCHAR(100),
    phoneNumber VARCHAR(20),
    type tinyint DEFAULT '0' COMMENT '1 là hiển thị, 0 ẩn'
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS healthNews(
	id int PRIMARY KEY AUTO_INCREMENT,
	createAt DATE DEFAULT NOW(),
	imageNews VARCHAR(1000),
	prevention TEXT,
    symptom TEXT,
    titleNews VARCHAR(100)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS productCategory(
	id int PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    parent_id int NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS product(
	id int PRIMARY KEY AUTO_INCREMENT,
    idComment VARCHAR(1000),
	image VARCHAR(1000),
    ingredient TEXT,
    licenseNumber VARCHAR(100),
    likeNumber INT DEFAULT '0',
    name VARCHAR(100),
    origin TEXT,
    sideEfects TEXT,
    type INT NOT NULL,
    userManual TEXT,
    uses TEXT,
    FOREIGN KEY (type) REFERENCES productCategory(id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS slides(
	id int PRIMARY KEY AUTO_INCREMENT,
    createAt VARCHAR(1000)
	description VARCHAR(1000),
    thumbnail VARCHAR(1000),
    title VARCHAR(255),
    urlVideo VARCHAR(1000)
) ENGINE = InnoDB;