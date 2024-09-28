<?php 

namespace Models;

class Friendship {
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get_friends($userID){
        #PROBLEM -> TRZEBA WZIAC SAMO ID Z USERS.PHP, TAM ZWRACA WSZYSTKO
        $query_friends = "SELECT ID_user_friends FROM friendship WHERE ID_user='$userID";
        return $this->db->query($query_friends);
    }
    
    public function add_friends($userID,$friendID){
        $query_add="INSERT INTO friendship IF NOT EXIST (ID_user, ID_user_friends) VALUES ('$userID','$friendID)";
        return $this->db->query($query_add);
    }
    public function delete_friend ($user_ID, $friendID) {
        $query_del = "DELETE FROM friendship WHERE ID_user = '$user_ID AND ID_user_friends='$friendID'";
        return $this->db->query($query_del);
    }
}