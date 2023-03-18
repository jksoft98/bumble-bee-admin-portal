
 <!-- Small boxes (Stat box) -->
 <div class="row">
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
        <h3>150</h3>

        <p>Total Orders</p>
        </div>
        <div class="icon">
        <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-gray">
        <div class="inner">
        <h3>53</sup></h3>

        <p>Total Loans</p>
        </div>
        <div class="icon">
        <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
        <div class="inner">
        <h3><?php echo (isset($dashboard_data))? $dashboard_data->user_count : 0 ?></h3>

        <p>User Registrations</p>
        </div>
        <div class="icon">
        <i class="ion ion-person-add"></i>
        </div>
        <a href="/user-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-olive">
        <div class="inner">
        <h3><?php echo (isset($dashboard_data))? $dashboard_data->customer_count : 0 ?></h3>

        <p>Customer Registrations</p>
        </div>
        <div class="icon">
        <i class="ion ion-happy"></i>
        </div>
        <a href="/customer-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-6">
        <!-- general form elements -->
        <div class="card card-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Sales Graph</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <canvas id="lineChart" height="150px"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-lg-6">
         <!-- general form elements -->
         <div class="card card-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Sales Items</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <canvas id="pieChart" height="150px"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->

</div>

