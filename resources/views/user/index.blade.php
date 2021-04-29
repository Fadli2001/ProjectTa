@extends('basetemplate.app')
@section('title','Dashboard')
@section('container')

<div class="row">  
    <div class="col-md-12 ">
      <div class="card">
        <div class="card-header">
          <h3 class="float-left">Data User</h3>
          
          <div class="float-right">
            <a href="{{route('user.create')}}">
              <button type="button" class="btn bg-gradient-info"> <i class="fa fa-user-plus"></i> Add User</button>
            </a>
          </div>              
        </div>      
        <div class="card-body">
          <table id="datauser" class="table table-striped">
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
                        <img class=" elevation-2" style="border-radius:30px" width="50" src="{{asset ("image/" .$item->foto)}}" alt="">
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
                      <a style="text-decoration: none" href="{{ route('user.edit',$item->id) }}"><button type="button" class="btn bg-gradient-warning mr-1"><i class="fa fa-edit"></i></button></a>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn bg-gradient-primary btn-detail mr-1" data-toggle="modal" data-target="#exampleModal" data-id="{{$item->id}}">
                        <i class="fa fa-eye"></i>
                      </button>                               
                      <a style="text-decoration: none" onclick="deleted(this)" data-href="{{ route('user.destroy',$item->id) }}"><button type="button" class="btn bg-gradient-danger"><i class="far fa-trash-alt"></i></button></a>                      
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
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
          <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"  src="{{ asset('image')}}/${result.foto}" alt="User profile picture">
                 
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