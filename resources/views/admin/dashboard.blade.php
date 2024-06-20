 @extends('admin.layouts.app')

 @section('content')
     <style>
         <style>.small-box {
             border-radius: 5px;
             position: relative;
             padding: 20px;
             color: #fff;
             margin-bottom: 20px;
         }

         .bg-success {
             background-color: #28a745;
         }

         .bg-info {
             background-color: #17a2b8;
         }

         .bg-warning {
             background-color: #ffc107;
         }

         .bg-danger {
             background-color: #dc3545;
         }
     </style>
     </style>
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Dashboard</h1>
                 </div>
                 <div class="col-sm-6">

                 </div>
             </div>
         </div>
         <!-- /.container-fluid -->
     </section>
     <section>
         <div class="container">
             <div class="row">
                 <div class="col-12 col-sm-6 col-md-3">
                     <div class="info-box mb-3">
                         <span class="info-box-icon bg-danger elevation-1"><i class="nav-icon fas fa-star"></i></span>
                         <div class="info-box-content">
                             <span class="info-box-text">Rating</span>
                             <span id="totalrating" class="info-box-number">{{ $totalrating }}</span>
                         </div>
                     </div>
                 </div>
                 <div class="col-12 col-sm-6 col-md-3">
                     <div class="info-box mb-3">
                         <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                         <div class="info-box-content">
                             <span class="info-box-text">Return</span>
                             <span id="totalReturn" class="info-box-number">{{ $totalReturn }}</span>
                         </div>
                     </div>
                 </div>
                 <div class="col-12 col-sm-6 col-md-3">
                     <div class="info-box mb-3">
                         <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                         <div class="info-box-content">
                             <span class="info-box-text">Cancel Order</span>
                             <span id="totalcancel" class="info-box-number">{{ $totalcancel }}</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="totalOrders">{{ $totalOrders }}</h3>
                            <p class="text-white">Total Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('order.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="totalProducts">{{ $totalProducts }}</h3>
                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="totalUsers">{{ $totalUsers }}</h3>
                            <p>User </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner bg-fuchsia">
                            <h3 id="totalClients">{{ $totalClients }}</h3>
                            <p>Billing Client</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box card bg-olive disabled color-palette">
                        <div class="inner bg-olive">
                            <h3 id="totalRevenue">Rs{{ number_format($totalRevenue, 2) }}</h3>
                            <p>Total Sale</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box card bg-teal disabled color-palette">
                        <div class="inner bg-teal">
                            <h3 id="revenueThisMonth">Rs{{ number_format($revenueThisMonth, 2) }}</h3>
                            <p>Revenue This Month</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box card bg-maroon disabled color-palette">
                        <div class="inner bg-maroon">
                            <h3 id="revenueLastMonth">Rs{{ number_format($revenueLastMonth, 2) }}</h3>
                            <p>Revenue Last Month ({{ $lastMonthName }})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box card bg-gray disabled color-palette">
                        <div class="inner bg-gray">
                            <h3 id="revenueLastThirtyDays">Rs{{ number_format($revenueLastThirtyDays, 2) }}</h3>
                            <p>Revenue Last 30 Days</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                    </div>
                </div>
            </div>
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 @endsection

 @section('customjs')
     <script>
         document.addEventListener("DOMContentLoaded", function() {
             fetch('{{route('dashboard-data')}}')
                 .then(response => {
                     if (!response.ok) {
                         throw new Error('Network response was not ok');
                     }
                     return response.json();
                 })
                 .then(data => {
                     animateCount('totalrating', 0, data.totalrating, 2000);
                     animateCount('totalReturn', 0, data.totalReturn, 2000);
                     animateCount('totalcancel', 0, data.totalcancel, 2000);
                     animateCount('totalOrders', 0, data.totalOrders, 2000);
                     animateCount('totalProducts', 0, data.totalProducts, 2000);
                     animateCount('totalUsers', 0, data.totalUsers, 2000);
                     animateCount('totalClients', 0, data.totalClients, 2000);
                     animateCount('totalRevenue', 0, data.totalRevenue, 100, true);
                     animateCount('revenueThisMonth', 0, data.revenueThisMonth, 500, true);
                     animateCount('revenueLastMonth', 0, data.revenueLastMonth, 500, true);
                     animateCount('revenueLastThirtyDays', 0, data.revenueLastThirtyDays, 500, true);
                 })
                 .catch(error => console.error('Error fetching data:', error));
         });

         function animateCount(id, start, end, duration, isCurrency = false) {
             let range = end - start;
             let current = start;
             let increment = end > start ? 1 : -1;
             let stepTime = Math.abs(Math.floor(duration / range));

             const obj = document.getElementById(id);
             const timer = setInterval(() => {
                 current += increment;
                 obj.textContent = isCurrency ? `Rs ${current.toLocaleString()}` : current.toLocaleString();
                 if (current == end) {
                     clearInterval(timer);
                 }
             }, stepTime);
         }
     </script>
 @endsection
