Test
<ul>
<?php foreach ($list as $key => $example) {
?>
<li><?php echo $key." => ".$example->value  ?></li>
<?php }  ?>
</ul>
<?php $this->content_for("title","Example"); ?>
Test2