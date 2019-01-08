INSERT INTO `e_shop_exam`.`roles` (`name`) VALUES ('ROLE_ADMIN');
INSERT INTO `e_shop_exam`.`roles` (`name`) VALUES ('ROLE_EDITOR');
INSERT INTO `e_shop_exam`.`roles` (`name`) VALUES ('ROLE_USER');

INSERT INTO `e_shop_exam`.`categories` (`name`) VALUES ('Summer tyre');
INSERT INTO `e_shop_exam`.`categories` (`name`) VALUES ('Winter tyre');
INSERT INTO `e_shop_exam`.`categories` (`name`) VALUES ('All seasons tyre');


INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('3', '2', 'Barum', 'Polaris 3', '145', '80', '13', '51.00', '4', 'T', '75', '2019-01-08 08:20:19', '3216f15df01cddf56a1bee855ee54971.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('3', '2', 'Barum', 'Polaris 4', '155', '65', '13', '53.00', '8', 'T', '73', '2019-01-08 08:34:19', '3216f15df01cddf56a1bee855ee54971.png', '4');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Tigar', 'Winter 1', '145', '80', '13', '48.00', '4', 'Q', '75', '2019-01-08 08:50:19', 'd1685eec0069c587616748d30e9df0e4.png', '1');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Debica', 'Frigo 2', '165', '65', '14', '55.00', '10', 'T', '71', '2019-01-08 08:55:19', '5a623ea7372d8d95cefb459d107c2aae.png', '3');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'General Tyre', 'Altimax winter 3', '155', '70', '13', '58.90', '6', 'T', '75', '2019-01-08 08:55:19', '522e5b6d63a2405bb04f474a56a556d1.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Semperit', 'Master grip 2', '145', '80', '13', '61.90', '2', 'T', '75', '2019-01-08 08:55:19', '197f20dc990d6e3933f7c679e7d623cb.png', '2');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('2', '3', 'Continental', 'Winter contact TS', '175', '65', '14', '74.00', '4', 'T', '82', '2019-01-08 08:20:19', '3216f15df01cddf56a1bee855ee54971.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('2', '1', 'Michelin', 'Alpin A3', '155', '65', '14', '87.50', '4', 'T', '75', '2019-01-08 08:34:19', '3216f15df01cddf56a1bee855ee54971.png', '4');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('3', '2', 'Michelin', ' Alpin 5', '195', '65', '15', '48.00', '4', 'T', '97.80', '2019-01-08 08:50:19', 'd1685eec0069c587616748d30e9df0e4.png', '1');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Michelin', 'A4 GRNX XL', '185', '60', '15', '102.00', '2', 'T', '88', '2019-01-08 08:55:19', '5a623ea7372d8d95cefb459d107c2aae.png', '3');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('4', '1', 'Dunlop', 'SP Winter Sport 4D', '215', '55', '16', '112.40', '15', 'H', '97', '2019-01-08 08:55:19', '522e5b6d63a2405bb04f474a56a556d1.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('5', '3', 'Dunlop', 'Winter Sport 5 XL', '215', '60', '16', '135.00', '22', 'H', '99', '2019-01-08 08:55:19', '197f20dc990d6e3933f7c679e7d623cb.png', '2');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('5', '1', 'Barum', 'Polaris 3', '145', '80', '13', '51.00', '4', 'T', '75', '2019-01-08 08:20:19', '3216f15df01cddf56a1bee855ee54971.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Dunlop', 'Winter Max Speed', '155', '65', '13', '53.00', '8', 'T', '73', '2019-01-08 08:34:19', '3216f15df01cddf56a1bee855ee54971.png', '4');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('2', '3', 'Pirelli', 'Cinturato', '195', '65', '15', '48.00', '4', 'Q', '75', '2019-01-08 08:50:19', 'd1685eec0069c587616748d30e9df0e4.png', '1');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('3', '1', 'Goodyear', 'Ultra Grip 9', '175', '65', '15', '55.00', '10', 'T', '81', '2019-01-08 08:55:19', '5a623ea7372d8d95cefb459d107c2aae.png', '3');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('4', '2', 'Goodyear', 'Ultra Performance 9', '205', '60', '16', '58.90', '12', 'H', '92', '2019-01-08 08:55:19', '522e5b6d63a2405bb04f474a56a556d1.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('5', '3', 'Semperit', 'Master grip 2', '145', '80', '13', '78.90', '5', 'H', '80', '2019-01-08 08:55:19', '197f20dc990d6e3933f7c679e7d623cb.png', '2');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '1', 'BFGoodrich', 'G Sport', '225', '60', '17', '145.00', '4', 'S', '99', '2019-01-08 08:20:19', '3216f15df01cddf56a1bee855ee54971.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('2', '3', 'Michelin', 'Alpin A3', '205', '55', '16', '112.50', '40', 'H', '80', '2019-01-08 08:34:19', '3216f15df01cddf56a1bee855ee54971.png', '4');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('3', '2', 'Michelin', ' Alpin 5', '195', '65', '15', '48.00', '4', 'T', '97.80', '2019-01-08 08:50:19', 'd1685eec0069c587616748d30e9df0e4.png', '1');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('4', '3', 'Michelin', 'A4 GRNX XL', '185', '60', '15', '102.00', '2', 'T', '88', '2019-01-08 08:55:19', '5a623ea7372d8d95cefb459d107c2aae.png', '3');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('5', '2', 'Dunlop', 'SP Winter Sport 4D', '215', '55', '16', '112.40', '15', 'H', '97', '2019-01-08 08:55:19', '522e5b6d63a2405bb04f474a56a556d1.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Dunlop', 'Winter Sport 5 XL', '215', '60', '16', '135.00', '22', 'H', '99', '2019-01-08 08:55:19', '197f20dc990d6e3933f7c679e7d623cb.png', '2');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('5', '1', 'Barum', 'Polaris 3', '145', '80', '13', '51.00', '4', 'T', '75', '2019-01-08 08:20:19', '3216f15df01cddf56a1bee855ee54971.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Dunlop', 'Winter Max Speed', '155', '65', '13', '53.00', '8', 'T', '73', '2019-01-08 08:34:19', '3216f15df01cddf56a1bee855ee54971.png', '4');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('2', '3', 'Pirelli', 'Cinturato', '195', '65', '15', '48.00', '4', 'Q', '75', '2019-01-08 08:50:19', 'd1685eec0069c587616748d30e9df0e4.png', '1');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('3', '1', 'Goodyear', 'Ultra Grip 9', '175', '65', '15', '55.00', '10', 'T', '81', '2019-01-08 08:55:19', '5a623ea7372d8d95cefb459d107c2aae.png', '3');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('4', '2', 'Goodyear', 'Ultra Performance 9', '205', '60', '16', '58.90', '12', 'H', '92', '2019-01-08 08:55:19', '522e5b6d63a2405bb04f474a56a556d1.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('5', '3', 'Semperit', 'Master grip 2', '145', '80', '13', '78.90', '5', 'H', '80', '2019-01-08 08:55:19', '197f20dc990d6e3933f7c679e7d623cb.png', '2');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '1', 'BFGoodrich', 'G Sport', '225', '60', '17', '145.00', '4', 'S', '99', '2019-01-08 08:20:19', '3216f15df01cddf56a1bee855ee54971.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('2', '3', 'Michelin', 'Alpin A3', '205', '55', '15', '120.00', '40', 'H', '80', '2019-01-08 08:34:19', '3216f15df01cddf56a1bee855ee54971.png', '4');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('3', '2', 'Michelin', ' Alpin 5', '195', '65', '15', '48.00', '4', 'T', '97.80', '2019-01-08 08:50:19', 'd1685eec0069c587616748d30e9df0e4.png', '1');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('4', '3', 'Michelin', 'A4 GRNX XL', '185', '60', '15', '102.00', '2', 'T', '88', '2019-01-08 08:55:19', '5a623ea7372d8d95cefb459d107c2aae.png', '3');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('5', '2', 'Dunlop', 'SP Winter Sport 4D', '215', '55', '16', '112.40', '15', 'H', '97', '2019-01-08 08:55:19', '522e5b6d63a2405bb04f474a56a556d1.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Dunlop', 'Winter Sport 5 XL', '215', '60', '16', '135.00', '22', 'H', '99', '2019-01-08 08:55:19', '197f20dc990d6e3933f7c679e7d623cb.png', '2');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'General Tyre', 'Altimax winter 3', '155', '70', '13', '58.90', '6', 'T', '75', '2019-01-08 08:55:19', '522e5b6d63a2405bb04f474a56a556d1.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Semperit', 'Master grip 2', '145', '80', '13', '61.90', '2', 'T', '75', '2019-01-08 08:55:19', '197f20dc990d6e3933f7c679e7d623cb.png', '2');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('2', '3', 'Continental', 'Winter contact TS', '175', '65', '14', '74.00', '4', 'T', '82', '2019-01-08 08:20:19', '3216f15df01cddf56a1bee855ee54971.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('2', '1', 'Michelin', 'Alpin A3', '155', '65', '14', '87.50', '4', 'T', '75', '2019-01-08 08:34:19', '3216f15df01cddf56a1bee855ee54971.png', '4');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('3', '2', 'Michelin', ' Alpin 5', '195', '65', '15', '48.00', '4', 'T', '97.80', '2019-01-08 08:50:19', 'd1685eec0069c587616748d30e9df0e4.png', '1');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('1', '2', 'Michelin', 'A4 GRNX XL', '185', '60', '15', '102.00', '2', 'T', '88', '2019-01-08 08:55:19', '5a623ea7372d8d95cefb459d107c2aae.png', '3');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('4', '1', 'Dunlop', 'SP Winter Sport 4D', '215', '55', '16', '112.40', '15', 'H', '97', '2019-01-08 08:55:19', '522e5b6d63a2405bb04f474a56a556d1.png', '0');
INSERT INTO `e_shop_exam`.`tyres` (`seller_id`, `category_id`, `make`, `model`, `width`, `height`, `diameter`, `price`, `quantity`, `speedIndex`, `loadIndex`, `createDate`, `image`, `view_count`)
VALUES ('5', '3', 'Dunlop', 'Winter Sport 5 XL', '215', '60', '16', '135.00', '22', 'H', '99', '2019-01-08 08:55:19', '197f20dc990d6e3933f7c679e7d623cb.png', '2');
