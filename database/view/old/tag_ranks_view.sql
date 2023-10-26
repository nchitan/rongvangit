
**
drop view if exists tag_rank_weekly;
CREATE VIEW tag_rank_weekly 
AS

SELECT tags.tag_name,
ifnull(tag_img, '') as tag_img ,
ifnull(count_post_weekly, 0) as count_post
FROM tags
LEFT JOIN(
  SELECT post_tag_grps.tag_name as tag_name,
  COUNT(IF( post_tag_grps.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , post_tag_grps.created_at , null )) as count_post_weekly
  FROM post_tag_grps
  GROUP BY tag_name
) AS temp_week
ON temp_week.tag_name = tags.tag_name
GROUP BY tag_name, tag_img
ORDER BY count_post_weekly desc
LIMIT 10

**
drop view if exists tag_rank_monthly;
CREATE VIEW tag_rank_monthly 
AS
SELECT tags.tag_name,
ifnull(tag_img, '') as tag_img ,
ifnull(count_post_monthly, 0) as count_post
FROM tags
LEFT JOIN(
  SELECT post_tag_grps.tag_name as tag_name,
  COUNT(IF( post_tag_grps.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , post_tag_grps.created_at , null )) as count_post_monthly
  FROM post_tag_grps
  GROUP BY tag_name
) AS temp_month
ON temp_month.tag_name = tags.tag_name
GROUP BY tag_name, tag_img
ORDER BY count_post_monthly desc
LIMIT 10

**
drop view if exists tag_rank_total;
CREATE VIEW tag_rank_total 
AS

SELECT tags.tag_name, 
ifnull(tag_img, '') as tag_img ,
ifnull(count_post_total, 0) as count_post
FROM tags
LEFT JOIN(
  SELECT post_tag_grps.tag_name as tag_name,
  COUNT(post_tag_grps.created_at) as count_post_total
  FROM post_tag_grps
  GROUP BY tag_name
) AS temp_total
ON temp_total.tag_name = tags.tag_name
GROUP BY tag_name, tag_img
ORDER BY count_post_total desc
LIMIT 10


***othr ver
drop view if exists tag_rank_total;
CREATE VIEW tag_rank_total 
AS
SELECT post_tag_grps.tag_name
FROM post_tag_grps
LEFT JOIN tags  ON post_tag_grps.tag_name = tags.tag_name
LEFT JOIN(
  SELECT post_tag_grps.tag_name as tag_name,
  COUNT(IF( post_tag_grps.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , post_tag_grps.created_at , null )) as weekly
  FROM post_tag_grps
) AS temp_week
ON temp_week.tag_name = post_tag_grps.tag_name

WHERE  post_tag_grps.tag_name = tags.tag_name
GROUP BY post_tag_grps.tag_name
LIMIT 10



SELECT tags.tag_name,
ifnull(weekly, 0) as weekly

FROM tags
LEFT JOIN post_tag_grps  ON post_tag_grps.tag_name = tags.tag_name
LEFT JOIN(
  SELECT post_tag_grps.tag_name as tag_name,
  COUNT(IF( post_tag_grps.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , post_tag_grps.created_at , null )) as weekly
  FROM post_tag_grps
) AS temp_week
ON temp_week.tag_name = post_tag_grps.tag_name

WHERE  post_tag_grps.tag_name = tags.tag_name
AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
GROUP BY tags.tag_name
LIMIT 10

