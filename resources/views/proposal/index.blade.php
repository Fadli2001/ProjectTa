@extends('basetemplate.app')
@section('title','Data Proposal')
@section('container')

<div class="row">  
    <div class="col-md-12 ">
      <div class="card">
        <div class="card-header">
          <h3 class="float-left">Data Proposal</h3>
          
          <div class="float-right">
            <a href="{{route('proposal.create')}}">
              <button type="button" class="btn bg-gradient-info"> <i class="fa fa-user-plus"></i> Tambah Proposal</button>
            </a>
          </div>              
        </div>      
        <div class="card-body">
          <table id="datauser" class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>No Ajuan</th>
                <th>Kategori Ajuan</th>
                <th>Kriteria Penerima</th>
                <th>Kategori Program</th>              
                <th>Nama Pengaju</th>                
                <th>No Kontak</th>
                <th>Email</th>                                                                
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @php
                $no=0;
                @endphp
                @foreach ($data as $item)                    
                <tr>
                    <td>{{++$no}}</td>
                    <td>{{$item->no_ajuan}}</td>
                    <td>{{$item->kategori_ajuan}}</td>
                    <td>{{$item->kriteria_penerima}}</td>
                    <td></td>
                    <td>{{$item->nama_pengaju}}</td>
                    <td></td>
                    <td></td>                                    
                    <td>

                      <a style="text-decoration: none" href="#"><button type="button" class="btn bg-gradient-warning mr-1"><i class="fa fa-edit"></i></button></a>

                      <!-- Button trigger modal -->
                      <button type="button" class="btn bg-gradient-primary btn-detail mr-1" data-toggle="modal" data-target="#exampleModal" data-id="{{$item->id}}">
                        <i class="fa fa-eye"></i>
                      </button>                               
                      <a style="text-decoration: none" onclick="deleted(this)" data-href=""><button type="button" class="btn bg-gradient-danger"><i class="far fa-trash-alt"></i></button></a>                      
                    </td>
                </tr>
                @endforeach
              
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
     
    </div>
  </div>  



     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Data Proposal </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        
          <div class="modal-body">            
          
          </div>
        </div>
      </div>
    </div>

@endsection
    
@section('script')
<script>
  // function deleted(e) {
  //   Swal.fire({
  //     title: 'Are you sure?',
  //     text: "You won't be able to revert this!",
  //     icon: 'warning',
  //     showCancelButton: true
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       window.location.href = $(e).data('href')
  //     }
  //   })
  // }
  $(document).on('click','.btn-detail',function () {
    $.ajax({
      url: "{{ route('proposal.show') }}",
      type: 'get',
      dataType:'json',     
      data: {id: $(this).data('id')},      
      success: function (result) {
        var created = new Date(result.created_at);
        var updated = new Date(result.updated_at);
        console.log(created.toDateString());
        console.log(updated.toDateString());        
        $('.modal-body').html(` 
        <table class="table table-hover text-nowrap">
            
            <tbody>
              <tr>                
                <th>No Ajuan</th>
                <td>${result.no_ajuan}</td>                              
              </tr>
              <tr>
              <th>Kategori Ajuan </th>
              <td>${result.kategori_ajuan}</td>
              </tr>
              <tr>
              <th>Kriteria Penerima </th>
              <td>${result.kriteria_penerima}</td>
              </tr>
              <tr>
              <th>Kategori Program </th>
              <td>${result.kategori_program}</td>
              </tr>
              <tr>
              <th>Keterangan Program </th>
              <td>${result.ket_program}</td>
              </tr>
              <tr>
              <th>Nama Pengaju </th>
              <td>${result.nama_pengaju}</td>
              </tr>
              <tr>
              <th>Alamat </th>
              <td>${result.alamat}</td>
              </tr>
              <tr>
              <th>No. Kontak </th>
              <td>${result.no_kontak}</td>
              </tr>
              <tr>
              <th>Email </th>
              <td>${result.email}</td>
              </tr>
              <tr>
              <th>Asnaf </th>
              <td>${result.asnaf}</td>
              </tr>
              <tr>
              <th>Jenis Program </th>
              <td>${result.jenis_program}</td>
              </tr>
              <tr>
              <th>Bentuk Penyaluran </th>
              <td>${result.bentuk_penyaluran}</td>
              </tr>
              <tr>
              <th>Sosial Media </th>
              <td>${result.sosmed}</td>
              </tr>
            </tbody>
          </table>                 
     
        `)
      }
    })
  })
</script>

@endsection