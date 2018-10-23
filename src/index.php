<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dilbert Viewer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="favicon.png" sizes="196x196">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      html, body {
        width: 100%;
        height: 100%;
      }
      html {
        display: table;
      }
      body {
        display: table-cell;
        vertical-align: middle;
      }
    </style>
  </head>
  <body>
    <div id="body">
      <?php
        if (! isset($_GET['comic']))
          $_GET['comic'] = "latest";
        $command = escapeshellcmd('python3 get_dilbert.py ' . $_GET['comic']);
        $output = shell_exec($command);
        $arr = explode("\n", $output);
        if ($arr[0] === "404")
          die("Error 404: Comic not found");
        echo '<div class="text-center mt-4 mx-3"><img class="img-fluid" alt="' . $arr[1] . '" src="' . $arr[0] . '"></img></div>';
      ?>

      <br>
      <div class="text-center">
        <?php
          if ($arr[6] === "True")
          {
            echo '<a href="' . $arr[2] . '" role="button" class="btn btn-primary mt-2 mx-1 disabled" aria-disabled="true">&lt&lt</a>';
            echo '<a href="' . $arr[3] . '" role="button" class="btn btn-primary mt-2 mx-1 disabled" aria-disabled="true">&lt</a>';
          }
          else
          {
            echo '<a href="' . $arr[2] . '" role="button" class="btn btn-primary mt-2 mx-1">&lt&lt</a>';
            echo '<a href="' . $arr[3] . '" role="button" class="btn btn-primary mt-2 mx-1">&lt</a>';
          }
        ?>
        <a href="random-comic" role="button" class="btn btn-primary mt-2 mx-1">Random</a>
        <?php
          if ($arr[7] === "True")
          {
            echo '<a href="' . $arr[4] . '" role="button" class="btn btn-primary mt-2 mx-1 disabled" aria-disabled="true">&gt</a>';
            echo '<a href="' . $arr[5] . '" role="button" class="btn btn-primary mt-2 mx-1 disabled" aria-disabled="true">&gt&gt</a>';
          }
          else
          {
            echo '<a href="' . $arr[4] . '" role="button" class="btn btn-primary mt-2 mx-1">&gt</a>';
            echo '<a href="' . $arr[5] . '" role="button" class="btn btn-primary mt-2 mx-1">&gt&gt</a>';
          }
        ?>
        <br>
        <a href="<?php echo $arr[1]; ?>" target="_blank" role="button" class="btn btn-link my-3 mx-1">Permalink</a>
      </div>
    </div>
  </body>
</html>
