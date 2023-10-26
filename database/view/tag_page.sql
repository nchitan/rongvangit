******
with temp as
(

SELECT  users.name as username, ifnull(users.profile_photo_path,'') as profile_photo_path, post_count,questions_count,comments_count,answears_count,self_like_answear_count,self_like_comment_count,self_like_post_count,self_like_question_count
FROM users
LEFT JOIN (
    SELECT post_tag_grps.username, count(post_tag_grps.item) as post_count
    FROM post_tag_grps
    WHERE post_tag_grps.tag_name ='PHP'
    AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
    GROUP BY username,tag_name
) AS post_count
ON post_count.username = users.name


LEFT JOIN(
    SELECT question_tag_grps.username, count(question_tag_grps.item) as questions_count
    FROM question_tag_grps
    WHERE question_tag_grps.tag_name ='PHP'
    AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
    GROUP BY username,tag_name
) AS questions_count
ON questions_count.username = users.name

LEFT JOIN(
	SELECT comments.username,count(tag_count) as comments_count
	FROM comments
	LEFT JOIN (
		SELECT post_tag_grps.item as item, count(post_tag_grps.tag_name) as tag_count
		FROM post_tag_grps
		WHERE post_tag_grps.tag_name ='PHP' 
		AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
		GROUP BY item
	) AS tag_count
	ON tag_count.item = comments.item
    GROUP BY comments.username
) AS comments_count
ON comments_count.username = users.name

LEFT JOIN(
    SELECT answears.username,count(tag_count) as answears_count
    FROM answears

    LEFT JOIN (
        SELECT question_tag_grps.username as username,question_tag_grps.item as item, count(question_tag_grps.tag_name) as tag_count
        FROM question_tag_grps
        WHERE question_tag_grps.tag_name ='PHP' 
        AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
        GROUP BY username,item
    ) AS tag_count
    ON tag_count.item = answears.item
    GROUP BY username
) AS answears_count
ON answears_count.username = users.name
LEFT JOIN(

    SELECT answear_likes.like_username as like_username,count(tag_count) as self_like_answear_count
    FROM answear_likes

    LEFT JOIN (
        SELECT question_tag_grps.item as item, count(question_tag_grps.tag_name) as tag_count
        FROM question_tag_grps
        WHERE question_tag_grps.tag_name ='PHP' 
        AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
        GROUP BY item
    ) AS tag_count
    ON tag_count.item = answear_likes.item
    WHERE answear_likes.like_username =answear_likes.author
    GROUP BY like_username
) AS self_like_answear_count
ON self_like_answear_count.like_username = users.name
LEFT JOIN(

    SELECT comment_likes.like_username as like_username,count(tag_count) as self_like_comment_count
    FROM comment_likes

    LEFT JOIN (
        SELECT post_tag_grps.item as item, count(post_tag_grps.tag_name) as tag_count
        FROM post_tag_grps
        WHERE post_tag_grps.tag_name ='PHP' 
        AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
        GROUP BY item
    ) AS tag_count
    ON tag_count.item = comment_likes.item
    WHERE comment_likes.like_username = comment_likes.author
    GROUP BY like_username
) AS self_like_comment_count
ON self_like_comment_count.like_username = users.name
LEFT JOIN(
    SELECT post_likes.like_username as like_username,count(tag_count) as self_like_post_count
    FROM post_likes
    LEFT JOIN (
        SELECT post_tag_grps.item as item, count(post_tag_grps.tag_name) as tag_count
        FROM post_tag_grps
        WHERE post_tag_grps.tag_name ='PHP' 
        AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
        GROUP BY item
    ) AS tag_count
    ON tag_count.item = post_likes.item
    WHERE post_likes.like_username =post_likes.author
    GROUP BY like_username
) AS self_like_post_count
ON self_like_post_count.like_username = users.name
LEFT JOIN(
    SELECT question_likes.like_username as like_username,count(tag_count) as self_like_question_count
    FROM question_likes
    LEFT JOIN (
        SELECT question_tag_grps.item as item, count(question_tag_grps.tag_name) as tag_count
        FROM question_tag_grps
        WHERE question_tag_grps.tag_name ='PHP' 
        AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
        GROUP BY item
    ) AS tag_count
    ON tag_count.item = question_likes.item
    WHERE question_likes.like_username =question_likes.author
    GROUP BY like_username
) AS self_like_question_count
ON self_like_question_count.like_username = users.name
)
select temp.username, temp.profile_photo_path,
(post_count +(comments_count+questions_count)*0.1+answears_count*0.2 + self_like_post_count + (self_like_question_count + self_like_answear_count + self_like_comment_count)*0.5) as contribution
from temp
ORDER BY contribution desc

******



post_count,questions_count,comments_count,answears_count,self_like_answear_count,self_like_comment_count,self_like_post_count,self_like_question_count
LEFT JOIN(

    SELECT question_likes.like_username as like_username,count(tag_count) as self_like_question_count
    FROM question_likes

    LEFT JOIN (
        SELECT question_tag_grps.item as item, count(question_tag_grps.tag_name) as tag_count
        FROM question_tag_grps
        WHERE question_tag_grps.tag_name ='PHP' 
        AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
        GROUP BY item
    ) AS tag_count
    ON tag_count.item = question_likes.item
    WHERE question_likes.like_username =question_likes.author
    GROUP BY like_username
) AS self_like_question_count
ON self_like_question_count.like_username = users.name










