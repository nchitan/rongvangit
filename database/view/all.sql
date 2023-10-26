*****Lay nguoi following
    


    SELECT users.name,users.id, users.profile_photo_path

    FROM user_followers
    LEFT JOIN 
    users
    ON users.id = user_followers.user_id
    WHERE user_followers.follower_user_id = 1




*****Lay nguoi  follower
    


    SELECT users.name,users.id, user_followers.user_id, users.profile_photo_path

    FROM user_followers
    LEFT JOIN 
    users
    ON users.id = user_followers.follower_user_id
    WHERE user_followers.user_id = 1

**** Lay question cua nguoi dang following
WITH tmp AS (SELECT users.name as username
    FROM user_followers
    LEFT JOIN 
    users
    ON users.id = user_followers.user_id
    WHERE user_followers.follower_user_id = 1
)
SELECT tmp.username, title, type,item,created_at,tags,count,count_answear,profile_photo_path
FROM tmp
LEFT JOIN (
    SELECT 
    questions.title, 
    questions.type, 
    questions.username as author, 
    questions.item, 
    questions.created_at, 
    temp_tbl.tags,
    ifnull(temp_tbl2.count_like_question, 0) as count,
    ifnull(temp_tbl3.count_answear, 0) as count_answear,
    users.profile_photo_path
    FROM questions
    LEFT JOIN (
    SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
    FROM question_tag_grps
    GROUP BY question_tag_grps.item
    ) AS temp_tbl
    ON temp_tbl.item = questions.item

    LEFT JOIN(
    SELECT question_likes.item as item,
    COUNT(DISTINCT question_likes.like_username) as count_like_question
    FROM question_likes
    GROUP BY question_likes.item
    ) AS temp_tbl2
    ON temp_tbl2.item = questions.item

    LEFT JOIN(
    SELECT answears.item as item,
    COUNT(answears.username) as count_answear
    FROM answears
    GROUP BY answears.item
    ) AS temp_tbl3
    ON temp_tbl3.item = questions.item

    LEFT JOIN users ON questions.username = users.name
    ORDER BY questions.created_at desc
) AS tmp2
ON tmp.username = tmp2.author
WHERE item IS NOT NULL




**** Lay cacs post chua tag ma nguoi dung following bi loi

WITH tmp AS (
    SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id, follow_type
    FROM tag_followers
    LEFT JOIN users ON users.id = tag_followers.user_id
    LEFT JOIN tags ON tags.id = tag_followers.tag_id
    WHERE tag_followers.user_id = 1
)
SELECT tmp.username, title, type,item,created_at,tags,count,count_answear,profile_photo_path
FROM tmp
LEFT JOIN (
    SELECT 
    questions.title, 
    questions.type, 
    questions.username as author, 
    questions.item, 
    questions.created_at, 
    temp_tbl.tags,
    ifnull(temp_tbl2.count_like_question, 0) as count,
    ifnull(temp_tbl3.count_answear, 0) as count_answear,
    users.profile_photo_path
    FROM questions
    LEFT JOIN (
        SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
        FROM question_tag_grps
        GROUP BY question_tag_grps.item
    ) AS temp_tbl
    ON temp_tbl.item = questions.item

    LEFT JOIN(
        SELECT question_likes.item as item,
        COUNT(DISTINCT question_likes.like_username) as count_like_question
        FROM question_likes
        GROUP BY question_likes.item
    ) AS temp_tbl2
    ON temp_tbl2.item = questions.item

    LEFT JOIN(
        SELECT answears.item as item,
        COUNT(answears.username) as count_answear
        FROM answears
        GROUP BY answears.item
    ) AS temp_tbl3
    ON temp_tbl3.item = questions.item

    LEFT JOIN users ON questions.username = users.name
    ORDER BY questions.created_at desc
) AS tmp2
ON tmp.username = tmp2.author
WHERE  LOCATE(tag_name,tags)


**** Lay post theo all
WITH tmp AS (
    SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id, follow_type
    FROM tag_followers
    LEFT JOIN users ON users.id = tag_followers.user_id
    LEFT JOIN tags ON tags.id = tag_followers.tag_id
    WHERE tag_followers.user_id = 1
)
SELECT tmp2.author as username, title, type,item,created_at,tags,count,count_answear,profile_photo_path
FROM tmp

