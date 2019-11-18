<?php
    class FormBuilder{
        private static $header = '
<html>
  <head>
    <title> :pName </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
      <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
              <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="brand" href="#"> :pName </a>
              <div class="nav-collapse collapse">
                <ul class="nav">
                  <li class="active"><a href="index.php"> :pName </a></li>               
                </ul>
              </div>
          </div>
        </div>';

        private static $footer = '
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>';

        private static $body = '
<?php
    require_once("../autoload.php");
    require_once("header.php");
?>

    <form action = "" method = "post">
        <div class = "container">  
            <b> :pName Classes </b>
            <select class="form-control form-control-sm" name = "selClasses" id = "selClasses" >
                :claOptions
            </select> <br><br>
            <b> :pName Tables </b>
            <select class="form-control form-control-sm" name = "selTables" id = "selTables" >
                :tabOptions
            </select>
        </div>
    </form>

<?php require_once("footer.php"); ?>';



    private static function generateOptions($classes){
        $res = "";
        foreach ($classes as $classN => $value) {
            $res .= "<option> ". ucfirst($classN) ." </option>\n";
        }
        return $res;
    }

    private static function persist($dir, $cont, $fileNa){
        $f = fopen($dir."view". DIRECTORY_SEPARATOR. $fileNa. ".php", "w");
        fwrite($f, $cont);
        fclose($f);
    }

    public static function createForm($dir, $classes, $tables, $pName){
        $fBody = str_replace(":claOptions", FormBuilder:: generateOptions($classes), FormBuilder:: $body);
        $fBody = str_replace(":tabOptions", FormBuilder:: generateOptions($tables), $fBody);
        $fBody = str_replace(":pName", $pName, $fBody);
        $fHeader = str_replace(":pName", $pName, FormBuilder:: $header);
        FormBuilder:: persist($dir, $fBody, $pName); // Perhaps changing "pName" to "index"...
        FormBuilder:: persist($dir, $fHeader, "header");
        FormBuilder:: persist($dir, FormBuilder:: $footer, "footer");
    }
}
 ?>