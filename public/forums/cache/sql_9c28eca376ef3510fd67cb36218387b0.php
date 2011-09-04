<?php exit; ?>
<<<<<<< HEAD
1315124548
=======
<<<<<<< HEAD
1315034584
=======
1315030095
>>>>>>> 7436d2b69ecfe3911b29e3be47d5310dddb9947c
>>>>>>> 9b31c8c378ccd1e71c4cae0a47fe01026bda61aa
SELECT m.*, u.user_colour, g.group_colour, g.group_type FROM (forum_moderator_cache m) LEFT JOIN forum_users u ON (m.user_id = u.user_id) LEFT JOIN forum_groups g ON (m.group_id = g.group_id) WHERE m.display_on_index = 1
6
a:0:{}