LEFT JOIN (
    SELECT 
    questions.title, 
    questions.type, 
    questions.username as author, 
    questions.item, 
    questions.created_at, 
    temp_tbl.tags,
    ifnull(temp_tbl2.count_like_question, 0) as count,
    ifnull(temp_tbl3.count_answear, 0) as count_answear,
    users.profile_photo_path
    FROM questions
    LEFT JOIN (
        SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
        FROM question_tag_grps
        GROUP BY question_tag_grps.item
    ) AS temp_tbl
    ON temp_tbl.item = questions.item

    LEFT JOIN(
        SELECT question_likes.item as item,
        COUNT(DISTINCT question_likes.like_username) as count_like_question
        FROM question_likes
        GROUP BY question_likes.item
    ) AS temp_tbl2
    ON temp_tbl2.item = questions.item

    LEFT JOIN(
        SELECT answears.item as item,
        COUNT(answears.username) as count_answear
        FROM answears
        GROUP BY answears.item
    ) AS temp_tbl3
    ON temp_tbl3.item = questions.item

    LEFT JOIN users ON questions.username = users.name
    ORDER BY questions.created_at desc

) AS tmp2
ON LOCATE(tmp.tag_name,tmp2.tags)
GROUP BY username, title, type, item ,created_at,tags,profile_photo_path



**** Lay quest theo time line ( tag theo doi va nguoi dung theo doi)
(WITH tmp AS (
    SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id, follow_type
    FROM tag_followers
    LEFT JOIN users ON users.id = tag_followers.user_id
    LEFT JOIN tags ON tags.id = tag_followers.tag_id
    WHERE tag_followers.user_id = 1
)
SELECT tmp2.author as username, title, type,item,created_at,tags,count,count_answear,profile_photo_path
FROM tmp

LEFT JOIN (
    SELECT 
    questions.title, 
    questions.type, 
    questions.username as author, 
    questions.item, 
    questions.created_at, 
    temp_tbl.tags,
    ifnull(temp_tbl2.count_like_question, 0) as count,
    ifnull(temp_tbl3.count_answear, 0) as count_answear,
    users.profile_photo_path
    FROM questions
    LEFT JOIN (
        SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
        FROM question_tag_grps
        GROUP BY question_tag_grps.item
    ) AS temp_tbl
    ON temp_tbl.item = questions.item

    LEFT JOIN(
        SELECT question_likes.item as item,
        COUNT(DISTINCT question_likes.like_username) as count_like_question
        FROM question_likes
        GROUP BY question_likes.item
    ) AS temp_tbl2
    ON temp_tbl2.item = questions.item

    LEFT JOIN(
        SELECT answears.item as item,
        COUNT(answears.username) as count_answear
        FROM answears
        GROUP BY answears.item
    ) AS temp_tbl3
    ON temp_tbl3.item = questions.item

    LEFT JOIN users ON questions.username = users.name
    ORDER BY questions.created_at desc

) AS tmp2
ON LOCATE(tmp.tag_name,tmp2.tags)
GROUP BY username, title, type, item ,created_at,tags,profile_photo_path)

UNION

(WITH tmp AS (SELECT users.name as username
    FROM user_followers
    LEFT JOIN 
    users
    ON users.id = user_followers.user_id
    WHERE user_followers.follower_user_id = 1
)
SELECT tmp.username, title, type,item,created_at,tags,count,count_answear,profile_photo_path
FROM tmp
LEFT JOIN (
    SELECT 
    questions.title, 
    questions.type, 
    questions.username as author, 
    questions.item, 
    questions.created_at, 
    temp_tbl.tags,
    ifnull(temp_tbl2.count_like_question, 0) as count,
    ifnull(temp_tbl3.count_answear, 0) as count_answear,
    users.profile_photo_path
    FROM questions
    LEFT JOIN (
    SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
    FROM question_tag_grps
    GROUP BY question_tag_grps.item
    ) AS temp_tbl
    ON temp_tbl.item = questions.item

    LEFT JOIN(
    SELECT question_likes.item as item,
    COUNT(DISTINCT question_likes.like_username) as count_like_question
    FROM question_likes
    GROUP BY question_likes.item
    ) AS temp_tbl2
    ON temp_tbl2.item = questions.item

    LEFT JOIN(
    SELECT answears.item as item,
    COUNT(answears.username) as count_answear
    FROM answears
    GROUP BY answears.item
    ) AS temp_tbl3
    ON temp_tbl3.item = questions.item

    LEFT JOIN users ON questions.username = users.name
    ORDER BY questions.created_at desc
) AS tmp2
ON tmp.username = tmp2.author
WHERE item IS NOT NULL
GROUP BY username, title, type, item ,created_at,tags,profile_photo_path)
ORDER BY created_at desc



