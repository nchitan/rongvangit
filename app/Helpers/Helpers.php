<?php


namespace App\Helpers;


use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use PhpParser\Node\Stmt\TryCatch;

class Helpers
{

  public static function tagRankWeekly(){

    $str_sql = 
      ' SELECT '.' tags.tag_name,
              ifnull(tags.tag_img, "") as tag_img ,
              ifnull(temp_week.count_post_weekly, 0) as count_post
      FROM tags
      LEFT JOIN(
        SELECT post_tag_grps.tag_id as tag_id,
        COUNT(IF( post_tag_grps.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , post_tag_grps.updated_at , null )) as count_post_weekly
        FROM post_tag_grps
        LEFT JOIN posts ON posts.id = post_tag_grps.post_id
        WHERE (posts.status = 1 OR posts.status = 3)
        GROUP BY tag_id
      ) AS temp_week
      ON temp_week.tag_id = tags.id
      GROUP BY tags.tag_name, tags.tag_img, temp_week.count_post_weekly
      ORDER BY temp_week.count_post_weekly desc LIMIT 10';

    return($str_sql);
  }
  public static function tagRankMonthly(){

    $str_sql = 
      ' SELECT '.' tags.tag_name,
ifnull(tags.tag_img, "") as tag_img ,
ifnull(count_post_monthly, 0) as count_post
FROM tags
LEFT JOIN(
  SELECT post_tag_grps.tag_id as tag_id,
  COUNT(IF( post_tag_grps.updated_at>=DATE_FORMAT(CURDATE() '. " - INTERVAL 0 MONTH,'%Y-%m-01') , post_tag_grps.updated_at , null )) as count_post_monthly ".
 ' FROM post_tag_grps
  LEFT JOIN posts ON posts.id = post_tag_grps.post_id
  WHERE (posts.status = 1 OR posts.status = 3)
  GROUP BY tag_id
) AS temp_month
ON temp_month.tag_id = tags.id
GROUP BY tags.tag_name, tags.tag_img,temp_month.count_post_monthly
ORDER BY temp_month.count_post_monthly desc LIMIT 10';

    return($str_sql);
  }  
  
  public static function tagRankTotal(){

    $str_sql = 
      ' SELECT '.' tags.tag_name, 
ifnull(tags.tag_img, "") as tag_img ,
ifnull(count_post_total, 0) as count_post
FROM tags
LEFT JOIN(
  SELECT post_tag_grps.tag_id as tag_id,
  COUNT(post_tag_grps.post_id) as count_post_total
  FROM post_tag_grps
    LEFT JOIN posts ON posts.id = post_tag_grps.post_id
  WHERE (posts.status = 1 OR posts.status = 3)
  GROUP BY tag_id
) AS temp_total
ON temp_total.tag_id = tags.id
GROUP BY tags.tag_name, tags.tag_img,temp_total.count_post_total
ORDER BY temp_total.count_post_total desc LIMIT 10';

    return($str_sql);
  }   
  
  
  public static function userRankWeekly(){

    $str_sql = 
"select temp.username, temp.fullname,temp.profile_photo_path,
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
      COUNT(IF( posts.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , posts.updated_at , null )) as post_count
      FROM posts
      WHERE posts.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      AND  (posts.status = 1 OR posts.status = 3)
      GROUP BY posts.user_id
    ) AS post_count ON post_count.user_id = users.id

    LEFT JOIN(
      SELECT questions.user_id,
      COUNT(IF( questions.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , questions.updated_at , null )) as questions_count
      FROM questions
      WHERE questions.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      AND  (questions.status = 1 OR questions.status = 3)
      GROUP BY questions.user_id
    ) AS questions_count ON questions_count.user_id = users.id

    LEFT JOIN(
      SELECT answears.user_id,
      COUNT(IF( answears.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , answears.updated_at , null )) as answears_count
      FROM answears
      WHERE answears.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      GROUP BY answears.user_id
    ) AS answears_count ON answears_count.user_id = users.id

    LEFT JOIN(
      SELECT comments.user_id,
      COUNT(IF( comments.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , comments.updated_at , null )) as comments_count
      FROM comments
      WHERE comments.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      GROUP BY comments.user_id
    ) AS comments_count ON comments_count.user_id = users.id


    LEFT JOIN(
      SELECT post_likes.author_id,
      COUNT(IF( post_likes.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , post_likes.updated_at , null )) as liked_post_count
      FROM post_likes
      WHERE post_likes.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))

      GROUP BY post_likes.author_id
    ) AS liked_post_count ON liked_post_count.author_id = users.id


    LEFT JOIN(
      SELECT question_likes.author_id,
      COUNT(IF( question_likes.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , question_likes.updated_at , null )) as liked_question_count
      FROM question_likes
      WHERE question_likes.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))

