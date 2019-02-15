<?php

function render_template($project_dir, $template, $vars)
{
    extract($vars);
    ob_start();
    include($template);
    $r = ob_get_contents();
    ob_end_clean();
    $r = "<?php".PHP_EOL."$r".PHP_EOL."?>";
    $fp = fopen("$result_file", "w");
    fwrite($fp, $r);
    fclose($fp);
}

$project_dir = $argv[1];
$template = $argv[2];
$vars = json_decode($argv[3], true);
render_template($project_dir, $template, $vars);
?>
