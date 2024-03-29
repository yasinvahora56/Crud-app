<!-----to do List Notes App----- Where You Can Take A Nots--->
<?php 
//INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'aazaz', 'axascqervrtbvrv', current_timestamp());
$insert = false;
$update = false;
$delete = false;
// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
$result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

  // Sql query to be executed
$sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
  $title = $_POST["title"];
  $description = $_POST["description"];

// Sql query to be executed
$sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
$result = mysqli_query($conn, $sql);

// Add a new trip to the Trip table in the database
if($result){
    // echo "The record has been inserted successfully successfully!<br>";
    $insert= true;
}
else{
     echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-----css Starter temlet link for Bootstrap Templets------>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <!----Titel of Webpage----->
  <title>iNotes App</title>
</head>

<body>
  <!--Edit and Update Note Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit This Note</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">×</span></button>
        </div>
        <form action="/Crud app/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>

          </div>
          <button type="submit" class="btn btn-primary my-3">Update Note</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
  </div>
  <!------Start Navbar Link Copy From Bootstrap----->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="/Crud app/Crud logo3.png" height="28px" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact us</a>
          </li>

          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
          </li>

        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!-------End Of Navbaar Link------>
  <!-----Starting of Note Added Alert---->
  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong>Your Note Has Been Inserted Successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
  <!-----End of Note Added Alert---->
  <!-----Starting of Note Deleted Alert---->
  <?php
    if($delete){
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>Success!</strong>Your Note Has Been Deleted Successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    ?>
  <!-----End of Note Deleted Alert---->
  <!-----End of Note Upadeted Alert---->
  <?php
  if($update){
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Success!</strong>Your Note Has Been Updated Successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
  <!-----End of Note Updated Alert---->
  <!-------Starting of Form included(Note Title,Note Description End Add Note Button)------->
  <div class="container my-4">
    <h2>Take a Notes at iNotes App</h2>
    <form action="/Crud app/index.php" method="POST">
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

        <div class="form-group">
          <label for="desc">Note Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

      </div>
      <button type="submit" class="btn btn-primary my-3">Add Note</button>
    </form>
  </div>
  <!-------End of Form------->
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <!---PHP Script And While Loop For Looping Table Detail---->
        <?php 
   $sql ="SELECT * FROM `notes`";
   $result = mysqli_query($conn, $sql);
   $sno = 0;
   while($row = mysqli_fetch_assoc($result)){
       $sno = $sno + 1;
       echo " <tr>
       <th scope='row'>". $sno . "</th>
       <td>".$row['title'] . "</td>
       <td>".$row['description'] . "</td>
       <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> </td> </tr>";
      
   }
   ?>


      </tbody>
    </table>
  </div>
  <hr>


  <!-----Javascript link for Bootstrap Templets------>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <!----Start Form of re Edit Of Our NOte----->
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })
    //----End Form re Edit Of Our Note----->
    //----Start Form of Delete Of Our NOte----->
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/Crud app/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    //----End Form Delete Of Our Note----->
  </script>
</body>

</html>
