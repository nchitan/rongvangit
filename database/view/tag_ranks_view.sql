drop view if exists tag_rank_weekly;
CREATE VIEW tag_rank_weekly 
AS

SELECT tags.tag_name,
ifnull(tags.tag_img, '') as tag_img ,
ifnull(temp_week.count_post_weekly, 0) as count_post
FROM tags
LEFT JOIN(
  SELECT post_tag_grps.tag_id as tag_id,
  COUNT(IF( post_tag_grps.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) , post_tag_grps.created_at , null )) as count_post_weekly
  FROM post_tag_grps
  LEFT JOIN posts ON posts.id = post_tag_grps.post_id
  WHERE (posts.status = 1 OR posts.status = 3)
  GROUP BY tag_id
) AS temp_week
ON temp_week.tag_id = tags.id
GROUP BY tags.tag_name, tags.tag_img, temp_week.count_post_weekly
ORDER BY temp_week.count_post_weekly desc
LIMIT 10
;


drop view if exists tag_rank_monthly;
CREATE VIEW tag_rank_monthly 
AS
(
SELECT tags.tag_name,
ifnull(tag_img, '') as tag_img ,
ifnull(count_post_monthly, 0) as count_post
FROM tags
LEFT JOIN(
  SELECT post_tag_grps.tag_id as tag_id,
  COUNT(IF( post_tag_grps.created_at>=DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01') , post_tag_grps.created_at , null )) as count_post_monthly
  FROM post_tag_grps
  LEFT JOIN posts ON posts.id = post_tag_grps.post_id
  WHERE (posts.status = 1 OR posts.status = 3)
  GROUP BY tag_id
) AS temp_month
ON temp_month.tag_id = tags.id
GROUP BY tags.tag_name, tags.tag_img,temp_month.count_post_monthly
ORDER BY temp_month.count_post_monthly desc
LIMIT 10
);


drop view if exists tag_rank_total;
CREATE VIEW tag_rank_total 
AS

(
SELECT tags.tag_name, 
ifnull(tag_img, '') as tag_img ,
ifnull(count_post_total, 0) as count_post
FROM tags
LEFT JOIN(
  SELECT post_tag_grps.tag_id as tag_id,
  COUNT(post_tag_grps.created_at) as count_post_total
  FROM post_tag_grps
    LEFT JOIN posts ON posts.id = post_tag_grps.post_id
  WHERE (posts.status = 1 OR posts.status = 3)
  GROUP BY tag_id
) AS temp_total
ON temp_total.tag_id = tags.id
GROUP BY tags.tag_name, tags.tag_img,temp_total.count_post_total
ORDER BY temp_total.count_post_total desc
LIMIT 10
);
