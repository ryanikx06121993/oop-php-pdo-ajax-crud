<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="snippets/css/bootstrap.min.css">
</head>
<body>
        <div class="container">

            <form id="insertdata" action="" method="post" enctype="multipart/form-data">
                <input type="email" name="email" id="email" required placeholder="email"><br><br>
                <input type="text" name="firstname" id="firstname" required placeholder="firstname"><br><br>
                <input type="text" name="lastname" id="lastname" required placeholder="lastname"><br><br>
                <input type="text" name="address" id="address" required placeholder="address"><br><br>
                <input type="submit" id="insert" name="insert" required value="insert">
            </form>
        </div>

    <div class="container">
        <div id="message"></div>
    </div><br>
    <div class="container">
    <table>
        <thead>    <!--Table Head-->
        <tr>
    <th>email</th>
    <th>firstname</th>
    <th>lastname</th>
    <th>address</th>
    <th>Action</th>
  </tr>  <!--Table Heading-->
        </thead>
        <tbody id="data">     <!--Table Body-->
        </tbody>
        <tfooter>
        </tfooter>
    </table>
    </div>

    <!-- MODALS -->
    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="editmodal"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="edit_employee" id="editemployee" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="edit" id="edit">
                <input type="email" name="email" id="email"><br><br>
                <input type="text" name="firstname" id="firstname"><br><br>
                <input type="text" name="lastname" id="lastname"><br><br>
                <input type="text" name="address" id="address"><br><br>
      <div class="modal-footer">
      <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="submit" id="edit" name="edit">Edit</button>
            </form>

                   
      </div>
      </div>
    </div>
  </div>
</div>

</body>
<script src="snippets/ajax.js"></script>
<script src="snippets/ajax_script.js"></script>
<script src="snippets/js/bootstrap.bundle.min.js"></script>
<script src="snippets/popper.min.js"></script>
</html>