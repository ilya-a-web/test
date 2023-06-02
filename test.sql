SELECT u.*, COUNT(p.id) AS phone_count
FROM users u
LEFT JOIN phone_numbers p ON p.user_id = u.id
WHERE u.gender = 2 AND YEAR(NOW()) - FROM_UNIXTIME(u.birth_date,'%Y') BETWEEN 18 AND 22
GROUP BY u.id;