drop view if exists user_rank_weekly;
CREATE VIEW user_rank_weekly AS
select temp.username, temp.fullname,temp.profile_photo_path,
  (
    post_count * 1 
    + answears_count * 0.2 
    + comments_count * 0.1
    + questions_count * 0.1
    + liked_post_count  * 1
    + liked_comment_count * 0.5
    + liked_question_count * 0.5 
    + liked_answear_count * 0.5 
    + stocked_count * 0.5
  ) as contribution
from (
    SELECT users.name as username,users.fullname as fullname, ifnull(users.profile_photo_path,'') as profile_photo_path,
    ifnull(post_count, 0) as post_count,
    ifnull(questions_count, 0) as questions_count,
    ifnull(answears_count, 0) as answears_count,
    ifnull(comments_count, 0) as comments_count,
    ifnull(liked_post_count, 0) as liked_post_count,
    ifnull(liked_question_count, 0) as liked_question_count,
    ifnull(liked_answear_count, 0) as liked_answear_count,
    ifnull(liked_comment_count, 0) as liked_comment_count,
    ifnull(stocked_count, 0) as stocked_count

    FROM users
    LEFT JOIN(
      SELECT posts.user_id,
      COUNT(IF( posts.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , posts.created_at , null )) as post_count
      FROM posts
      WHERE posts.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      AND  (posts.status = 1 OR posts.status = 3)
      GROUP BY posts.user_id
    ) AS post_count ON post_count.user_id = users.id

    LEFT JOIN(
      SELECT questions.user_id,
      COUNT(IF( questions.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , questions.created_at , null )) as questions_count
      FROM questions
      WHERE questions.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      AND  (questions.status = 1 OR questions.status = 3)
      GROUP BY questions.user_id
    ) AS questions_count ON questions_count.user_id = users.id

    LEFT JOIN(
      SELECT answears.user_id,
      COUNT(IF( answears.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , answears.created_at , null )) as answears_count
      FROM answears
      WHERE answears.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      GROUP BY answears.user_id
    ) AS answears_count ON answears_count.user_id = users.id

    LEFT JOIN(
      SELECT comments.user_id,
      COUNT(IF( comments.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , comments.created_at , null )) as comments_count
      FROM comments
      WHERE comments.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      GROUP BY comments.user_id
    ) AS comments_count ON comments_count.user_id = users.id


    LEFT JOIN(
      SELECT post_likes.author_id,
      COUNT(IF( post_likes.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , post_likes.created_at , null )) as liked_post_count
      FROM post_likes
      WHERE post_likes.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))

      GROUP BY post_likes.author_id
    ) AS liked_post_count ON liked_post_count.author_id = users.id


    LEFT JOIN(
      SELECT question_likes.author_id,
      COUNT(IF( question_likes.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , question_likes.created_at , null )) as liked_question_count
      FROM question_likes
      WHERE question_likes.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))

      GROUP BY question_likes.author_id
    ) AS liked_question_count ON liked_question_count.author_id = users.id

    LEFT JOIN(
      SELECT answear_likes.author_id,
      COUNT(IF( answear_likes.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , answear_likes.created_at , null )) as liked_answear_count
      FROM answear_likes
      WHERE answear_likes.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))

      GROUP BY answear_likes.author_id
    ) AS liked_answear_count ON liked_answear_count.author_id = users.id

    LEFT JOIN(
      SELECT comment_likes.author_id,
      COUNT(IF( comment_likes.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , comment_likes.created_at , null )) as liked_comment_count
      FROM comment_likes
      WHERE comment_likes.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      GROUP BY comment_likes.author_id

    ) AS liked_comment_count ON liked_comment_count.author_id = users.id

    LEFT JOIN(
      SELECT user_stocks.author_id,
      COUNT(IF( user_stocks.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , user_stocks.created_at , null )) as stocked_count
      FROM user_stocks
      WHERE user_stocks.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      GROUP BY user_stocks.author_id

    ) AS stocked_count ON stocked_count.author_id = users.id


    GROUP BY users.name, users.fullname,users.profile_photo_path ,post_count.post_count,questions_count.questions_count,answears_count.answears_count,comments_count.comments_count,liked_post_count.liked_post_count,liked_question_count.liked_question_count,liked_answear_count.liked_answear_count,liked_comment_count.liked_comment_count,stocked_count.stocked_count
    ) AS temp
