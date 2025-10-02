create database my_store;
use my_store;

create table category (
	id INT NOT NULL AUTO_INCREMENT primary key,
    parent_id INT,
    `name` VARCHAR(350),
    
    FOREIGN KEY (parent_id) REFERENCES category(id)
);

create table product(
	id INT NOT NULL AUTO_INCREMENT primary key,
    category_id INT NOT NULL,
    `name` VARCHAR(350),
    price INT,
    amount_of INT,
    `description` VARCHAR(1000),
    
    FOREIGN KEY (category_id) REFERENCES category(id)
);

create table person (
	id INT NOT NULL AUTO_INCREMENT primary key,
    `surname` VARCHAR(100),
	`name` VARCHAR(100),
    `patronymic` VARCHAR(100)
);

create table `user` (
	id INT NOT NULL AUTO_INCREMENT primary key,
    person_id INT NOT NULL,
	`login` VARCHAR(100),
    `password` VARCHAR(50),
    
    FOREIGN KEY (person_id) REFERENCES person(id)
);

create table bucket(
	id INT NOT NULL AUTO_INCREMENT primary key,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    amountOf INT,
    
    FOREIGN KEY (user_id) REFERENCES `user`(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
);



-- ЗАПОЛНЕНИЕ ТАБЛИЦ:

-- Заполнение таблицы категорий (с иерархией через parent_id)
INSERT INTO category (parent_id, name) VALUES
-- Корневые категории (parent_id = NULL)
(NULL, 'Электроника'),
(NULL, 'Бытовая техника'),
(NULL, 'Одежда'),
(NULL, 'Книги'),

-- Подкатегории для Электроники (parent_id = 1)
(1, 'Смартфоны и гаджеты'),
(1, 'Компьютеры и ноутбуки'),
(1, 'Телевизоры и аудио'),
(1, 'Фототехника'),

-- Подкатегории для Бытовая техника (parent_id = 2)
(2, 'Крупная бытовая техника'),
(2, 'Малая бытовая техника'),
(2, 'Климатическая техника'),

-- Подкатегории для Одежда (parent_id = 3)
(3, 'Мужская одежда'),
(3, 'Женская одежда'),
(3, 'Детская одежда'),

-- Подкатегории для Книги (parent_id = 4)
(4, 'Художественная литература'),
(4, 'Научная и образовательная'),
(4, 'Детские книги'),

-- Вложенные подкатегории для Смартфоны и гаджеты (parent_id = 5)
(5, 'Смартфоны'),
(5, 'Планшеты'),
(5, 'Умные часы'),

-- Вложенные подкатегории для Компьютеры и ноутбуки (parent_id = 6)
(6, 'Ноутбуки'),
(6, 'Стационарные компьютеры'),
(6, 'Комплектующие'),

-- Вложенные подкатегории для Крупная бытовая техника (parent_id = 9)
(9, 'Холодильники'),
(9, 'Стиральные машины'),
(9, 'Плиты и духовки'),

-- Вложенные подкатегории для Мужская одежда (parent_id = 10)
(10, 'Верхняя одежда'),
(10, 'Брюки и джинсы'),
(10, 'Футболки и рубашки');

-- Заполнение таблицы товаров
INSERT INTO product (category_id, name, price, amount_of, description) VALUES
-- Смартфоны (category_id = 14)
(14, 'iPhone 15 Pro', 99990, 15, 'Флагманский смартфон Apple с титановым корпусом и камерой 48 МП'),
(14, 'Samsung Galaxy S24', 84990, 12, 'Смартфон с искусственным интеллектом и мощным процессором'),
(14, 'Xiaomi Redmi Note 13', 25990, 25, 'Бюджетный смартфон с AMOLED-дисплеем и хорошей камерой'),

-- Планшеты (category_id = 15)
(15, 'iPad Air 5', 59990, 8, 'Планшет Apple с чипом M1 и поддержкой Apple Pencil'),
(15, 'Samsung Galaxy Tab S9', 74990, 6, 'Мощный планшет с дисплеем Super AMOLED'),

-- Умные часы (category_id = 16)
(16, 'Apple Watch Series 9', 32990, 20, 'Умные часы с функцией измерения температуры'),
(16, 'Samsung Galaxy Watch 6', 27990, 18, 'Смарт-часы с отслеживанием здоровья и фитнеса'),

-- Ноутбуки (category_id = 17)
(17, 'MacBook Air M3', 119990, 10, 'Легкий и мощный ноутбук с чипом Apple M3'),
(17, 'Dell XPS 13', 89990, 7, 'Ультрабук с безрамочным дисплеем и высокой производительностью'),
(17, 'ASUS ROG Strix', 149990, 6, 'Игровой ноутбук с мощной видеокартой'),

-- Стационарные компьютеры (category_id = 18)
(18, 'Игровой ПК ASUS', 89990, 4, 'Готовый игровой компьютер с RTX 4060'),
(18, 'Mac Mini M2', 69990, 8, 'Компактный настольный компьютер от Apple'),

-- Холодильники (category_id = 22)
(22, 'Холодильник Samsung Side-by-Side', 129990, 5, 'Большой холодильник с системой No Frost'),
(22, 'Холодильник LG с инверторным компрессором', 89990, 7, 'Энергоэффективный холодильник с низким уровнем шума'),

-- Стиральные машины (category_id = 23)
(23, 'Стиральная машина Bosch', 54990, 9, 'Стиральная машина с загрузкой 7 кг и сушкой'),
(23, 'Стиральная машина Indesit', 32990, 12, 'Надежная и недорогая стиральная машина'),

-- Верхняя одежда мужская (category_id = 25)
(25, 'Зимняя куртка The North Face', 19990, 15, 'Теплая куртка для зимних видов спорта'),
(25, 'Дождевик Columbia', 8990, 20, 'Легкая непромокаемая куртка'),

-- Брюки и джинсы (category_id = 26)
(26, 'Джинсы Levis 501', 5990, 30, 'Классические прямые джинсы'),
(26, 'Брюки спортивные Nike', 4590, 25, 'Удобные спортивные брюки для тренировок'),

-- Художественная литература (category_id = 13)
(13, 'Мастер и Маргарита', 890, 50, 'Роман Михаила Булгакова'),
(13, '1984', 750, 40, 'Антиутопия Джорджа Оруэлла'),

-- Научная литература (category_id = 14)
(14, 'Краткая история времени', 1200, 20, 'Стивен Хокинг о природе Вселенной'),
(14, 'Sapiens: Краткая история человечества', 1500, 25, 'Юваль Ной Харари о развитии человечества');

-- Заполнение таблицы персоналий
INSERT INTO person (surname, name, patronymic) VALUES
('Иванов', 'Алексей', 'Петрович'),
('Смирнова', 'Мария', 'Ивановна'),
('Петров', 'Дмитрий', 'Сергеевич'),
('Козлова', 'Анна', 'Владимировна'),
('Сидоров', 'Иван', 'Николаевич'),
('Васильева', 'Елена', 'Александровна');

-- Заполнение таблицы пользователей
INSERT INTO user (person_id, login, password) VALUES
(1, 'alex_ivanov', 'pass123'),
(2, 'maria_smirnova', 'qwerty456'),
(3, 'dmitry_petrov', 'password789'),
(4, 'anna_kozlova', 'anna2024'),
(5, 'ivan_sidorov', 'ivan_pass'),
(6, 'elena_vasilieva', 'elena123');

-- Заполнение таблицы корзины (используем только существующие product_id)
INSERT INTO bucket (user_id, product_id, amountOf) VALUES
(1, 3, 1),  -- Алексей добавил Xiaomi Redmi Note 13 (id=3)
(1, 6, 1),  -- Алексей добавил Apple Watch Series 9 (id=6)
(2, 1, 1),  -- Мария добавила iPhone 15 Pro (id=1)
(3, 8, 1),  -- Дмитрий добавил MacBook Air M3 (id=8)
(3, 24, 2), -- Дмитрий добавил 2 экземпляра книги "1984" (id=24)
(4, 18, 1), -- Анна добавила стиральную машину Bosch (id=18)
(5, 20, 1); -- Иван добавил зимнюю куртку The North Face (id=20)
