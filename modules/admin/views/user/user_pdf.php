<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      table{
        border-color: #e5eff6;
        margin-bottom: 10px!important;
        border: 1px solid #e7ecf1;
        width: 100%;
        max-width: 100%;
        border-radius: 0!important;
        background-color: transparent;
        border-collapse: collapse;
        border-spacing: 0;
        display: table;
    }
    th{
      text-align: center;
    }
    td{
      text-align: center;
    }
    .cust_center{
      text-align:center;
    }
      </style>
  </head>
  <body>
    <div class="row">
      <h2>User Report</h2>
      <div class="col-sm-12">
        <table class="table table-bordered" border="1" width="100%">
          <thead>
            <tr>
              <th class="cust_center">User Name</th>
              <th class="cust_center">Email Id</th>
            </tr>
          </thead>
          <tbody>
            <tbody id="">
              <?php
              if(isset($data) && $data!=array())
              {
                foreach($data as $list)
              {
              ?>
              <tr>
                <td class="cust_center"><?=ucfirst($list['user_name'])?></td>
                <td class="cust_center"><?=$list['email_id']?></td>
              </tr>
              <?php
              }}
              else {
                echo "<tr>";
                echo '<td colspan="7" style="margin-top:10px;">No data..!</td>';
                echo "</tr>";
              }
              ?>
            </tbody>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
