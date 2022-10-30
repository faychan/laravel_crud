@extends('layouts.admin')

@section('content-header', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  <h3>{{$orders_count}}</h3>
                <p>Orders Count</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('orders.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                  <h3>{{config('settings.currency_symbol')}} {{number_format($sales, 2)}}</h3>
                <p>Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('orders.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{config('settings.currency_symbol')}} {{number_format($sales_today, 2)}}</h3>

                <p>Sales Today</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('orders.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$customers_count}}</h3>

                <p>Customers Count</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('customers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <canvas id="myCustomerChart" height="100px"></canvas>
          </div>
          <div class="col-12 col-lg-6">
            <canvas id="myEarningChart" height="100px"></canvas>
          </div>
          <!-- ./col -->
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    var labelsCustomer =  {{  \Illuminate\Support\Js::from($chart_customer_labels) }};
    var usersCustomer =  {{  \Illuminate\Support\Js::from($chart_customer_data) }};
    var labelsEarning =  {{  \Illuminate\Support\Js::from($chart_earning_labels) }};
    var usersEarning =  {{  \Illuminate\Support\Js::from($chart_earning_data) }};

    const dataBuyer = {
      labels: labelsCustomer,
      datasets: [{
        label: 'My Customers Recently',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: usersCustomer,
      }]
    };

    const dataEarning = {
      labels: labelsEarning,
      datasets: [{
        label: 'My Earnings Recently',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: usersEarning,
      }]
    };

    const configBuyerChart = {
      type: 'line',
      data: dataBuyer,
      options: {}
    };

    const configEarningChart = {
      type: 'line',
      data: dataEarning,
      options: {}
    };

    const myCustomerChart = new Chart(
      document.getElementById('myCustomerChart'),
      configBuyerChart
    );

    const myEarningChart = new Chart(
      document.getElementById('myEarningChart'),
      configEarningChart
    );
</script>
@endsection
