<br>
<div class="module-form">
<?php
    echo $form->field($generator, 'githubUserAccount');
    echo $form->field($generator, 'changeLogDiff');
    echo $form->field($generator, 'packageName');
    echo $form->field($generator, 'namespace');

    echo $form->field($generator, 'description');
    echo $form->field($generator, 'authorName');
    echo $form->field($generator, 'authorEmail');

    echo $form->field($generator, 'type')->dropDownList($generator::optsType());
    echo $form->field($generator, 'license')->dropDownList($generator::optsLicense(), ['prompt'=>'Choose...']);
    echo $form->field($generator, 'outputPath');
?>
</div>
