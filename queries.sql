INSERT INTO category (alias, categories) VALUES
  ('boards', 'Доски и лыжи'),
  ('attachment', 'Крепления'),
  ('boots', 'Ботинки'),
  ('clothing', 'Одежда'),
  ('tools', 'Инструменты'),
  ('other', 'Разное');

INSERT INTO users (registration_date, email, name, password, avatar, contacts) VALUES
  ('2018-10-30 00:00:00', 'vasya@gmail.com', 'Вася', 'Vasyasuper', 'www.avatar/01.jpg', '88005553535'),
  ('2018-10-15 10:10:00', 'sasha.m@gmail.com','Aleksandra Markova', '123q321', 'www.avatar/02.jpg', '+79771234567'),
  ('2018-10-20 03:01:00', 'alex@yandex.ru', 'Alex', 'qwert', 'www.avatar/03.jpg', '+79771232121');

INSERT INTO lot (category_id, user_id_winner, user_id_autor, name, creatiom_date, end_date, description, image, init_price, step) VALUES
  ('1', '2', '1', '2014 Rossignol District Snowboard', '2018-12-01 00:00:00', '2018-12-11 00:00:00', 'В идеальном состоянии', 'img/lot-1.jpg', '10999', '100'),
  ('1', '3', '1', 'DC Ply Mens 2016/2017 Snowboard', '2018-12-05 10:10:00', '2018-12-15 10:10:00', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег.', 'img/lot-2.jpg', '159999', '2000'),
  ('2', '2', '1', 'Крепления Union Contact Pro 2015 года размер L/XL', '2018-12-12 11:10:00', '2018-12-22 11:10:00', 'б/у', 'img/lot-3.jpg', '8000', '500'),
  ('3', '2', '1', 'Ботинки для сноуборда DC Mutiny Charocal', '2018-12-13 14:10:00', '2018-12-23 14:10:00', '39 размер новые, не подошли', 'img/lot-4.jpg', '10999', '1000'),
  ('4', '1', '2', 'Куртка для сноуборда DC Mutiny Charocal', '2018-12-13 14:20:00', '2018-12-23 14:20:00', 'xs', 'img/lot-5.jpg', '7500', '500'),
  ('6', '3', '2', 'Маска Oakley Canopy', '2018-12-13 14:20:00', '2018-12-23 14:20:00', 'маска супер', 'img/lot-6.jpg', '5400', '100');

INSERT INTO bid (lot_id, date, sum_prise) VALUES
  ('1', '2018-12-01 01:10:00', '11099'),
  ('1', '2018-12-01 01:30:00', '11199'),
  ('1', '2018-12-01 03:10:00', '11299');

  /* получить все категории*/
SELECT * FROM category;

  /*получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории. По этой схеме у меня открывает несколько раз лот с несколькими ставками, хотела вставить max() но не вышло*/
SELECT name, init_price, image, category.title, sum_price
FROM lot
LEFT  JOIN category
ON  category_id=category.id
left JOIN bid
ON lot.id=bid.lot_id
WHERE end_date >"2018-11-12 00:00:00";

  /*показать лот по его id. Получите также название категории, к которой принадлежит лот*/
SELECT lot.id ,category_id, user_id_winner, user_id_autor, name, creatiom_date , end_date , image, init_price,step, category.title FROM lot
JOIN category
ON  category_id=category.id
where lot.id=2;

 /*обновить название лота по его идентификатору*/
 UPDATE lot SET name='2015 Rossignol Snowboard'
 WHERE id=1;
 /*получить список самых свежих ставок для лота по его идентификатору*/
 SELECT * FROM bid WHERE lot_id=1;
