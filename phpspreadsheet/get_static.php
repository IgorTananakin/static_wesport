
<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

 require '/var/www/www-root/data/www/scout/wp-load.php';  //Подключаем wordpress
global $wpdb;
//var_dump($wpdb);
$static = $wpdb->get_results("SELECT wp_terms.name as лига_с_дивизионом,  wp_posts_1.post_title as хозяева,
wp_postmeta.meta_value as счёт_хозяев,wp_postmeta_1.meta_value as счёт_гостей, wp_posts_2.post_title as гости,
wp_joomsport_matches.date as дата,
wp_joomsport_matches.time as время FROM wp_terms 
INNER JOIN wp_joomsport_matches ON wp_joomsport_matches.mdID = wp_terms.term_id 
INNER JOIN wp_posts ON wp_posts.ID = wp_joomsport_matches.postID 
INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.ID 
INNER JOIN wp_posts wp_posts_1 ON wp_posts_1.ID = wp_joomsport_matches.teamHomeID 
INNER JOIN wp_posts wp_posts_2 ON wp_posts_2.ID = wp_joomsport_matches.teamAwayID 
INNER JOIN wp_postmeta wp_postmeta_1 ON wp_postmeta_1.post_id = wp_postmeta.post_id
WHERE wp_postmeta.meta_key = '_joomsport_home_score' 
AND wp_postmeta_1.meta_key = '_joomsport_away_score'
AND wp_joomsport_matches.date > '" . $start . "' 
AND wp_joomsport_matches.date < '" . $end . "'
AND wp_posts_1.post_title IN ('" . $teams_sql . "')
GROUP BY wp_posts.post_title", ARRAY_A);
// var_dump($static);
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$fileName = "test.xls";
//require '../class/db.php';
$start = $_POST['date_start'];
$end = $_POST['date_end'];
$teams = $_POST['teams'];
//var_dump($_POST);
$teams_sql = implode(',', $teams); //преобразования для запроса
//var_dump($teams_sql);
$trans = array("," => "','");//преобразования для запроса
$teams_sql = strtr($teams_sql, $trans);//преобразования для запроса

$result_sql = $wpdb->get_results("SELECT wp_terms.name as лига_с_дивизионом,  wp_posts_1.post_title as хозяева,
                                    wp_postmeta.meta_value as счёт_хозяев,wp_postmeta_1.meta_value as счёт_гостей, wp_posts_2.post_title as гости,
                                    wp_joomsport_matches.date as дата,
                                    wp_joomsport_matches.time as время FROM wp_terms 
                                    INNER JOIN wp_joomsport_matches ON wp_joomsport_matches.mdID = wp_terms.term_id 
                                    INNER JOIN wp_posts ON wp_posts.ID = wp_joomsport_matches.postID 
                                    INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.ID 
                                    INNER JOIN wp_posts wp_posts_1 ON wp_posts_1.ID = wp_joomsport_matches.teamHomeID 
                                    INNER JOIN wp_posts wp_posts_2 ON wp_posts_2.ID = wp_joomsport_matches.teamAwayID 
                                    INNER JOIN wp_postmeta wp_postmeta_1 ON wp_postmeta_1.post_id = wp_postmeta.post_id
                                    WHERE wp_postmeta.meta_key = '_joomsport_home_score' 
                                    AND wp_postmeta_1.meta_key = '_joomsport_away_score'
                                    AND wp_joomsport_matches.date > '" . $start . "' 
                                    AND wp_joomsport_matches.date < '" . $end . "'
                                    AND wp_posts_1.post_title IN ('" . $teams_sql . "')
                                    GROUP BY wp_posts.post_title", ARRAY_A);

// echo "<br><br><br><br><br>";
//var_dump($result_sql);
// function array_unique_key($array, $key) { 
// 	$tmp = $key_array = array(); 
// 	$i = 0; 
 
// 	foreach($array as $val) { 
// 		if (!in_array($val[$key], $key_array)) { 
// 			$key_array[$i] = $val[$key]; 
// 			$tmp[$i] = $val; 
// 		} 
// 		$i++; 
// 	} 
// 	return $tmp; 
// }
// $result_sql = array_unique_key($result_sql, 'команды');
//  var_dump($result_sql);
echo "Статистика команд";

if (!empty($result_sql)) {
    //make a new spreadsheet object
    $spreadsheet = new Spreadsheet();
    //get current active sheet (first sheet)
    $sheet = $spreadsheet->getActiveSheet();
    //set the value of cell a1 to "Hello World!"
    // $sheet->setCellValue('A1', 'Hello World !');
    $sheet->setCellValue('A1', 'Сезон с лигой');
    $sheet->setCellValue('B1', 'Хозяева');
    $sheet->setCellValue('C1', 'Счёт хозяев');
    $sheet->setCellValue('D1', 'Счёт гостей');
    $sheet->setCellValue('E1', 'Гости');
    $sheet->setCellValue('F1', 'Дата ');
    $sheet->setCellValue('G1', 'Время ');

    $i = 1;
    foreach ($result_sql as $line ) {
        $i++;
        foreach ($line as $key => $value) {
            
            $sheet->setCellValue('A' . $i, $line["лига_с_дивизионом"]);
            $sheet->setCellValue('B' . $i, $line["хозяева"]);
            $sheet->setCellValue('C' . $i, $line["счёт_хозяев"]);
            $sheet->setCellValue('D' . $i, $line["счёт_гостей"]);
            $sheet->setCellValue('E' . $i, $line["гости"]);
            $sheet->setCellValue('F' . $i, $line["дата"]);
            $sheet->setCellValue('G' . $i, $line["время"]);
        }
    }
    //make an xlsx writer object using above spreadsheet
    $writer = new Xlsx($spreadsheet);
    //write the file in current directory
    $writer->save('статистика команд' .  date('Y-m-d') . '.xlsx');
    //redirect to the file
    echo "<meta http-equiv='refresh' content='0;url=статистика команд" . date('Y-m-d') . ".xlsx'/> ";
    
//     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="статистика команд.xlsx"');
// header('Cache-Control: max-age=0');
    
}

 //header("Location: http://localhost/wesport/index.php");
 //exit( );
 ?>