ORDER BY contribution
LIMIT 10;


drop view if exists user_rank_monthly;
CREATE VIEW user_rank_monthly AS
select temp.username, temp.fullname,temp.profile_photo_path,
  (
    post_count * 1 
    + answears_count * 0.2 
    + comments_count * 0.1
    + questions_count * 0.1
    + liked_post_count  * 1
    + liked_comment_count * 0.5
    + liked_question_count * 0.5 
    + liked_answear_count * 0.5 
    + stocked_count * 0.5
  ) as contribution
from (
    SELECT users.name as username,users.fullname as fullname, ifnull(users.profile_photo_path,'') as profile_photo_path,
    ifnull(post_count, 0) as post_count,
    ifnull(questions_count, 0) as questions_count,
    ifnull(answears_count, 0) as answears_count,
    ifnull(comments_count, 0) as comments_count,
    ifnull(liked_post_count, 0) as liked_post_count,
    ifnull(liked_question_count, 0) as liked_question_count,
    ifnull(liked_answear_count, 0) as liked_answear_count,
    ifnull(liked_comment_count, 0) as liked_comment_count,
    ifnull(stocked_count, 0) as stocked_count

    FROM users
    LEFT JOIN(
      SELECT posts.user_id,
      COUNT(IF( posts.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , posts.created_at , null )) as post_count
      FROM posts
      WHERE posts.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      AND  (posts.status = 1 OR posts.status = 3)
      GROUP BY posts.user_id
    ) AS post_count ON post_count.user_id = users.id

    LEFT JOIN(
      SELECT questions.user_id,
      COUNT(IF( questions.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , questions.created_at , null )) as questions_count
      FROM questions
      WHERE questions.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      AND  (questions.status = 1 OR questions.status = 3)
      GROUP BY questions.user_id
    ) AS questions_count ON questions_count.user_id = users.id

    LEFT JOIN(
      SELECT answears.user_id,
      COUNT(IF( answears.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , answears.created_at , null )) as answears_count
      FROM answears
      WHERE answears.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      GROUP BY answears.user_id
    ) AS answears_count ON answears_count.user_id = users.id

    LEFT JOIN(
      SELECT comments.user_id,
      COUNT(IF( comments.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , comments.created_at , null )) as comments_count
      FROM comments
      WHERE comments.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      GROUP BY comments.user_id
    ) AS comments_count ON comments_count.user_id = users.id


    LEFT JOIN(
      SELECT post_likes.author_id,
      COUNT(IF( post_likes.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , post_likes.created_at , null )) as liked_post_count
      FROM post_likes
      WHERE post_likes.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')

      GROUP BY post_likes.author_id
    ) AS liked_post_count ON liked_post_count.author_id = users.id


    LEFT JOIN(
      SELECT question_likes.author_id,
      COUNT(IF( question_likes.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , question_likes.created_at , null )) as liked_question_count
      FROM question_likes
      WHERE question_likes.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')

      GROUP BY question_likes.author_id
    ) AS liked_question_count ON liked_question_count.author_id = users.id

    LEFT JOIN(
      SELECT answear_likes.author_id,
      COUNT(IF( answear_likes.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , answear_likes.created_at , null )) as liked_answear_count
      FROM answear_likes
      WHERE answear_likes.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')

      GROUP BY answear_likes.author_id
    ) AS liked_answear_count ON liked_answear_count.author_id = users.id

    LEFT JOIN(
      SELECT comment_likes.author_id,
      COUNT(IF( comment_likes.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , comment_likes.created_at , null )) as liked_comment_count
      FROM comment_likes
      WHERE comment_likes.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      GROUP BY comment_likes.author_id

    ) AS liked_comment_count ON liked_comment_count.author_id = users.id

    LEFT JOIN(
      SELECT user_stocks.author_id,
      COUNT(IF( user_stocks.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , user_stocks.created_at , null )) as stocked_count
      FROM user_stocks
      WHERE user_stocks.created_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      GROUP BY user_stocks.author_id

    ) AS stocked_count ON stocked_count.author_id = users.id


    GROUP BY users.name, users.fullname,users.profile_photo_path ,post_count.post_count,questions_count.questions_count,answears_count.answears_count,comments_count.comments_count,liked_post_count.liked_post_count,liked_question_count.liked_question_count,liked_answear_count.liked_answear_count,liked_comment_count.liked_comment_count,stocked_count.stocked_count

    ) AS temp
