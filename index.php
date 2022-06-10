<?php 
require_once(dirname(__DIR__).'/wp-load.php');  //Подключаем wordpress

wp_head();   //подгружаем стили которые в шапке



echo do_shortcode( '[elementor-template id="285143"]' );  //секция шапки сайта с лого и входом
if ( is_user_logged_in() ) {
echo do_shortcode ('[sc name="static_igor"]');
?>
<?php 
//require 'class/db.php';
$teams = $wpdb->get_results('SELECT wp_posts.post_title FROM wp_posts
                        WHERE wp_posts.ID IN (202890,244061,202902,204656,202964,202895,202946,207567,202889,202140,202961,204898,204875,202958,273392,204658,273394,273403,273398,204911,204878,204662,202887,212951,204903,244059,207566,202959,207509,202908,204665,204900,202957,
                                              202137,202898,207504,202903,204901,207491,202962,202153,204681,212954,204670,204896,205484,202952,204908,204669,204892,207508,229960,202909,202151,202157,202955,202942,272575,204909,204657,204897,204902,202138,204672,204674,204893,236091,202156,269718,202907,202943,202944,202963,202951,202904,204679,202888,204660,202897,204675,202893,202886,202954,202155,202900,202945,205479,212959,207505,202892,202899,202896,212958,204676,205481,204663,204874,204877,269716,212952,202905,202154,202152,202956,212953,202906,202960,204876,204664,230154,207510,202139,202885,202894,207506,207507,204894,202142,202950,202947,204673,229468,236098,212950,204895,205482,236100,204680,202158,207565,202949,205472,212956,212957,244057,272578,204682,202941,205480,204899,202144,202148,202143,202147,202149,202146,202150,202145,236096,204671,230157,202891)
                        GROUP BY wp_posts.post_title', ARRAY_A);
// var_dump($connection->id_liga(280534));
// var_dump($connection->name_team());
// foreach ($connection->name_team2() as $key => $value) {
//     var_dump($connection->name_team2()[$key][$value]);
// }


?>
 <!doctype html>
<html lang="ru">
<head>
  <!-- Кодировка веб-страницы -->
  <meta charset="utf-8">
  <!-- Настройка viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Форма выгрузки</title> 

  <!-- <script src="http://code.jquery.com/jquery.js"></script> -->
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
<?php 
//echo "211233";
//var_dump(is_user_logged_in()); ?>
<!-- <div class="col-xs-12 col-sm-12 col-md-4 "> -->

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

                            <?php } ?>
                           
                        <!-- </div> -->
                    </div>
                    
                    <!-- если только по командам -->
                    <!-- <div class="col-xs-5 col-md-5"> -->
                        <div class="checkselect">
                            <?php 
                                // $name_team = "1";
                                foreach($teams as $key => $value) { 
                                   $name_team = $teams[$key]['post_title'];
                                   //$id_liga = $connection->all_ligs()[$key]['term_id']; ?>
                                   <label ><input type="checkbox" name="teams[]" value="<?php echo $name_team;?>" > <?php echo $name_team;?></label>
                                   
                            <?php } ?>
                       
                        </div>
                    <!-- </div> -->
                    
                    
                    
                    

                   

                </div>
                

                <button class="btn btn-lg btn-primary btn-block" type="submit" style="background:#2D6B56;">Запросить</button>
            </form>
        </div>
    </div>

 </div>


<!-- </div> -->
<!-- <link rel="stylesheet" href="daterangepicker/daterangepicker.css">
<script src="daterangepicker/moment.js"></script>
<script src="daterangepicker/daterangepicker.js"></script> -->
<?php //} ?>
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
<?php
 
//get footer  подгружаем футер + стили для элементера
get_footer();

?>
<style>
    .glyphicon {display: none;}
</style>
