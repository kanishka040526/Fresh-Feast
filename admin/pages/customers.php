<?php
session_start();

if (!isset($_SESSION['userdetails'])) {
  header('Location: sign-in.php');
  exit();
}

include('connectmysql.php');

if($_SERVER["REQUEST_METHOD"] == "GET"){

  $limit = 6;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($page - 1) * $limit;
    
  $review_data = "SELECT * FROM user LIMIT $limit  OFFSET $offset";
  $result = $conn->query($review_data);

  $total_products_query = "SELECT COUNT(*) AS total FROM user";
  $total_products_result = $conn->query($total_products_query);
  $total_products_row = $total_products_result->fetch_assoc();
  $total_products = $total_products_row['total'];
  $total_pages = ceil($total_products / $limit);
    
}
$conn->close();
include("navbar.php");
?>
  <div class="container-categories-products">
    <section>
      <div class="container-sidenav">
        <?php include('sidenavbar.php')?>
      </div>
      <div class="add_order">
        <div class="heading">
          <h1>Customers</h1>
        </div>
        <table class="table-contant">
          <thead class="table-head-orders">
            <tr>
              <th style="text-align: center;">Name</th>
              <th style="text-align: center;">Email</th>
              <th style="text-align: center;">Contact No.</th>
              <th style="text-align: center;">Created At</th>
              
            </tr>
          </thead>
          <tbody class="table-body">
            <?php while($rows = $result->fetch_assoc())
                    { 
                    ?>
            <tr>
              <td>
                <?= $rows['userName'];?>
              </td>
              <td>
                <?= $rows['email'];?>
              </td>
              <td>
                <?= $rows['tel'];?>
              </td>
              <td>
                <?= $rows['date'];?>
              </td>              
            </tr>
            <?php
                    }
                    ?>
          </tbody>
        </table>
        <div class="pagination">
            <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>"class="rounded">&laquo;</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>" class="rounded <?= $i == $page ? 'active' : '' ?>"><?= $i ?>
            </a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>"class="rounded">&raquo;</a>
            <?php endif; ?>
        </div>
                            
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</body>

</html>
