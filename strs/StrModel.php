<?php
//model user.php
$array = array('id','firstName', 'lastName', 'email', 'active');

$str_model_user = "<?php \n".

                    "namespace model;\n".
                    "\n".
                    "\n".
                    "\n".
                    "class User {\n".
                    "\n".
                    "\n".

                        "   private $".$array[0].";\n".
                        "   private $".$array[1].";\n".
                        "   private $".$array[2].";\n".
                        "   private $".$array[3].";\n".
                        "   private $".$array[4].";\n".
                        "\n".
                        "\n".
                        "   public function __construct(){}\n".
                        "\n".
                        "\n".
                        "   public function toArray(){\n".
                        "       return get_object_vars(\$this);\n
                    }"
;


foreach ($array as $item) {
    //getter
    $str_model_user .= "\n   public function get".ucfirst($item)."(){\n".
                            "      return $"."this->".$item.";\n   }";

    //setter
    $str_model_user .= "\n   public function set".ucfirst($item)."(\$".$item."){\n".
                            "      \$this->".$item."    = \$".$item.";\n      return \$this; \n   }\n\n";
}
$str_model_user .="}";