<!DOCTYPE html>
<html lang="en" class="js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Effects</title>
    <style>
      body {
        width: 600px;
        margin: auto;
        font-family: sans-serif;
      }

      #contact {
        background: #e3e3e3;
        padding: 1em 2em;
        position: relative;
      }

      .js #contact {
        position: absolute;
        top: 0;
        width: inherit;
        display: none;
      }

      #contact h2 { margin-top: 0;}
      #contact ul { padding: 0; }
    </style>
  </head>
  <body>
    <h1>Hello, World</h1>
    {{ $tt }}
    <form action="" enctype="multipart/form-data">
      name <input type="text" name="name" id="">
      <br>
      images <input type="file" name="image[]" multiple>
      <br>
      <button type="submit">Submit</button>
    </form>

    <script>
      (function() {
        var form = document.querySelector("form");
        var request = new XMLHttpRequest();
        console.log(form);

        form.addEventListener("submit", function(e) {
          e.preventDefault();
          var formdata = new FormData(form);
          request.open('post','submit');
          request.send(formdata);
          //return false;
        },false);

      })();
    </script>
  </body>
</html>