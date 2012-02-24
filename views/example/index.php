Test
<ul>
<?php foreach ($list as $key => $example) {
?>
<li><?php echo $key." => ".$example->value. "( ".get_class($example)." )"  ?></li>
<?php }  ?>
</ul>
<?php $this->content_for("title","Example"); ?>
Test2