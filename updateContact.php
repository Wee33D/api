<!DOCTYPE html>
<html lang="en">

<head>
  <title>Update Contact</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
</head>

<body>
  <div class="container">
    <h3>Update Contact Info</h3>
    <form action="/api/Contacts/update" method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">Id</label>
        <input type="text" class="form-control" id="id" aria-describedby="emailHelp" readonly />
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Full Name:" />
      </div>


      <div class="form-group">
        <label for="exampleInputPassword1">Contact Number</label>
        <input type="text" class="form-control" id="phonenum" placeholder="Contact Number:" />
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Email</label>
        <input type="text" class="form-control" id="email" placeholder="Email Address:" />
      </div>


      <input type="submit" class="btn btn-primary" value="Submit" />
    </form>

    <br />
    <a href="home.php">Back</a>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    $(function () {
      var getParams = function (url) {
        var params = {};
        var parser = document.createElement("a");
        parser.href = url;
        var query = parser.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
          var pair = vars[i].split("=");
          params[pair[0]] = decodeURIComponent(pair[1]);
        }
        return params;
      };

      var params = getParams(window.location.href);
      id = params.id;

      $.ajax({
        type: "get",
        url: "Contacts" + id,
        dataType: "json",
        success: function (data) {
          $("#id").val(data.id);
          $("#name").val(data.name);
          $("#phonenum").val(data.phonenum);
          $("#email").val(data.email);

        },
        error: function () {
          console.log("error");
        },
      });

      $("#ContactForm").submit(function (event) {
        event.preventDefault();

        var id = $("#id").val();

        const contact = {
          name: $("#name").val(),
          gender: $("#phonenum").val(),
          age: $("#email").val(),
          
        };

        $.ajax({
          type: "put",
          url: "Contacts" + id,
          contentType: "application/json",
          data: JSON.stringify(contact),
          dataType: "json",
          success: function (data) {
            window.location.href = "home.php";
          },
          error: function () {
            console.log("error");
          },
        });
      });
    });
  </script>
</body>

</html>