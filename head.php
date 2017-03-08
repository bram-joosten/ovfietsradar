<?php include_once(dirname(__FILE__).'/cfg/config.php');?>
<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>OV Fiets Radar</title>
    <meta name="author" content="Bram Joosten">
    <meta name="description" content="Be smarter about your OV bike rental, learn about your location">
    <meta name="keywords" content="OV Bike, historic data, prediction, public transport">
    <!-- <link rel='stylesheet' href='//fonts.googleapis.com/css?family=font1|font2|etc' type='text/css'> -->
    <style type="text/css">
    <?php include_once(realpath(dirname(__FILE__)).'/node_modules/bootstrap/dist/css/bootstrap.min.css') ?>
    <?php include_once(realpath(dirname(__FILE__)).'/node_modules/tether/dist/css/tether.min.css') ?>
    <?php include_once(realpath(dirname(__FILE__)).'/css/main.css') ?>
    </style>
    <div id="data-environment" data-environment="<?php echo $environment?>"></div>
     
  </head>