<?php
//this file is for custom js bundling
?>
<script>
(function() {

<?php include_once(realpath(dirname(__FILE__)).'/js/init.js') ?>
<?php include_once(realpath(dirname(__FILE__)).'/js/main.js') ?>
<?php include_once(realpath(dirname(__FILE__)).'/js/chart.js') ?>

})();
</script>