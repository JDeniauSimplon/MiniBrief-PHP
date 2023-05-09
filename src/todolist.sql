START TRANSACTION;
DROP DATABASE IF EXISTS todo;
CREATE DATABASE IF NOT EXISTS todo;
USE todo;
CREATE TABLE IF NOT EXISTS task (
    id INT(10) NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    description VARCHAR(500) NOT NULL,
    important BOOL NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id)
);

INSERT INTO `task` (`title`, `description`, `important`)
VALUES ('Wash the dishes', 'Clean all plates.', 0),
       ('Cook dinner', 'Prepare a nutritious and delicious meal for tonights dinner, using fresh ingredients and your favorite recipe.', 0),
       ('Pay bills', 'Pay electricity bill , gas ...', 1),
       ('Order Pizza', 'Call pizza delivery service and place an order for a large pepperoni pizza.', 1);
COMMIT; 