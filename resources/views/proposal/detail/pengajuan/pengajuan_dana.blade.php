@extends('proposal.detail.detail')
@section('content')
@php
$roles = json_decode(Auth::user()->role)
@endphp
@if (count($ajuan) < 1)
<p class="mb-1 mt-3 "> Data Pengajuan Dana Masih Kosong!</p>
  <a class="btn bg-gradient-primary btn-sm" href="{{route("pengajuan.create",$data->proposal_id)}}">Tambah</a>    
@endif
@foreach ($ajuan as $item)

@if ((in_array('AMIL',$roles) || (in_array('ADMIN',$roles))))              
<div class="row mt-2 mb-3">
  <div class="col-md-6">
    <a style="text-decoration: none" href="{{route("pengajuan.edit",$item->id)}}"><button type="button" class="btn btn-sm bg-gradient-warning mr-1">Edit Date</button></a>    
  </div>
</div>
@endif
<div class="row">
  <div class="col-md-6">
  <table class="table table-bordered table-striped responsive-table-sm">
    <tr>
      <th>PIC</th>
      <td>{{$item ["pic"]}}</td>
    </tr>
    <tr>
      <th>Metode</th>
      <td>{{$item ["metode"]}}</td>
    </tr>
    <tr>
      <th>No. Rekening</th>
      <td>{{$item ["no_rekening"]}}</td>
    </tr>
    <tr>
      <th>Nama Bank</th>
      <td>{{$item ["nama_bank"]}}</td>    
    </tr>
    <tr>
      <th>Pemilik Rekening</th>      
      <td>{{$item ["pemilik_rekening"]}}</td>
    </tr>
    <tr>
      <th>Sumber Dana</th>
      <td>{{$item ["sumber_dana"]}}</td>      
    </tr>    
    <?php
    $createddate = $item['created_at']->isoFormat(' dddd, D MMMM Y');
    $updateddate = $item['updated_at']->isoFormat(' dddd, D MMMM Y');                    
    $createdtime = $item['created_at']->isoFormat(' h:mm a');
    $updatedtime = $item['updated_at']->isoFormat(' h:mm a');                    
    ?>    
    <tr rowspan="2">
      <td colspan="2">
        <p class="text-muted text-sm mb-0"> Dibuat Pada : {{$createddate}}, Pada Jam : {{$createdtime}}</p>
        <p class="text-muted text-sm "> Terakhir diubah : {{$updateddate}}, Pada Jam : {{$updatedtime}} </p>
      </td>
    </tr>
    </table>
    @endforeach
  </div>
</div>



  
@endsection
    
