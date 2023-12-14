window.addEventListener(
  "DOMContentLoaded",
  () => {
    $(document).on("submit", "#insertdata", (event) => {
      event.preventDefault();

      const email = $("#email").val();
      const firstname = $("#firstname").val();
      const lastname = $("#lastname").val();
      const address = $("#address").val();
      const insert = $("#insert").val();

      $.ajax({
        url: "classes/class_model.php",
        type: "POST",
        data: {
          email: email,
          firstname: firstname,
          lastname: lastname,
          address: address,
          insert: insert,
        },
        success: function (response) {
          //   console.log(response);
          // use stringify already json.parse from php function
          const stringify = JSON.stringify(response);
          //   DISPLAY EVERY RESPONSE
          $("#message").html(stringify).delay(5000).fadeOut(400);
          // AUTO DISPLAY ALL DATA REALTIME
          fetchAll();
        },
        error: function (jqXHR, exception) {
          var msg = "";
          if (jqXHR.status === 0) {
            msg = "Not connect.\n Verify Network.";
          } else if (jqXHR.status == 404) {
            msg = "Requested page not found. [404]";
          } else if (jqXHR.status == 500) {
            msg = "Internal Server Error [500].";
          } else if (exception === "parsererror") {
            msg = "Requested JSON parse failed.";
          } else if (exception === "timeout") {
            msg = "Time out error.";
          } else if (exception === "abort") {
            msg = "Ajax request aborted.";
          } else {
            msg = "Uncaught Error.\n" + jqXHR.responseText;
          }
          $("#message").html(msg);
        },
      });
      //   AFTER SEND DATA RESET
      $("#insertdata")[0].reset();
    });
    // ---------------------------------------------------------------------------------------------
    // FETCH ALL DATA AJAX SCRIPT
    function fetchAll() {
      $.ajax({
        type: "GET",
        url: "classes/class_model.php?fetchall=1",
        dataType: "html",
        success: function (response) {
          //   console.log(JSON.stringify(response));
          const dresponse = JSON.parse(response);
          //   $("#table-container").html(response);
          //   const data = JSON.stringify(response);
          let html = "";

          dresponse.forEach((datas, index) => {
            html += `
            <tr>
            <td>${datas.email}</td>
            <td>${datas.firstname}</td>
            <td>${datas.lastname}</td>
            <td>${datas.address}</td>
            <td><a href="#" class="editLink" data-editId="${datas.id}" >Edit</a> | 
            <a href="#" class="deleteLink" data-deleteId="${datas.id}" onclick="return confirm('Are you sure to delete this?');" >Delete</a>
            </tr>
        `;
          });
          document.getElementById("data").innerHTML = html;
        },
        error: function (jqXHR, exception) {
          var msg = "";
          if (jqXHR.status === 0) {
            msg = "Not connect.\n Verify Network.";
          } else if (jqXHR.status == 404) {
            msg = "Requested page not found. [404]";
          } else if (jqXHR.status == 500) {
            msg = "Internal Server Error [500].";
          } else if (exception === "parsererror") {
            msg = "Requested JSON parse failed.";
          } else if (exception === "timeout") {
            msg = "Time out error.";
          } else if (exception === "abort") {
            msg = "Ajax request aborted.";
          } else {
            msg = "Uncaught Error.\n" + jqXHR.responseText;
          }
          $("#message").html(msg).delay(5000).fadeOut(400);
        },
      });
    }
    fetchAll();

    // ----------------------------------------------------------------------------------------
    // CHECK AND RETRIENVE DATA ID ASSIGN ID TO FUNCTION EDITEMPLOYEE
    document.querySelector("tbody").addEventListener("click", (event) => {
      // FETCH ID FROM TABODY TABLE a href="#" class="editLink"

      event.preventDefault();
      if (event.target && event.target.matches("a.editLink")) {
        $("#editmodal").modal("show");
        let editid = event.target.getAttribute("data-editId");
        // FUNCTION PASSING ID ARGUMENTS
        editEmployee(editid);
        // alert(id);
      }
      return false;
    });

    // FUNCTION TO DISPLAY TO MODAL DATA FROM ARGUMENT FETCH editid
    function editEmployee(editid) {
      //   alert(id);
      $.ajax({
        type: "GET",
        url: "classes/class_model.php?fetsingle=1",
        data: {
          id: editid,
        },
        success: function (response) {
          //   console.log(response);
          var data = JSON.parse(response);
          console.log(data);
          $(".edit_employee #id").val(data.id);
          $(".edit_employee #email").val(data.email);
          $(".edit_employee #firstname").val(data.firstname);
          $(".edit_employee #lastname").val(data.lastname);
          $(".edit_employee #address").val(data.address);
          // $(".edit_employee #editbtn").val(data."editbtn");
        },
      });
    }
    // -------------------------------------------------------------------------------------------
    document.querySelector(".edit_employee").addEventListener(
      "submit",
      (event) => {
        event.preventDefault();
        // var datastring = $("#editemployee").serialize();
        const id = $(".edit_employee #id").val();
        const email = $(".edit_employee #email").val();
        const firstname = $(".edit_employee #firstname").val();
        const lastname = $(".edit_employee #lastname").val();
        const address = $(".edit_employee #address").val();
        const editform = $(".edit_employee #edit").val("editform");
        $.ajax({
          type: "POST",
          url: "classes/class_model.php",
          data: JSON.stringify({
            id: id,
            editform: editform,
            email: email,
            firstname: firstname,
            lastname: lastname,
            address: address,
          }),
          dataType: "json",
          success: function (response) {
            $("#editmodal").modal("hide");
            // console.log(response);
            // use stringify already json.parse from php function
            const stringify = JSON.stringify(response);
            //   DISPLAY EVERY RESPONSE
            $("#message").html(stringify).delay(5000).fadeOut(400);
            // AUTO DISPLAY ALL DATA REALTIME
            fetchAll();
          },
          error: function (jqXHR, exception) {
            var msg = "";
            if (jqXHR.status === 0) {
              msg = "Not connect.\n Verify Network.";
            } else if (jqXHR.status == 404) {
              msg = "Requested page not found. [404]";
            } else if (jqXHR.status == 500) {
              msg = "Internal Server Error [500].";
            } else if (exception === "parsererror") {
              msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
              msg = "Time out error.";
            } else if (exception === "abort") {
              msg = "Ajax request aborted.";
            } else {
              msg = "Uncaught Error.\n" + jqXHR.responseText;
            }
            $("#message").html(msg).delay(5000).fadeOut(400);
          },
        });
      },
      true
    );
    // =========================================================================================
    // DELETE SINGLE DATA FROM DATABASE
    // CHECK AND RETRIENVE DATA ID ASSIGN ID TO FUNCTION EDITEMPLOYEE
    document.querySelector("tbody").addEventListener("click", (event) => {
      // FETCH ID FROM TABODY TABLE a href="#" class="editLink"

      event.preventDefault();
      if (event.target && event.target.matches("a.deleteLink")) {
        // $("#editmodal").modal("show");
        let deleteid = event.target.getAttribute("data-deleteId");
        // FUNCTION PASSING ID ARGUMENTS
        deleteEmployee(deleteid);
        // alert(id);
      }
      return false;
    });
    // FUNCTION TO DISPLAY TO MODAL DATA FROM ARGUMENT FETCH editid
    function deleteEmployee(deleteid) {
      //   alert(id);
      $.ajax({
        type: "GET",
        // setting argument into link delete base from function deleteEmployee argument deleteid
        url: `classes/class_model.php?deletesingle=${deleteid}`,
        success: function (response) {
          const stringify = JSON.stringify(response);
          //   DISPLAY EVERY RESPONSE
          $("#message").html(stringify).delay(5000).fadeOut(400);
          // AUTO DISPLAY ALL DATA REALTIME
          fetchAll();
        },
        error: function (jqXHR, exception) {
          var msg = "";
          if (jqXHR.status === 0) {
            msg = "Not connect.\n Verify Network.";
          } else if (jqXHR.status == 404) {
            msg = "Requested page not found. [404]";
          } else if (jqXHR.status == 500) {
            msg = "Internal Server Error [500].";
          } else if (exception === "parsererror") {
            msg = "Requested JSON parse failed.";
          } else if (exception === "timeout") {
            msg = "Time out error.";
          } else if (exception === "abort") {
            msg = "Ajax request aborted.";
          } else {
            msg = "Uncaught Error.\n" + jqXHR.responseText;
          }
          $("#message").html(msg).delay(5000).fadeOut(400);
        },
      });
    }
    // ======================================================================================
  },
  true
);
