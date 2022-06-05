<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
class BD extends PDO {
    public function id_liga($idmath) {
        return $this->query('SELECT wp_terms.term_id FROM wp_postmeta 
                             INNER JOIN wp_term_relationships ON wp_postmeta.meta_value = wp_term_relationships.object_id 
                             INNER JOIN wp_terms ON wp_term_relationships.term_taxonomy_id = wp_terms.term_id 
                             WHERE wp_postmeta.post_id = "' . $idmath . '"' )->fetchAll(PDO::FETCH_ASSOC);
    }
    public function all_ligs() {
       return $this->query('SELECT name FROM wp_terms WHERE wp_terms.term_id IN(16253,13563, 13564, 13557, 13558, 13559, 13560, 13561, 13562)')->fetchAll(PDO::FETCH_ASSOC);
    }
    public function term_id($name_lige) {
        return $this->query('SELECT * FROM wp_terms WHERE wp_terms.name = "' . $name_lige . '"');
    }



    public function t_id($t_id) {
        return $this->query('SELECT * FROM wp_terms 
                             INNER JOIN wp_joomsport_live_match_events ON wp_terms.term_id = wp_joomsport_live_match_events.t_id 
                             WHERE wp_terms.term_id = "' . $t_id . '"');
    }

    public function name_team() {
        return $this->query('SELECT wp_posts.post_title FROM wp_posts 
                            INNER JOIN wp_joomsport_live_match_events 
                            ON wp_posts.ID = wp_joomsport_live_match_events.t_id 
                             LIMIT 40')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function name_team2() {
        return $this->query('SELECT wp_posts.post_title FROM wp_terms 
                            INNER JOIN wp_joomsport_matches ON wp_joomsport_matches.mdID = wp_terms.term_id 
                            INNER JOIN wp_posts ON wp_posts.ID = wp_joomsport_matches.teamHomeID
                            GROUP BY wp_posts.post_title
                            LIMIT 200')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sesson_static() {
        return $this->query('SELECT wp_terms.name as лига_с_дивизионом, wp_postmeta.meta_value as домашний_счёт, wp_posts.post_title as команды, wp_postmeta_1.meta_value as противника_счёт, wp_joomsport_matches.date as дата_проведения, wp_joomsport_matches.time as время_проведения FROM wp_terms 
                            INNER JOIN wp_joomsport_matches ON wp_joomsport_matches.mdID = wp_terms.term_id 
                            INNER JOIN wp_posts ON wp_posts.ID = wp_joomsport_matches.postID
                            INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.ID
                            INNER JOIN wp_postmeta wp_postmeta_1 ON wp_postmeta_1.post_id = wp_postmeta.post_id 
                            WHERE wp_postmeta.meta_key = "_joomsport_home_score" 
                            AND wp_postmeta_1.meta_key = "_joomsport_away_score" 
                            AND wp_joomsport_matches.date > "2021-09-24" 
                            AND wp_joomsport_matches.date < "2021-09-30"')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sesson_static2($start,$end) {
        return $this->query('SELECT wp_terms.name as лига_с_дивизионом, wp_postmeta.meta_value as домашний_счёт, wp_posts.post_title as команды, wp_postmeta_1.meta_value as противника_счёт, wp_joomsport_matches.date as дата_проведения, wp_joomsport_matches.time as время_проведения FROM wp_terms 
                            INNER JOIN wp_joomsport_matches ON wp_joomsport_matches.mdID = wp_terms.term_id 
                            INNER JOIN wp_posts ON wp_posts.ID = wp_joomsport_matches.postID
                            INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.ID
                            INNER JOIN wp_postmeta wp_postmeta_1 ON wp_postmeta_1.post_id = wp_postmeta.post_id 
                            WHERE wp_postmeta.meta_key = "_joomsport_home_score" 
                            AND wp_postmeta_1.meta_key = "_joomsport_away_score" 
                            AND wp_joomsport_matches.date > "' . $start . '" 
                            AND wp_joomsport_matches.date < "' . $end . '"')->fetchAll(PDO::FETCH_ASSOC);
    }
    //SELECT * FROM wp_terms INNER JOIN wp_joomsport_matches ON wp_joomsport_matches.mdID = wp_terms.term_id INNER JOIN wp_posts ON wp_posts.ID = wp_joomsport_matches.teamHomeID GROUP BY wp_posts.post_title;

    //SELECT wp_terms.term_id, wp_terms.name as сезон_с_лигой, wp_joomsport_matches.mdID, wp_posts.ID, wp_posts.post_title FROM wp_terms INNER JOIN wp_joomsport_matches ON wp_joomsport_matches.mdID = wp_terms.term_id INNER JOIN wp_posts ON wp_posts.ID = wp_joomsport_matches.teamHomeID GROUP BY wp_posts.post_title;

    // SELECT wp_terms.term_id, wp_terms.name as сезон_с_лигой, wp_joomsport_matches.mdID, wp_posts.ID, wp_posts.post_title, wp_joomsport_matches.date as дата_прохождения_матча, wp_joomsport_matches.time as время_прохождения_матча FROM wp_terms INNER JOIN wp_joomsport_matches ON wp_joomsport_matches.mdID = wp_terms.term_id INNER JOIN wp_posts ON wp_posts.ID = wp_joomsport_matches.teamHomeID;

}

$connection = new BD('mysql:host=localhost;dbname=wesport_scout_05_31_12;charset=utf8', 'root', '');