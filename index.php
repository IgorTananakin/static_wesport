<?php 
require 'class/db.php';
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

  <script src="http://code.jquery.com/jquery.js"></script>
  <!-- стили для множественного выбора -->
  <link rel="stylesheet" href="css/style_for_many_select.css"> 
  <!-- Bootstrap CSS (jsDelivr CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
</head>
<body>
<style>
.form-control{margin-bottom:13px}
</style>

<!-- <div class="col-xs-12 col-sm-12 col-md-4 "> -->
<div class="container  ">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4 well well-sm">
        <legend><a href="https://bootstraptema.ru/stuff/0-0-0-0-1"><i class="glyphicon glyphicon-home"></i></a> Форма выгрузки</legend>
            <form action="get_statit_exel.php" method="post" class="form" role="form">
                <label for="date">Выгрузить с</label>
                <input type="date" class="form-control" id="date_start" name="date_start" placeholder="Дата" min="1980-01-01" required>

                <label for="date_end">Выгрузить по</label>
                <input type="date" class="form-control" id="date_end" name="date_end" placeholder="Дата" required>

                <label for="date">Данные о команде</label>
                <div class="row">

                    <div class="col-xs-5 col-md-5">
                        <select class="form-control">
                            <option value="День">Выберите лигу</option>
                            <?php foreach($connection->all_ligs() as $key => $value) { 
                                   $name_lige = $connection->all_ligs()[$key]['name']; ?>
                                <option value="1"><?php echo $name_lige;?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-xs-6 col-md-6">
                        
                        <div class="checkselect">
                            <?php 
                                    // var_dump($connection->name_team2());
                                    foreach($connection->name_team2() as $key => $value) {
                                        
                                        //$name_team = $connection->name_team()[$key]['post_title']; ?>

                                        <label><input type="checkbox" name="teams[]" value="<?php echo $key;?>"> <?php echo $name_team; ?></label>

                            <?php } ?>
                           
                        </div>
                    </div>

                   

                </div>
                

                <button class="btn btn-lg btn-primary btn-block" type="submit">Запросить</button>
            </form>
        </div>
    </div>

 </div>


<!-- </div> -->
<!-- <link rel="stylesheet" href="daterangepicker/daterangepicker.css">
<script src="daterangepicker/moment.js"></script>
<script src="daterangepicker/daterangepicker.js"></script> -->


</body>
<!-- script множественного выбора -->
<script src="js/script_for_many_select.js"></script>
</html>