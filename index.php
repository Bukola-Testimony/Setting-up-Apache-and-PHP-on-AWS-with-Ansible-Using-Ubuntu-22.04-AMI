<html>
  <head>
    <title>ApachePHP</title>
  </head>
<style>
  body{
    background-color: lightgray;
    }
    
  h1{
    font-size: 40px;
    color: black;
    text-align: center;
    }
</style>

  
  <body>
    <h1>THIS IS MY APACHE WEB SERVER</h1>
    <?php echo '<p>Hello World!</p>'; ?> 
    <?php 
    echo 'This is the current date and time:  ';
    echo PHP_EOL;
    echo (date("F d, Y h:i:s A e,", time()));
    ?> 

  </body>
</html>