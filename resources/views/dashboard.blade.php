
 <!-- Small boxes (Stat box) -->
 <div class="row">
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
        <h3><?php echo (isset($dashboard_data))? $dashboard_data->order_count : 0 ?></h3>

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
        <h3><?php echo (isset($dashboard_data))? $dashboard_data->loan_count : 0 ?></sup></h3>

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
        <div class="card card-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Sales Graph</h3>
            </div>
            <div class="card-body card-tabs">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Monthly</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Weekly</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Daily</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade active show pt-3" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        <canvas id="lineChartMonthly" height="150px"></canvas>
                    </div>
                    <div class="tab-pane fade pt-3" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        <canvas id="lineChartWeekly" height="150px"></canvas>
                    </div>
                    <div class="tab-pane fade pt-3" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                        <canvas id="lineChartDaily" height="150px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-lg-6">
        <div class="card card-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Top 5 Selling Items</h3>
            </div>
            <div class="card-body card-tabs">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-last-30-month" data-toggle="pill" href="#custom-tabs-three-last-30-month" role="tab" aria-controls="custom-tabs-three-last-30-month" aria-selected="true">Last 30 Days</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-last-12-months" data-toggle="pill" href="#custom-tabs-three-last-12-months" role="tab" aria-controls="custom-tabs-three-last-12-months" aria-selected="false">Last 12 Months</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-tabs-tabContent">
                    <div class="tab-pane fade active show pt-3" id="custom-tabs-three-last-30-month" role="tabpanel" aria-labelledby="custom-tabs-last-30-month">
                        <canvas id="pieChartLastThirtyDays" height="150px"></canvas>
                    </div>
                    <div class="tab-pane fade pt-3" id="custom-tabs-three-last-12-months" role="tabpanel" aria-labelledby="custom-tabs-last-12-months">
                    <canvas id="pieChartLastTwowellMonths" height="150px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.row -->

</div>

<script>
    var sales_chart_data        = <?php echo json_encode($dashboard_data->sales_chart_data); ?>;
    var sales_item_chart_data   = <?php echo json_encode($dashboard_data->sales_item_chart_data); ?>;
</script>