      GROUP BY question_likes.author_id
    ) AS liked_question_count ON liked_question_count.author_id = users.id

    LEFT JOIN(
      SELECT answear_likes.author_id,
      COUNT(IF( answear_likes.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , answear_likes.updated_at , null )) as liked_answear_count
      FROM answear_likes
      WHERE answear_likes.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))

      GROUP BY answear_likes.author_id
    ) AS liked_answear_count ON liked_answear_count.author_id = users.id

    LEFT JOIN(
      SELECT comment_likes.author_id,
      COUNT(IF( comment_likes.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , comment_likes.updated_at , null )) as liked_comment_count
      FROM comment_likes
      WHERE comment_likes.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      GROUP BY comment_likes.author_id

    ) AS liked_comment_count ON liked_comment_count.author_id = users.id

    LEFT JOIN(
      SELECT user_stocks.author_id,
      COUNT(IF( user_stocks.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , user_stocks.updated_at , null )) as stocked_count
      FROM user_stocks
      WHERE user_stocks.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
      GROUP BY user_stocks.author_id

    ) AS stocked_count ON stocked_count.author_id = users.id


    GROUP BY users.name, users.fullname,users.profile_photo_path ,post_count.post_count,questions_count.questions_count,answears_count.answears_count,comments_count.comments_count,liked_post_count.liked_post_count,liked_question_count.liked_question_count,liked_answear_count.liked_answear_count,liked_comment_count.liked_comment_count,stocked_count.stocked_count
    ) AS temp
ORDER BY contribution desc
LIMIT 10 ";

    return($str_sql);
  }


  public static function userRankMonthly(){

    $str_sql = "
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
      COUNT(IF( posts.updated_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , posts.updated_at , null )) as post_count
      FROM posts
      WHERE posts.updated_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      AND  (posts.status = 1 OR posts.status = 3)
      GROUP BY posts.user_id
    ) AS post_count ON post_count.user_id = users.id

    LEFT JOIN(
      SELECT questions.user_id,
      COUNT(IF( questions.updated_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , questions.updated_at , null )) as questions_count
      FROM questions
      WHERE questions.updated_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      AND  (questions.status = 1 OR questions.status = 3)
      GROUP BY questions.user_id
    ) AS questions_count ON questions_count.user_id = users.id

    LEFT JOIN(
      SELECT answears.user_id,
      COUNT(IF( answears.updated_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , answears.updated_at , null )) as answears_count
      FROM answears
      WHERE answears.updated_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      GROUP BY answears.user_id
    ) AS answears_count ON answears_count.user_id = users.id

    LEFT JOIN(
      SELECT comments.user_id,
      COUNT(IF( comments.updated_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , comments.updated_at , null )) as comments_count
      FROM comments
      WHERE comments.updated_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      GROUP BY comments.user_id
    ) AS comments_count ON comments_count.user_id = users.id


    LEFT JOIN(
      SELECT post_likes.author_id,
      COUNT(IF( post_likes.updated_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , post_likes.updated_at , null )) as liked_post_count
      FROM post_likes
      WHERE post_likes.updated_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')

      GROUP BY post_likes.author_id
    ) AS liked_post_count ON liked_post_count.author_id = users.id


    LEFT JOIN(
      SELECT question_likes.author_id,
      COUNT(IF( question_likes.updated_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , question_likes.updated_at , null )) as liked_question_count
      FROM question_likes
      WHERE question_likes.updated_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')

      GROUP BY question_likes.author_id
    ) AS liked_question_count ON liked_question_count.author_id = users.id

    LEFT JOIN(
      SELECT answear_likes.author_id,
      COUNT(IF( answear_likes.updated_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , answear_likes.updated_at , null )) as liked_answear_count
      FROM answear_likes
      WHERE answear_likes.updated_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')

      GROUP BY answear_likes.author_id
    ) AS liked_answear_count ON liked_answear_count.author_id = users.id

    LEFT JOIN(
      SELECT comment_likes.author_id,
      COUNT(IF( comment_likes.updated_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , comment_likes.updated_at , null )) as liked_comment_count
      FROM comment_likes
      WHERE comment_likes.updated_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      GROUP BY comment_likes.author_id

    ) AS liked_comment_count ON liked_comment_count.author_id = users.id

    LEFT JOIN(
      SELECT user_stocks.author_id,
      COUNT(IF( user_stocks.updated_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , user_stocks.updated_at , null )) as stocked_count
      FROM user_stocks
      WHERE user_stocks.updated_at >= DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')
      GROUP BY user_stocks.author_id

    ) AS stocked_count ON stocked_count.author_id = users.id


    GROUP BY users.name, users.fullname,users.profile_photo_path ,post_count.post_count,questions_count.questions_count,answears_count.answears_count,comments_count.comments_count,liked_post_count.liked_post_count,liked_question_count.liked_question_count,liked_answear_count.liked_answear_count,liked_comment_count.liked_comment_count,stocked_count.stocked_count

    ) AS temp
