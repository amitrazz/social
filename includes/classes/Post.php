<?php
    class Post
    {
        private $user_obj;
        private $con;

        public function __construct($con, $user){
            $this->con = $con;
            $this->user_obj = new User($con,$user);

        }

        public function submitPost($body,$user_to){
            $body = strip_tags($body);
            $body = mysqli_real_escape_string($this->con, $body);
            $check_empty = preg_replace('/\s+/','',$body);

            if($check_empty != ''){

                //current date and time
                $date_added = date('Y-m-d H:i:s');

                //get user name
                $added_by = $this->user_obj->getUsername();

                //if user is  on own profile , user_to is none
                if($user_to == $added_by){
                    $user_to = "none";
                }

                //insert post
                $query = mysqli_query($this->con," INSERT INTO  posts VALUES  ('','$body','$added_by','$user_to','$date_added','no','no','0')");
                $returned_id = mysqli_insert_id($this->con);

                //insert notification

                //update post count for user
                $num_post = $this->user_obj->getNumPosts();
                $num_post++;
                $update_query = mysqli_query($this->con,"UPDATE users SET num_posts='$num_post' WHERE username='$added_by'");


            }
           
        }

        public function loadPostsFriends(){
            $str = "";
            $data = mysqli_query($this->con,"SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

            while($row = mysqli_fetch_array($data))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];

                //prepare user_to string so it can be include even if not posted to user
                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }else
                {
                    $user_to_obj = new User($con,$row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "<a href='".$row['user_to']."'>".$user_to_name ."</a>";
                }
                //check if user posted has their account close
                $added_by_obj = new User($this->con,$added_by);
                if($added_by_obj->isClosed()){
                    continue;
                }
                $user_details_query = mysqli_query($this->con,"SELECT first_name,last_name,profile_pic FROM users WHERE username='$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];

                //time frame
                $date_time_now = date('Y-m-d H:i:s');
                $start_date = new DateTime($date_time);
                $end_date = new DateTime($date_time_now);
                $interval = $start_date->diff($end_date);

                if($interval->y >= 1)
                {
                    if($interval == 1){
                    $time_message = $interval->y ."year Ago";                        
                    }else{
                    $time_message = $interval->y ."years Ago"; 
                    }
                }elseif($interval->m >= 1)
                {
                    if($interval->d == 0){
                          $days = "ago";                    
                    }elseif($interval->d == 1){
                        $days = $interval->d ."day ago"; 
                    }else{
                        $days = $interval->d ."days ago"; 
                    }

                    if($interval->m == 1){
                        $time_message = $interval->m ."month Ago"; 
                    }else{
                        $time_message = $interval->m ."months Ago"; 
                    }
                }
                elseif($interval->d >= 1)
                {
                    if($interval->d == 1){
                        $time_message = "yesterday";
                    }else{
                        $time_message = $interval->d ."days ago";
                    }
                }elseif($interval->h >= 1)
                {
                    if($interval->h == 1){
                        $time_message = $interval->h ."hour ago";
                    }else{
                        $time_message = $interval->h ."hours ago";
                    }
                }elseif($interval->i >= 1)
                {
                    if($interval->i == 1){
                        $time_message = $interval->i ."minute ago";
                    }else{
                        $time_message = $interval->i ."minutes ago";
                    }
                }else
                {
                    if($interval->s < 30){
                        $time_message = "just Now";
                    }else{
                        $time_message = $interval->s ."seconds ago";
                    }
                }

                $str .= "<div class='status_post'>
                            <div class='post_profile_pic'>
                                <img src='$profile_pic' width='50'>
                            </div>

                            <div class='posted_by'>
                            <a href='$added_by'>$first_name $last_name </a>$user_to 
                             $time_message
                            </div>
                            <div id='postbody'>
                                $body<br>
                            </div>
                        </div><hr>";
            }
            echo $str;
            
        }

    }

?>
    