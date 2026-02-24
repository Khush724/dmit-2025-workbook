--update the population and trivia of city id 20
Update cities
    set trivia = 'This city is known for the beautiful parks',
    population = 12345
    Where cid = 20;


-- increase the population of all cities in AB and 5K by 1000
-- Update cities
--     set population = population + 1000
--     Where province = 'AB' or province = 'SK';
Update cities
    set population = population + 1000
    Where province in ('ab','sk') ;

