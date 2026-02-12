SELECT `city_name`, `province` FROM `cities` WHERE 1;
-- to select cities and province

SELECT `city_name`, `province` FROM `cities` LIMIT 5;
-- only 5 records returned

SELECT `city_name`, `province` FROM `cities` WHERE province = 'ab';
--

SELECT `city_name`, `province`, population FROM `cities` order by population DESC;
--

SELECT city_name FROM 'cities' where province = 'on' AND population > 1000000;
--

SELECT * FROM `cities` where `is_capital` = 1;
-- all capital cities

SELECT * FROM `cities` WHERE (`province` = 'ns' or `province` = 'nb') and is_capital = true;
-- maritime capital cities

--smallest city