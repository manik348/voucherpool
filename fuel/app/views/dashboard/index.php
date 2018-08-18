        <!-- Icon Cards-->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-users"></i>
                        </div>
                        <div class="mr-5"><h1><?=$total_recipients;?></h1> Recipients</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?php echo Uri::create('recipients'); ?>">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-shopping-bag"></i>
                        </div>
                        <div class="mr-5"><h1><?=$total_offers;?></h1> Offers</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?php echo Uri::create('offers'); ?>">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-ticket"></i>
                        </div>
                        <div class="mr-5"><h1><?=$total_vouchers;?></h1> Total Vouchers</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?php echo Uri::create('vouchers'); ?>">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-ticket"></i>
                        </div>
                        <div class="mr-5"><h1><?=$total_vouchers_used;?></h1> Used Vouchers</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="<?php echo Uri::create('vouchers'); ?>">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row">
            <div class="col-lg-9">
                <!-- Voucher Usage by date Chart -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-area-chart"></i> Vouchers Usage by Date
                    </div>
                    <div class="card-body">
                        <canvas id="myAreaChart" width="100%" height="19"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <!-- Voucher status Pie Chart -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-pie-chart"></i> Vouchers by Status
                    </div>
                    <div class="card-body">
                        <canvas id="myPieChart" width="100%" height="65"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <!-- Latest Vouchers Used DataTable -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-ticket"></i> Latest 5 Vouchers Used
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Recipient</th>
                            <th>Offer</th>
                            <th>Expiration</th>
                            <th>Usage</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($list_vouchers_used as $v): ?>
                            <tr>
                                <td><?=$v->code;?></td>
                                <td><?=$v->recipient->name;?></td>
                                <td><?=$v->offer->name;?></td>
                                <td><?=$v->date_expiration;?></td>
                                <td><?=($v->date_usage) ? $v->date_usage : 'Not Used';?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Latest Vouchers Created DataTable -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-ticket"></i> Latest 5 Vouchers Created and Not Used
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Recipient</th>
                            <th>Offer</th>
                            <th>Expiration</th>
                            <th>Usage</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($list_vouchers_created as $v): ?>
                        <tr>
                            <td><?=$v->code;?></td>
                            <td><?=$v->recipient->name;?></td>
                            <td><?=$v->offer->name;?></td>
                            <td><?=$v->date_expiration;?></td>
                            <td><?=($v->date_usage) ? $v->date_usage : 'Not Used';?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <script language="JavaScript">

            // -- Voucher Status Pie Chart
            var ctx = document.getElementById("myPieChart");

            if (ctx) {
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ["Unused", "Used", "Expired"],
                        datasets: [{
                            data: [<?=$vouchers_unused;?>, <?=$vouchers_used;?>, <?=$vouchers_expired;?>],
                            backgroundColor: ['#30b623', '#dc3545', '#ffc107'],
                        }],
                    },
                });
            }

            // -- Voucher usage by date chart
            var ctx = document.getElementById("myAreaChart");

            if (ctx) {
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                            <?php

                            foreach ($vouchers_usage as $item) {
                                echo '"'.$item["date_usage"].'", ';
                            }

                            ?>
                            ],
                        datasets: [{
                            label: "Usages",
                            lineTension: 0.3,
                            backgroundColor: "rgba(2,117,216,0.2)",
                            borderColor: "rgba(2,117,216,1)",
                            pointRadius: 5,
                            pointBackgroundColor: "rgba(2,117,216,1)",
                            pointBorderColor: "rgba(255,255,255,0.8)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(2,117,216,1)",
                            pointHitRadius: 20,
                            pointBorderWidth: 2,
                            data: [<?php

                                foreach ($vouchers_usage as $item) {
                                    echo '"'.$item["count"].'", ';
                                }

                                ?>],
                        }],
                    },
                    options: {
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    maxTicksLimit: 5
                                },
                                gridLines: {
                                    color: "rgba(0, 0, 0, .125)",
                                }
                            }],
                        },
                        legend: {
                            display: false
                        }
                    }
                });

            }

        </script>