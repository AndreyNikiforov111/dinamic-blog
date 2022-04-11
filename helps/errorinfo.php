
<?php

//echo $errMsg;
//test($errMsg);
//print_r(count($errMsg));

//test(selectAll('users'));
?>
<span style="color: red; list-style: none; margin-top: 20px">
<?php if(count($errMsg) > 0):?>
   <?php foreach ($errMsg as  $value): ?>
        <li > <?='*'.$value; ?> </li>
   <?php endforeach;?>
<?php endif?>
</span>









