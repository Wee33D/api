<!DOCTYPE html>
<html lang="en">
  <head>
    <title>List All Contacts</title>

    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container mt-5">
      <h2>Patients</h2>
      <button type="button" class="btn btn-primary" id="addpatient">
        Add new Patient</button
      ><br /><br />
      <table class="table" id="Contacts">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Mobile No</th>
            <th scope="col">E-mail</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script>
      $(function () {
        $.ajax({
          type: "get",
          url: "Contacts",
          dataType: "json",
          success: function (data) {
            data.forEach((p) => {
            
              $("#Contacts tbody").append(
                "<tr>" +
                  "   <td>" +
                  p.id +
                  "</td>" +
                  "   <td><a href='display.html?id=" +
                  p.id +
                  "'>" +
                  p.name +
                  "</a></td>" +
                  "   <td>" +
                  p.phonenum +
                  "</td>" +
                  "   <td>" +
                  p.email +
                  
                  
                  "</td>" +
                  "   <td><a href='display.html?id=" +
                  p.id +
                  "'>View Patient</a>  |  " +
                  "<a href='update.html?id=" +
                  p.id +
                  "'>Update Patient</a><br/> <br/>" +
                  "<button class='btn btn-sm btn-warning'  type='button' data-id='" +
                  p.id +
                  "' data-status='2'>Set ICU</button> |  " +
                  "<button class='btn btn-sm btn-warning' type='button' data-id='" +
                  p.id +
                  "' data-status='3'>Set Clinical Death</button> | " +
                  "<button class='btn btn-sm btn-warning' type='button' data-id='" +
                  p.id +
                  "' data-status='4'>Set Discharge</button><br /><br /></td>" +
                  "</tr>"
              );
            });
          },
          error: function () {
            console.log("error");
          },
        });

        $("#addpatient").click(function () {
          window.location.href = "insert.html";
        });

        $("#patients").on("click", "button", function () {
          var id = this.getAttribute("data-id");
          var status = this.getAttribute("data-status");

          const patient = {
            status: status,
          };

          $.ajax({
            type: "put",
            url: "api/patients/status/" + id, //api/patients/status
            contentType: "application/json",
            data: JSON.stringify(patient),
            dataType: "json",
            success: function (data) {
              window.location.reload();
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
