<?php 

function field($id, $label, $type){
    echo "
        <section>
            <label for=\"$id\">$label</label><br>
            <input type=\"$type\" name=\"$id\" id=\"$id\">
        </section>   
    ";
}

function button($form, $name, $value){
    echo "
        <section>
            <br>
            <button form=\"$form\" name=\"$name\">$value</button>
        </section>
    ";
}

function validate($pattern, $value){
    if(@preg_match(@$patterns["$pattern"], $value)){
        return true;
    }else{
        return false;
    }
}

function notice($notice){
    if(!empty($notice)){
        echo $notice;
    }
}

?>