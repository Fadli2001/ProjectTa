@extends('proposal.detail.detail')
@section('content')
@php
$roles = json_decode(Auth::user()->role)
@endphp
@if (count($rincian) < 1 && (in_array('AMIL',$roles) || (in_array('ADMIN',$roles))) )
<p class="mb-1 mt-3"> Data Rincian Dana Masih Kosong!</p>
  <a class="btn bg-gradient-primary btn-sm" href="{{route("rincian.create",$data->proposal_id)}}">Tambah</a>    
@elseif((in_array('AMIL',$roles) || (in_array('ADMIN',$roles))))
<div class="row my-3">
  <div class="col-md-6">
    <a style="text-decoration: none" href="{{route("rincian.create",$data->proposal_id)}}"><button type="button" class="btn btn-sm bg-gradient-primary mr-1">Tambah</button></a>    
  </div>
</div>
@endif

<div class="row mt-3">
  <div class="col-md-7">
    <table id="datauser" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Uraian</th>                
          <th>Qty</th>
          <th>Nominal</th>              
          <th>Total</th> 
          @if ((in_array('AMIL',$roles) || (in_array('ADMIN',$roles))))                    
          <th>Action</th>
          @endif
        </tr>
      </thead>
      <tbody>
          @php
          $no=0;
          @endphp
          @foreach ($rincian as $item)                    
          <tr>
              <td>{{++$no}}</td>
              <td>{{$item->uraian}}</td>                    
              <td>{{$item->qty}}</td>
              <td>Rp. {{number_format($item->nominal, 0,',','.')}}</td>                
              <td>Rp. {{number_format((int)$item->qty*$item->nominal,0 ,',','.')}}</td>                                                          
              @if ((in_array('AMIL',$roles) || (in_array('ADMIN',$roles))))                    
              <td>
                <a style="text-decoration: none" href="{{ route('rincian.edit',$item->id) }}"><button type="button" class="btn bg-gradient-warning mr-1 my-1"><i class="fa fa-edit"></i></button></a>                
                <a style="text-decoration: none" onclick="deleted(this)"  data-href="{{ route('rincian.destroy',$item->id) }}"><button type="button" class="btn bg-gradient-danger my-1 mr-1"><i class="far fa-trash-alt"></i></button></a>                                     
              </td>
              @endif
          </tr>
          @endforeach
      </tbody>
    </table>
    </table>    
  </div>
</div>



  
@endsection
    
