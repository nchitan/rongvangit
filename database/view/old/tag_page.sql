******

SELECT  users.name,post_count,questions_count,comments_count
FROM users
LEFT JOIN (
    SELECT post_tag_grps.username, count(post_tag_grps.item) as post_count
    FROM post_tag_grps
    WHERE post_tag_grps.tag_name ='php'
    AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
    GROUP BY username,tag_name
) AS post_count
ON post_count.username = users.name


LEFT JOIN(
    SELECT question_tag_grps.username, count(question_tag_grps.item) as questions_count
    FROM question_tag_grps
    WHERE question_tag_grps.tag_name ='php'
    AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
    GROUP BY username,tag_name
) AS questions_count
ON questions_count.username = users.name

LEFT JOIN(
	SELECT comments.username,tag_count as comments_count
	FROM comments
	LEFT JOIN (
		SELECT post_tag_grps.item as item, count(post_tag_grps.tag_name) as tag_count
		FROM post_tag_grps
		WHERE post_tag_grps.tag_name ='php' 
		AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
		GROUP BY item
	) AS tag_count
	ON tag_count.item = comments.item
) AS comments_count
ON comments_count.username = users.name

GROUP BY users.name,post_count,questions_count,comments_count

LEFT JOIN(
	SELECT answears.username,tag_count as answear_count
	FROM answears
	LEFT JOIN (
		SELECT question_tag_grps.item as item, count(question_tag_grps.tag_name) as tag_count
		FROM question_tag_grps
		WHERE question_tag_grps.tag_name ='php' 
		AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
		GROUP BY item
	) AS tag_count
	ON tag_count.item = answears.item
) AS answear_count
ON answear_count.username = users.name

GROUP BY users.name,post_count,questions_count,comments_count,answear_count

*****
LEFT JOIN(
	SELECT answears.username,tag_count as answear_count
	FROM answears
	LEFT JOIN (
		SELECT question_tag_grps.item as item, count(question_tag_grps.tag_name) as tag_count
		FROM question_tag_grps
		WHERE question_tag_grps.tag_name ='php' 
		AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
		GROUP BY item
	) AS tag_count
	ON tag_count.item = answears.item
) AS answear_count
ON answear_count.username = users.name






LEFT JOIN(

    SELECT comments.username, count(question_tag_grps.item) as questions_count
    FROM question_tag_grps
    WHERE question_tag_grps.tag_name ='php'
    AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
    GROUP BY username,tag_name
) AS questions_count
ON questions_count.username = users.name





SELECT post_tag_grps.username
FROM post_tag_grps
LEFT JOIN


SELECT comments.username,cout_tag
FROM comments
LEFT JOIN (
	SELECT post_tag_grps.item as item, count(post_tag_grps.tag_name) as cout_tag
	FROM post_tag_grps
	WHERE post_tag_grps.tag_name ='php' 
	AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
	GROUP BY item
) AS temp_tbl
ON temp_tbl.item = comments.item



