ORDER BY contribution
LIMIT 10 ;



drop view if exists user_rank_total;
CREATE VIEW user_rank_total AS
select temp.username, temp.fullname,temp.profile_photo_path,
  (
    post_count * 1 
    + answears_count * 0.2 
    + comments_count * 0.1
    + questions_count * 0.1
    + liked_post_count  * 1
    + liked_comment_count * 0.5
    + liked_question_count * 0.5 
    + liked_answear_count * 0.5 
    + stocked_count * 0.5
  ) as contribution
from (
    SELECT users.name as username, users.fullname as fullname,ifnull(users.profile_photo_path,'') as profile_photo_path,
    ifnull(post_count, 0) as post_count,
    ifnull(questions_count, 0) as questions_count,
    ifnull(answears_count, 0) as answears_count,
    ifnull(comments_count, 0) as comments_count,
    ifnull(liked_post_count, 0) as liked_post_count,
    ifnull(liked_question_count, 0) as liked_question_count,
    ifnull(liked_answear_count, 0) as liked_answear_count,
    ifnull(liked_comment_count, 0) as liked_comment_count,
    ifnull(stocked_count, 0) as stocked_count

    FROM users
    LEFT JOIN(
      SELECT posts.user_id,
      COUNT(posts.created_at ) as post_count
      FROM posts
      WHERE  (posts.status = 1 OR posts.status = 3)
      GROUP BY posts.user_id
    ) AS post_count
    ON post_count.user_id = users.id
    LEFT JOIN(
      SELECT questions.user_id,
      COUNT(questions.created_at) as questions_count
      FROM questions
      WHERE  (questions.status = 1 OR questions.status = 3)
      GROUP BY questions.user_id
    ) AS questions_count
    ON questions_count.user_id = users.id

    LEFT JOIN(
      SELECT answears.user_id,
      COUNT(answears.created_at ) as answears_count
      FROM answears

      GROUP BY answears.user_id
    ) AS answears_count
    ON answears_count.user_id = users.id
    LEFT JOIN(
      SELECT comments.user_id,
      COUNT(comments.created_at  ) as comments_count
      FROM comments

      GROUP BY comments.user_id
    ) AS comments_count
    ON comments_count.user_id = users.id

    LEFT JOIN(
      SELECT post_likes.author_id,
      COUNT(post_likes.created_at ) as liked_post_count
      FROM post_likes

      GROUP BY post_likes.author_id
    ) AS liked_post_count
    ON liked_post_count.author_id = users.id
    LEFT JOIN(
      SELECT question_likes.author_id,
      COUNT(question_likes.created_at  ) as liked_question_count
      FROM question_likes

      GROUP BY question_likes.author_id
    ) AS liked_question_count
    ON liked_question_count.author_id = users.id

    LEFT JOIN(
      SELECT answear_likes.author_id,
      COUNT(answear_likes.created_at ) as liked_answear_count
      FROM answear_likes

      GROUP BY answear_likes.author_id
    ) AS liked_answear_count
    ON liked_answear_count.author_id = users.id
    LEFT JOIN(
      SELECT comment_likes.author_id,
      COUNT(comment_likes.created_at ) as liked_comment_count
      FROM comment_likes

      GROUP BY comment_likes.author_id
    ) AS liked_comment_count
    ON liked_comment_count.author_id = users.id

    LEFT JOIN(
      SELECT user_stocks.author_id,
      COUNT(user_stocks.created_at)  as stocked_count
      FROM user_stocks
      
      GROUP BY user_stocks.author_id

    ) AS stocked_count ON stocked_count.author_id = users.id

    GROUP BY users.name, users.fullname,users.profile_photo_path ,post_count.post_count,questions_count.questions_count,answears_count.answears_count,comments_count.comments_count,liked_post_count.liked_post_count,liked_question_count.liked_question_count,liked_answear_count.liked_answear_count,liked_comment_count.liked_comment_count,stocked_count.stocked_count

    ) AS  temp
ORDER BY contribution
LIMIT 10 ;
