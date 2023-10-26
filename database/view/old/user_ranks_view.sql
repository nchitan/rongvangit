-- Tao xong cho weekly
drop view if exists user_rank_weekly;
CREATE VIEW user_rank_weekly AS
with temp as(
SELECT users.name as username, ifnull(users.profile_photo_path,'') as profile_photo_path,
ifnull(post_count, 0) as post_count,
ifnull(questions_count, 0) as questions_count,
ifnull(answears_count, 0) as answears_count,
ifnull(comments_count, 0) as comments_count,
ifnull(post_like_count, 0) as post_like_count,
ifnull(question_like_count, 0) as question_like_count,
ifnull(answear_like_count, 0) as answear_like_count,
ifnull(comment_like_count, 0) as comment_like_count

FROM users
LEFT JOIN(
  SELECT posts.username,
  COUNT(IF( posts.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , posts.created_at , null )) as post_count
  FROM posts
  WHERE posts.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
  GROUP BY posts.username
) AS post_count
ON post_count.username = users.name
LEFT JOIN(
  SELECT questions.username,
  COUNT(IF( questions.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , questions.created_at , null )) as questions_count
  FROM questions
  WHERE questions.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
  GROUP BY questions.username
) AS questions_count
ON questions_count.username = users.name
LEFT JOIN(
  SELECT answears.username,
  COUNT(IF( answears.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , answears.created_at , null )) as answears_count
  FROM answears
  WHERE answears.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
  GROUP BY answears.username
) AS answears_count
ON answears_count.username = users.name
LEFT JOIN(
  SELECT comments.username,
  COUNT(IF( comments.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , comments.created_at , null )) as comments_count
  FROM comments
  WHERE comments.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
  GROUP BY comments.username
) AS comments_count
ON comments_count.username = users.name


LEFT JOIN(
  SELECT post_likes.like_username,
  COUNT(IF( post_likes.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , post_likes.created_at , null )) as post_like_count
  FROM post_likes
  WHERE post_likes.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
  GROUP BY post_likes.like_username
) AS post_like_count
ON post_like_count.like_username = users.name
LEFT JOIN(
  SELECT question_likes.like_username,
  COUNT(IF( question_likes.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , question_likes.created_at , null )) as question_like_count
  FROM question_likes
  WHERE question_likes.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
  GROUP BY question_likes.like_username
) AS question_like_count
ON question_like_count.like_username = users.name

LEFT JOIN(
  SELECT answear_likes.like_username,
  COUNT(IF( answear_likes.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , answear_likes.created_at , null )) as answear_like_count
  FROM answear_likes
  WHERE answear_likes.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
  GROUP BY answear_likes.like_username
) AS answear_like_count
ON answear_like_count.like_username = users.name
LEFT JOIN(
  SELECT comment_likes.like_username,
  COUNT(IF( comment_likes.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , comment_likes.created_at , null )) as comment_like_count
  FROM comment_likes
  WHERE comment_likes.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
  GROUP BY comment_likes.like_username
) AS comment_like_count
ON comment_like_count.like_username = users.name

GROUP BY users.name, profile_photo_path 
LIMIT 10 
)
select temp.username, temp.profile_photo_path,
(post_count +(comments_count+questions_count)*0.1+answears_count*0.2 + post_like_count + (question_like_count + answear_like_count + comment_like_count)*0.5) as contribution
from temp
ORDER BY contribution



