@extends('basetemplate.app')
@section('title','Dashboard')
@section('container')

<div class="row">  
    <div class="col-md-12 ">
      <div class="card box_shadow">
        <div class="card-header">
          <h3 class="float-left text-bold">Data User</h3>          
          <div class="float-right">
            <a href="{{route('user.create')}}">
              <button type="button" class="btn bg-lightblue color-palette"> <i class="fa fa-user-plus"></i> Tambah User</button>
            </a>
          </div>              
        </div>      
        <div class="card-body">
          <table id="datauser" class="table table-bordered table-striped table-responsive-sm">
            <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>                
                <th>Role</th>
                <th>status</th>
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
                    <td>
                      <div class="image">
                        <img class=" elevation-2" style="border-radius: 50%;object-fit: cover;" width="40" height="40" src="{{asset ("image/" .$item->foto)}}" alt="">
                      </div>
                    </td>
                    <td class="pt-3" >{{$item->name}}</td>
                    <td class="pt-3">
                      @php                          
                          $status = json_decode($item['role'])                    
                      @endphp                                
                      @foreach ($status as $i)                                                    
                      @if( $i == 'ADMIN' )
                      <h3 class="badge badge-success">{{$i}}</h3>
                      @elseif($i == 'AMIL')
                      <h3 class="badge badge-primary">{{ $i }}</h3>
                      @elseif($i == 'PENGURUS')
                      <h3 class="badge badge-warning">{{ $i }}</h3>
                      @elseif($i == 'BENDAHARA')
                      <h3 class="badge badge-info">{{ $i }}</h3>
                      @elseif($i == 'KETUA')
                      <h3 class="badge badge-secondary">{{ $i }}</h3>
                      @endif
                      @endforeach
                    </td>
                    <td class="pt-3">
                      @if( $item->status == 'ACTIVE' )
                      <h3 class="badge badge-success">{{ $item->status }}</h3>
                      @elseif($item->status == 'INACTIVE')
                      <h3 class="badge badge-danger">{{ $item->status }}</h3>
                      @endif
                    </td>
                    <td>
                      <a style="text-decoration: none" href="{{ route('user.edit',$item->id) }}"><button type="button" class="btn bg-gradient-info btn-sm my-1"><i class="fas fa-pencil-alt"></i> Edit</button></a>                      
                      <a style="text-decoration: none" onclick="deleted(this)" data-href="{{ route('user.destroy',$item->id) }}"><button type="button" class="btn bg-gradient-danger btn-sm my-1"><i class="fas fa-trash"></i> hapus</button></a>                      
                      <button type="button" class="btn btn-detail bg-gradient-primary btn-sm mr-1 my-1" data-toggle="modal" data-target="#exampleModal" data-id="{{$item->id}}">
                        <i class="fas fa-folder"></i> View
                      </button>                               
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
            <h5 class="modal-title" id="exampleModalLabel">Detail Data User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        
          <div class="modal-body">
            <table></table>
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
    console.log($(this));
    $.ajax({
      url: "{{ route('user.show') }}",
      type: 'get',
      dataType: "json",
      data: {id: $(this).data('id')},      
      success: function (result) {
        var created = new Date(result.created_at);
        var updated = new Date(result.updated_at);
        console.log(created.toDateString());
        console.log(updated.toDateString());
        const role = JSON.parse(result.role);
        console.log(result);
        let str = '';
        role.forEach(el => { str += `<span> ${el} /</span>`} )  
        $('.modal-body').html(`
          <div class="card card-lightblue card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
              <img class="image_profile" width="155" height="155"  src="{{ asset('image')}}/${result.foto}" alt="User profile picture">
                 
                </div>

                <h3 class="profile-username text-center">${result.name}</h3>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Role Access</b> <span class="float-right">${str}</span>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <span class="float-right">${result.email}</span>
                  </li>
                  <li class="list-group-item">
                    <b>State</b> <span class="float-right">
                     ${result.status}                                                             
                      </span>
                  </li>
                  
                  <li class="list-group-item">
                    <b>Created at</b> <span class="float-right"> ${created}</span>
                  </li>
                  <li class="list-group-item">
                    <b>Last Updated </b> <span class="float-right">${updated}</span>
                  </li>                  
                </ul>               
              </div>
              <!-- /.card-body -->
            </div>

        `)
      }
    })
  })
</script>

@endsection