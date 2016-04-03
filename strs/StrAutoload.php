<?php

$str_autoload = "<?php
function __autoload(\$class_name){
    \$class_name = implode('/',explode('\\\\', \$class_name));
    \$className = '../'.\$class_name.'.php';
    include \$className;
}";