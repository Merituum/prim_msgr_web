<?php 
namespace Database;
class User {
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getUser_by_login($login){
        $login = $this->db->escapeString($login);
        $sql = "SELECT * FROM users WHERE Login = '$login'";
        return $this->db->query_sql($sql);
    }



    public function register($login, $password, $question_sec, $question_sec_ans){ {
        $login = $this->db->escapeString($login);
        $password = $this->db->escapeString($password);
        $question_sec = $this->db->escapeString($question_sec);
        $question_sec_ans = $this->db->escapeString($question_sec_ans);
        
        $query_register = "INSERT INTO users (Login, Password, Question_sec, Question_sec_ans) VALUES ('$login', '$password', '$question_sec', '$question_sec_ans')";


        return $this->db->query_sql($sql);
    }
}
}