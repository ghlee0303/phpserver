<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

  <style>
    div {
    padding: 10px 50px;
    }
    .dotted {
    border-top: 1px #333 dotted;
    }
    .dotted-gradient {
    background-image: linear-gradient(to right, #333 40%, rgba(255, 255, 255, 0) 20%);
    background-position: top;
    background-size: 3px 1px;
    background-repeat: repeat-x;
    }
    .dotted-spaced {
    background-image: linear-gradient(to right, #333 10%, rgba(255, 255, 255, 0) 0%);
    background-position: top;
    background-size: 10px 1px;
    background-repeat: repeat-x;
    }
    .left {
    float: left;
    padding: 40px 10px;
    background-color: #F0F0DA;
    }
    .left.dotted {
    border-left: 1px #333 dotted;
    border-top: none;
    }
    .left.dotted-gradient {
    background-image: linear-gradient(to bottom, #333 40%, rgba(255, 255, 255, 0) 20%);
    background-position: left;
    background-size: 1px 3px;
    background-repeat: repeat-y;
    }
    .left.dotted-spaced {
    background-image: linear-gradient(to bottom, #333 10%, rgba(255, 255, 255, 0) 0%);
    background-position: left;
    background-size: 1px 10px;
    background-repeat: repeat-y;
    }
  </style>
  
  <body>
    <div>no
    <br>border</div>
    <div class='dotted'>dotted
    <br>border</div>
    <div class='dotted-gradient'>dotted
    <br>with gradient</div>
    <div class='dotted-spaced'>dotted
    <br>spaced</div>

    <div class='left'>no
    <br>border</div>
    <div class='dotted left'>dotted
    <br>border</div>
    <div class='dotted-gradient left'>dotted
    <br>with gradient</div>
    <div class='dotted-spaced left'>dotted
    <br>spaced</div>

  </body>
</html>