*** Lay post theo timeline ( tag theo doi va nguoi dung theo doi)

(WITH tmp AS (
    SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id, follow_type
    FROM tag_followers
    LEFT JOIN users ON users.id = tag_followers.user_id
    LEFT JOIN tags ON tags.id = tag_followers.tag_id
    WHERE tag_followers.user_id = 1
)
SELECT tmp2.author as username, title,item,created_at,tags,count,count_answear,profile_photo_path
FROM tmp

LEFT JOIN (
    SELECT 
    posts.title, 
    
    posts.username as author, 
    posts.item, 
    posts.created_at, 
    temp_tbl.tags,
    ifnull(temp_tbl2.count_like_post, 0) as count,
    ifnull(temp_tbl3.count_answear, 0) as count_answear,
    users.profile_photo_path
    FROM posts
    LEFT JOIN (
        SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
        FROM post_tag_grps
        GROUP BY post_tag_grps.item
    ) AS temp_tbl
    ON temp_tbl.item = posts.item

    LEFT JOIN(
        SELECT post_likes.item as item,
        COUNT(DISTINCT post_likes.like_username) as count_like_post
        FROM post_likes
        GROUP BY post_likes.item
    ) AS temp_tbl2
    ON temp_tbl2.item = posts.item

    LEFT JOIN(
        SELECT answears.item as item,
        COUNT(answears.username) as count_answear
        FROM answears
        GROUP BY answears.item
    ) AS temp_tbl3
    ON temp_tbl3.item = posts.item

    LEFT JOIN users ON posts.username = users.name
    ORDER BY posts.created_at desc

) AS tmp2
ON LOCATE(tmp.tag_name,tmp2.tags)
GROUP BY username, title,  item ,created_at,tags,profile_photo_path)

UNION

(WITH tmp AS (SELECT users.name as username
    FROM user_followers
    LEFT JOIN 
    users
    ON users.id = user_followers.user_id
    WHERE user_followers.follower_user_id = 1
)
SELECT tmp.username, title,item,created_at,tags,count,count_answear,profile_photo_path
FROM tmp
LEFT JOIN (
    SELECT 
    posts.title, 
    
    posts.username as author, 
    posts.item, 
    posts.created_at, 
    temp_tbl.tags,
    ifnull(temp_tbl2.count_like_post, 0) as count,
    ifnull(temp_tbl3.count_answear, 0) as count_answear,
    users.profile_photo_path
    FROM posts
    LEFT JOIN (
    SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
    FROM post_tag_grps
    GROUP BY post_tag_grps.item
    ) AS temp_tbl
    ON temp_tbl.item = posts.item

    LEFT JOIN(
    SELECT post_likes.item as item,
    COUNT(DISTINCT post_likes.like_username) as count_like_post
    FROM post_likes
    GROUP BY post_likes.item
    ) AS temp_tbl2
    ON temp_tbl2.item = posts.item

    LEFT JOIN(
    SELECT answears.item as item,
    COUNT(answears.username) as count_answear
    FROM answears
    GROUP BY answears.item
    ) AS temp_tbl3
    ON temp_tbl3.item = posts.item

    LEFT JOIN users ON posts.username = users.name
    ORDER BY posts.created_at desc
) AS tmp2
ON tmp.username = tmp2.author
WHERE item IS NOT NULL
GROUP BY username, title, item ,created_at,tags,profile_photo_path)
ORDER BY created_at desc
