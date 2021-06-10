@extends('basetemplate.app')
@section('title','Dashboard')
@section('container')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <!-- /.col-md-6 -->

          <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-duration="1150">
            <!-- small box -->
            <div class="small-box bg-info color-palette dashboard_box" >
              <div class="inner">
                <h3>{{count($data)}}</h3>

                <p>Total Proposal</p>
              </div>
              <div class="icon">
                <i class="fa fa-box"></i>
              </div>
              <a href="{{route('proposal')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-duration="1150">
            <!-- small box -->
            <div class="small-box bg-success dashboard_box" >
              <div class="inner">
                {{-- @if($item->status == 'SAVED') --}}
                {{-- $data['status'] != 'SAVED' --}}
                <h3>{{$proposal_valid['valid']}}</h3>
                <p>Proposal Tervalidasi</p>
              </div>
              <div class="icon">
                <i class="fa fa-clipboard-check"></i>
              </div>
              <a href="{{route('proposal').'?status=APPROVED'}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-duration="1150">
            <!-- small box -->
            <div class="small-box bg-warning dashboard_box">
              <div class="inner">
                {{-- {{(int)$item->qty*$item->nominal}} --}}
                <h3>{{(int)$proposal_confirming['confirming']+$proposal_confirming2['confirming2']}}</h3>
                <p>Proposal Verfikasi</p>
              </div>
              <div class="icon">
                <i class="fa fa-file-import"></i>
              </div>
              <a href="{{route('proposal').'?status=PROSES'}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-duration="1150">
            <!-- small box -->
            <div class="small-box bg-danger dashboard_box">
              <div class="inner">
                <h3>{{$proposal_rejected['rejected']}}</h3>

                <p>Proposal ditolak</p>
              </div>
              <div class="icon">
                <i class="fa fa-window-close"></i>
              </div>
              <a href="{{route('proposal').'?status=REJECTED'}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
        
        <!-- /.col-md-6 -->
        <div class="col-md-6 col-sm-12" data-aos="zoom-in" data-aos-duration="1150">
          <div class="card card-lightblue color-palette dashboard_box">
            <div class="card-header">
              <h3 class="card-title">Diagram Berdasarkan Kategori</h3>    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">                  
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">                  
                </button>
              </div>
            </div>
            <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 371px;" width="742" height="500" class="chartjs-render-monitor"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-md-3" data-aos="zoom-in" data-aos-duration="1150">
          <div class="info-box mb-3 bg-teal color-palette dashboard_box">
            <span class="info-box-icon text-dark"><i class="fa fa-money-bill-wave"></i></span>
            <div class="info-box-content text-dark">
              <span class="info-box-text">Total Pengeluaran </span>
              <span class="info-box-number">Rp. {{number_format($total['total'], 0,',','.')}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>      
        <!-- /.card -->
      </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('script')
    <script>
      //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          @foreach($kategori as $item)
            "{{$item->program}}",
          @endforeach
      ],
      datasets: [
        {
          data: [
            @foreach($kategori as $item)
            "{{$item->jumlah}}",
            @endforeach
          ],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

      /*
     * DONUT CHART
     * -----------
     */

     var donutData = [
      {
        label: 'Series2',
        data : 30,
        color: '#3c8dbc'
      },
      {
        label: 'Series3',
        data : 20,
        color: '#0073b7'
      },
      {
        label: 'Series4',
        data : 50,
        color: '#00c0ef'
      }
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */
    </script>    
@endsection
    
