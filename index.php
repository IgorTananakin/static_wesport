<?php 
require_once(dirname(__DIR__).'/wp-load.php');  //Подключаем wordpress

wp_head();   //подгружаем стили которые в шапке



echo do_shortcode( '[elementor-template id="285143"]' );  //секция шапки сайта с лого и входом
if ( is_user_logged_in() ) {
echo do_shortcode ('[sc name="static_igor"]');
?>

<?php 
//запрос получение команды
$teams = $wpdb->get_results('SELECT wp_posts.ID,wp_posts.post_title FROM wp_posts
                        WHERE wp_posts.ID IN (202890,244061,202902,204656,202964,202895,202946,207567,202889,202140,202961,204898,204875,202958,273392,204658,273394,273403,273398,204911,204878,204662,212951,204903,244059,207566,202959,207509,202908,204665,204900,202957,
                                              202137,202898,207504,202903,204901,207491,202962,202153,204681,212954,204670,204896,205484,202952,204669,204892,207508,229960,202909,202151,202157,202955,202942,272575,204657,204897,204902,202138,204672,204674,204893,236091,202156,269718,202907,202943,202944,202963,202951,202904,204679,202888,204660,202897,204675,202893,202886,202954,202155,202900,202945,205479,212959,207505,202892,202899,202896,212958,204676,205481,204663,204874,204877,269716,212952,202905,202154,202152,202956,212953,202906,202960,204876,204664,207510,202139,202885,202894,207506,207507,204894,202142,202950,202947,204673,229468,236098,212950,204895,205482,236100,204680,202158,207565,202949,205472,212956,212957,244057,272578,204682,202941,205480,204899,202144,202148,202143,202147,202149,202146,202150,202145,236096,204671,230157,202891)
                        GROUP BY wp_posts.post_title', ARRAY_A);



?>
 <!doctype html>
<html lang="ru">
<head>
  <!-- Кодировка веб-страницы -->
  <meta charset="utf-8">
  <!-- Настройка viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Форма выгрузки</title> 


  <!-- стили для множественного выбора -->
  <link rel="stylesheet" href="css/style_for_many_select.css">
  <!-- Bootstrap CSS (jsDelivr CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
  <!-- <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

</head>
<body>
<style>
.form-control{margin-bottom:13px}
</style>


<?php  ?>
<div class="container  ">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4 well well-sm">
        <legend><a href="https://bootstraptema.ru/stuff/0-0-0-0-1"><i class="glyphicon glyphicon-home"></i></a> Форма выгрузки</legend>
            <form action="phpspreadsheet/get_static.php" method="post" class="form" role="form">
                <label for="date">Выгрузить</label>
                <input type="date" class="form-control" id="date_start" name="date_start" placeholder="Дата" min="2020-01-01" max="<?php echo  date('Y-m-d');?>" required> 
                <label for="date_end">Выгрузить по</label>
                <input type="date" class="form-control" id="date_end" name="date_end" placeholder="Дата" max="<?php echo  date('Y-m-d');?>" required>
                
                <label for="date">Команды</label>
                <div class="row">
                    <div class="col-xs-6 col-md-6" id="team">
                        
                        <!-- <div class="checkselect" > -->
                            <?php 
                                    // var_dump($connection->name_team2());
                                    //foreach($connection->name_team_in_liga(13494) as $key => $value) {
                                        
                                        //$name_team = $connection->name_team()[$key]['post_title']; ?>

                                        <!-- <label ><input type="checkbox" name="teams[]" value="<?php //echo $key;?>"> <?php //echo $name_team; ?></label> -->

                            <?php //} ?>
                           
                        <!-- </div> -->
                    </div>
                    
                    <!-- если только по командам -->
                    <!-- <div class="col-xs-5 col-md-5"> -->
                        <div class="checkselect">
                        <!-- <optgroup label="Alaskan/Hawaiian Time Zone"> -->
                            <?php 
                            $teams_gandboll = $wpdb->get_results('SELECT wp_posts.ID,wp_posts.post_title FROM wp_posts
                            WHERE wp_posts.ID IN (204911,204903,204908,229960,204909,230154)
                            GROUP BY wp_posts.post_title', ARRAY_A);
                                // $name_team = "1";
                                foreach($teams_gandboll as $key => $value) { 
                                    $name_team = $teams_gandboll[$key]['post_title'];
                                    //$id_liga = $connection->all_ligs()[$key]['term_id']; ?>
                                    
                                    <label>Ганбол <input type="checkbox"  name="teams[]" value="<?php echo $name_team;?>" > <?php echo $name_team;?></label>
                                
                            <?php } ?>
                            <?php 
                            $teams_fotball = $wpdb->get_results('SELECT wp_posts.ID,wp_posts.post_title FROM wp_posts
                            WHERE wp_posts.ID IN (202953,202887,212951,207566,202959,202908,202957,202898,202903,202962,212954,202952,202909,202955,202942,202907,202943,202944,202963,202951,202904,202888,202897,202893,202886,202954,202900,202945,212959,202892,202899,202896,212958,212952,202905,202956,212953,202906,202960,202885,202894,202950,202947,212950,207565,202949,212956,212957,202901,202941,202891,202890,202902,202964,202895,202946,207567,202889,202961,202958)
                            GROUP BY wp_posts.post_title', ARRAY_A);
                                // $name_team = "1";
                                foreach($teams_fotball as $key => $value) { 
                                    $name_team_football = $teams_fotball[$key]['post_title'];
                                    //$id_liga = $connection->all_ligs()[$key]['term_id']; ?>
                                    
                                    <label>Футбол <input type="checkbox"  name="teams[]" value="<?php echo $name_team_football;?>" > <?php echo $name_team_football;?></label>
                                
                            <?php } ?>
                            <?php 
                            $teams_hoccey = $wpdb->get_results('SELECT wp_posts.ID,wp_posts.post_title FROM wp_posts
                            WHERE wp_posts.ID IN (202141,202137,202153,202151,202157,202138,202156,202155,202154,202152,202139,202142,202158,202148,202147,202149,202150,202140)
                            GROUP BY wp_posts.post_title', ARRAY_A);
                                // $name_team = "1";
                                foreach($teams_hoccey as $key => $value) { 
                                    $name_team_hoccey = $teams_hoccey[$key]['post_title'];
                                    //$id_liga = $connection->all_ligs()[$key]['term_id']; ?>
                                    
                                    <label>Хоккей <input type="checkbox"  name="teams[]" value="<?php echo $name_team_hoccey;?>" > <?php echo $name_team_hoccey;?></label>
                                
                            <?php } ?>
                            <?php 
                            $teams_tenis = $wpdb->get_results('SELECT wp_posts.ID,wp_posts.post_title FROM wp_posts
                            WHERE wp_posts.ID IN (225555,266832,225512,261694,225502,225510,219497,230619,281290,225506,225497,261692,225514,271279,265122,225542,276658,261696,261695,261431,265123,208848,208849,225500,264904,225528,225520,225537,268684,225508,266835,265118,225532,225526,219496,267912,265119,225556,225518,225524,264903,225548,262463,225522,225530)
                            GROUP BY wp_posts.post_title', ARRAY_A);
                                // $name_team = "1";
                                foreach($teams_tenis as $key => $value) { 
                                    $name_team_tenis = $teams_tenis[$key]['post_title'];
                                    //$id_liga = $connection->all_ligs()[$key]['term_id']; ?>
                                    
                                    <label>Тенис <input type="checkbox"  name="teams[]" value="<?php echo $name_team_tenis;?>" > <?php echo $name_team_tenis;?></label>
                                
                            <?php } ?>
                            <?php 
                            $teams_voleybol = $wpdb->get_results('SELECT wp_posts.ID,wp_posts.post_title FROM wp_posts
                            WHERE wp_posts.ID IN (207509,207504,207491,205484,207508,272575,269718,205479,207505,205481,269716,207510,207506,207507,229468,205482,205472,272578,205480)
                            GROUP BY wp_posts.post_title', ARRAY_A);
                                // $name_team = "1";
                                foreach($teams_voleybol as $key => $value) { 
                                    $name_team_voleybol = $teams_voleybol[$key]['post_title'];
                                    //$id_liga = $connection->all_ligs()[$key]['term_id']; ?>
                                    
                                    <label>Волейбол <input type="checkbox"  name="teams[]" value="<?php echo $name_team_voleybol;?>" > <?php echo $name_team_voleybol;?></label>
                                
                            <?php } ?>
                            <?php 
                            $teams_kriket = $wpdb->get_results('SELECT wp_posts.ID,wp_posts.post_title FROM wp_posts
                            WHERE wp_posts.ID IN (204662,204665,204681,204657,236091,204679,204660,204663,204874,204877,204876,204664,236098,236100,204680,204682,236096,204656,204875,204658)
                            GROUP BY wp_posts.post_title', ARRAY_A);
                                // $name_team = "1";
                                foreach($teams_kriket as $key => $value) { 
                                    $name_team_kriket = $teams_kriket[$key]['post_title'];
                                    //$id_liga = $connection->all_ligs()[$key]['term_id']; ?>
                                    
                                    <label>Крикет <input type="checkbox"  name="teams[]" value="<?php echo $name_team_kriket;?>" > <?php echo $name_team_kriket;?></label>
                                
                            <?php } ?>
                            <?php 
                            $teams_basketball = $wpdb->get_results('SELECT wp_posts.ID,wp_posts.post_title FROM wp_posts
                            WHERE wp_posts.ID IN (204878,244059,204900,204901,204670,204669,204892,204897,204902,204672,204674,204893,204675,204676,204894,204673,244057,204899,204671,244061)
                            GROUP BY wp_posts.post_title', ARRAY_A);
                                // $name_team = "1";
                                foreach($teams_basketball as $key => $value) { 
                                    $name_team_basketball = $teams_basketball[$key]['post_title'];
                                    //$id_liga = $connection->all_ligs()[$key]['term_id']; ?>
                                    
                                    <label>Баскетбол <input type="checkbox"  name="teams[]" value="<?php echo $name_team_basketball;?>" > <?php echo $name_team_basketball;?></label>
                                
                            <?php } ?>
                            
                           
                            
                                

                       
                        </div>
                    <!-- </div> -->
                    
                    
                    
                    

                   

                </div>
                

                <button class="btn btn-lg btn-primary btn-block" type="submit" style="background:#2D6B56;">Запросить</button>
            </form>
        </div>
    </div>

 </div>


<?php ?>
</body>
<!-- script множественного выбора -->
<!-- <script src="js/script_for_many_select.js"></script> -->
<!-- script событий -->

<script src="js/events.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script> -->
</html>
<?php } ?>
<?php
 
//get footer  подгружаем футер + стили для элементера
get_footer();

?>
<style>
    .glyphicon {display: none;}
</style>
