﻿CREATE DATABASE basic_shop CHARACTER SET 'utf8';

CREATE TABLE category (
	id INT AUTO_INCREMENT PRIMARY KEY,
	parent_id INT(16) NULL DEFAULT '0',
	name VARCHAR(255),
	keywords VARCHAR(255),
	description VARCHAR(255)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

CREATE TABLE product (
	id INT AUTO_INCREMENT PRIMARY KEY,
	category_id INT(16),
	name VARCHAR(255),
	content TEXT(32768),
	price FLOAT(24),
	keywords VARCHAR(255),
	description VARCHAR(255),
	img VARCHAR(255),
	hit ENUM('0', '1'),
	new ENUM('0', '1'),
	sale ENUM('0', '1')
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

CREATE TABLE order_product (
	id INT AUTO_INCREMENT PRIMARY KEY,
	create_at DATETIME NOT NULL DEFAULT NOW(),
	updated_at DATETIME NOT NULL DEFAULT NOW(),
	qty INT(10),
	sum float(16),
	status TINYINT(1) NOT NULL DEFAULT 0,
	name VARCHAR(64),
	email VARCHAR(64),
	phone INT(12),
	address TEXT
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

CREATE TABLE order_item (
	id INT AUTO_INCREMENT PRIMARY KEY,
	order_id INT(10),
	product_id INT(10),
	name VARCHAR(64),
	price float(16),
	qty_item INT(10),
	sum_item float(16)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;