ORDER BY contribution desc
LIMIT 10    
    ";
    
    return($str_sql);
  }


  public static function userRankTotal(){

    $str_sql = "
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
      COUNT(posts.updated_at ) as post_count
      FROM posts
      WHERE  (posts.status = 1 OR posts.status = 3)
      GROUP BY posts.user_id
    ) AS post_count
    ON post_count.user_id = users.id
    LEFT JOIN(
      SELECT questions.user_id,
      COUNT(questions.updated_at) as questions_count
      FROM questions
      WHERE  (questions.status = 1 OR questions.status = 3)
      GROUP BY questions.user_id
    ) AS questions_count
    ON questions_count.user_id = users.id

    LEFT JOIN(
      SELECT answears.user_id,
      COUNT(answears.updated_at ) as answears_count
      FROM answears

      GROUP BY answears.user_id
    ) AS answears_count
    ON answears_count.user_id = users.id
    LEFT JOIN(
      SELECT comments.user_id,
      COUNT(comments.updated_at  ) as comments_count
      FROM comments

      GROUP BY comments.user_id
    ) AS comments_count
    ON comments_count.user_id = users.id

    LEFT JOIN(
      SELECT post_likes.author_id,
      COUNT(post_likes.updated_at ) as liked_post_count
      FROM post_likes

      GROUP BY post_likes.author_id
    ) AS liked_post_count
    ON liked_post_count.author_id = users.id
    LEFT JOIN(
      SELECT question_likes.author_id,
      COUNT(question_likes.updated_at  ) as liked_question_count
      FROM question_likes

      GROUP BY question_likes.author_id
    ) AS liked_question_count
    ON liked_question_count.author_id = users.id

    LEFT JOIN(
      SELECT answear_likes.author_id,
      COUNT(answear_likes.updated_at ) as liked_answear_count
      FROM answear_likes

      GROUP BY answear_likes.author_id
    ) AS liked_answear_count
    ON liked_answear_count.author_id = users.id
    LEFT JOIN(
      SELECT comment_likes.author_id,
      COUNT(comment_likes.updated_at ) as liked_comment_count
      FROM comment_likes

      GROUP BY comment_likes.author_id
    ) AS liked_comment_count
    ON liked_comment_count.author_id = users.id

    LEFT JOIN(
      SELECT user_stocks.author_id,
      COUNT(user_stocks.updated_at)  as stocked_count
      FROM user_stocks
      
      GROUP BY user_stocks.author_id

    ) AS stocked_count ON stocked_count.author_id = users.id

    GROUP BY users.name, users.fullname,users.profile_photo_path ,post_count.post_count,questions_count.questions_count,answears_count.answears_count,comments_count.comments_count,liked_post_count.liked_post_count,liked_question_count.liked_question_count,liked_answear_count.liked_answear_count,liked_comment_count.liked_comment_count,stocked_count.stocked_count

    ) AS  temp
ORDER BY contribution desc
LIMIT 10    
    ";
    
    return($str_sql);
  }    
    
}