## Tao cho monthly
drop view if exists user_rank_monthly;
CREATE VIEW user_rank_monthly AS
with temp as(
SELECT users.name as username, ifnull(users.profile_photo_path,'') as profile_photo_path,
ifnull(post_count, 0) as post_count,
ifnull(questions_count, 0) as questions_count,
ifnull(answears_count, 0) as answears_count,
ifnull(comments_count, 0) as comments_count,
ifnull(post_like_count, 0) as post_like_count,
ifnull(question_like_count, 0) as question_like_count,
ifnull(answear_like_count, 0) as answear_like_count,
ifnull(comment_like_count, 0) as comment_like_count

FROM users
LEFT JOIN(
  SELECT posts.username,
  COUNT(IF( posts.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , posts.created_at , null )) as post_count
  FROM posts
  WHERE posts.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
  GROUP BY posts.username
) AS post_count
ON post_count.username = users.name
LEFT JOIN(
  SELECT questions.username,
  COUNT(IF( questions.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , questions.created_at , null )) as questions_count
  FROM questions
  WHERE questions.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
  GROUP BY questions.username
) AS questions_count
ON questions_count.username = users.name


LEFT JOIN(
  SELECT answears.username,
  COUNT(IF( answears.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , answears.created_at , null )) as answears_count
  FROM answears
  WHERE answears.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
  GROUP BY answears.username
) AS answears_count
ON answears_count.username = users.name
LEFT JOIN(
  SELECT comments.username,
  COUNT(IF( comments.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , comments.created_at , null )) as comments_count
  FROM comments
  WHERE comments.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
  GROUP BY comments.username
) AS comments_count
ON comments_count.username = users.name


LEFT JOIN(
  SELECT post_likes.like_username,
  COUNT(IF( post_likes.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , post_likes.created_at , null )) as post_like_count
  FROM post_likes
  WHERE post_likes.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
  GROUP BY post_likes.like_username
) AS post_like_count
ON post_like_count.like_username = users.name
LEFT JOIN(
  SELECT question_likes.like_username,
  COUNT(IF( question_likes.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , question_likes.created_at , null )) as question_like_count
  FROM question_likes
  WHERE question_likes.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
  GROUP BY question_likes.like_username
) AS question_like_count
ON question_like_count.like_username = users.name

LEFT JOIN(
  SELECT answear_likes.like_username,
  COUNT(IF( answear_likes.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , answear_likes.created_at , null )) as answear_like_count
  FROM answear_likes
  WHERE answear_likes.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
  GROUP BY answear_likes.like_username
) AS answear_like_count
ON answear_like_count.like_username = users.name
LEFT JOIN(
  SELECT comment_likes.like_username,
  COUNT(IF( comment_likes.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , comment_likes.created_at , null )) as comment_like_count
  FROM comment_likes
  WHERE comment_likes.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
  GROUP BY comment_likes.like_username
) AS comment_like_count
ON comment_like_count.like_username = users.name
GROUP BY users.name
LIMIT 10 
)select temp.username, temp.profile_photo_path,
(post_count +(comments_count+questions_count)*0.1+answears_count*0.2 + post_like_count + (question_like_count + answear_like_count + comment_like_count)*0.5) as contribution
from temp
GROUP BY username, profile_photo_path,contribution
ORDER BY contribution



#Tao all
drop view if exists user_rank_total;
CREATE VIEW user_rank_total AS
with temp as(
SELECT users.name as username, ifnull(users.profile_photo_path,'') as profile_photo_path,
ifnull(post_count, 0) as post_count,
ifnull(questions_count, 0) as questions_count,
ifnull(answears_count, 0) as answears_count,
ifnull(comments_count, 0) as comments_count,
ifnull(post_like_count, 0) as post_like_count,
ifnull(question_like_count, 0) as question_like_count,
ifnull(answear_like_count, 0) as answear_like_count,
ifnull(comment_like_count, 0) as comment_like_count

FROM users
LEFT JOIN(
  SELECT posts.username,
  COUNT(posts.created_at ) as post_count
  FROM posts

  GROUP BY posts.username
) AS post_count
ON post_count.username = users.name
LEFT JOIN(
  SELECT questions.username,
  COUNT(questions.created_at) as questions_count
  FROM questions

  GROUP BY questions.username
) AS questions_count
ON questions_count.username = users.name


LEFT JOIN(
  SELECT answears.username,
  COUNT(answears.created_at ) as answears_count
  FROM answears

  GROUP BY answears.username
) AS answears_count
ON answears_count.username = users.name
LEFT JOIN(
  SELECT comments.username,
  COUNT(comments.created_at  ) as comments_count
  FROM comments

  GROUP BY comments.username
) AS comments_count
ON comments_count.username = users.name


LEFT JOIN(
  SELECT post_likes.like_username,
  COUNT(post_likes.created_at ) as post_like_count
  FROM post_likes

  GROUP BY post_likes.like_username
) AS post_like_count
ON post_like_count.like_username = users.name
LEFT JOIN(
  SELECT question_likes.like_username,
  COUNT(question_likes.created_at  ) as question_like_count
  FROM question_likes

  GROUP BY question_likes.like_username
) AS question_like_count
ON question_like_count.like_username = users.name

LEFT JOIN(
  SELECT answear_likes.like_username,
  COUNT(answear_likes.created_at ) as answear_like_count
  FROM answear_likes

  GROUP BY answear_likes.like_username
) AS answear_like_count
ON answear_like_count.like_username = users.name
LEFT JOIN(
  SELECT comment_likes.like_username,
  COUNT(comment_likes.created_at ) as comment_like_count
  FROM comment_likes
 
  GROUP BY comment_likes.like_username
) AS comment_like_count
ON comment_like_count.like_username = users.name
GROUP BY users.name
LIMIT 10 
)select temp.username, temp.profile_photo_path,
(post_count +(comments_count+questions_count)*0.1+answears_count*0.2 + post_like_count + (question_like_count + answear_like_count + comment_like_count)*0.5) as contribution
from temp
ORDER BY contribution