@extends('admin.layouts.master')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Thẻ hiển thị thông tin khóa học -->

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="mb-20 h4">Course Details</h4>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-tag mr-2"></i>
                                        <span>Name</span>
                                    </div>
                                    <span class="badge badge-info badge-pill">{{ $payment->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-list mr-2"></i>
                                        <span>Email</span>
                                    </div>
                                    <span class="badge badge-info badge-pill">{{ $payment->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-fill mr-2"></i>
                                        <span>Phone</span>
                                    </div>
                                    <span class="badge badge-secondary badge-pill">{{ $payment->phone }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-tag mr-2"></i>
                                        <span>Address</span>
                                    </div>
                                    <span class="badge badge-info badge-pill"> {{ $payment->address }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock mr-2"></i>
                                        <span>Payment Type </span>
                                    </div>
                                    <span class="badge badge-light badge-pill">{{ $payment->cash_delivery }}</span>
                                </li>
                                {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-video mr-2"></i>
                                    <span>Video</span>
                                </div>
                                <video width="300" height="200" controls>
                                    <source src="{{ asset($course->video) }}" type="video/mp4">
                                </video>
                            </li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="mb-20 h4">Additional Information</h4>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-text mr-2"></i>
                                        <span>Total Amount</span>
                                    </div>
                                    <span class="badge badge-info badge-pill">${{ $payment->total_amount }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-award-fill mr-2"></i>
                                        <span>Payment Type</span>
                                    </div>
                                    <span class="badge badge-success badge-pill">{{ $payment->payment_type }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-cash mr-2"></i>
                                        <span>Invoice Number </span>
                                    </div>
                                    <span class="badge badge-success badge-pill"> {{ $payment->invoice_no }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-tag-fill mr-2"></i>
                                        <span>Order Date</span>
                                    </div>
                                    <span class="badge badge-warning badge-pill"> {{ $payment->order_date }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-info-circle-fill mr-2"></i>
                                        <span>Status</span>
                                    </div>
                                    @if ($payment->status == 'pending')
                                    <a href="{{ route('admin.pending-confirm', $payment->id) }}" class="badge bg-warning badge-pill">Pending Order</a>
                                @elseif ($payment->status == 'completed')
                                    <a href="{{ route('admin.pending-confirm', $payment->id) }}" class="badge bg-success badge-pill">Confirm Order</a>
                                @endif
                                
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Order Item</h4>
                        <p class="mb-0">
                            You can find more options <a class="text-primary" href="https://datatables.net/"
                                target="_blank">Click Here</a>
                        </p>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th class="table-plus datatable-nosort">Name</th>
                                    <th>Category</th>
                                    <th>Instructor</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($orderItem as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset($item->course->course_image) }}"
                                                 alt="{{ $item->course->course_name }}"
                                                 style="width: 50px; height: auto;">
                                        </td>
                                        <td class="table-plus">{{ limitText($item->course->course_name, 20) }}</td>
                                        <td>{{ $item->course->category->category_name }}</td>
                                        <td>{{ $item->instructor->name }}</td>
                                        <td>${{ $item->price }}</td>
                                    </tr>
                                    @php
                                        $totalPrice += $item->price; 
                                    @endphp  
                                @endforeach
                            </tbody>
                            
                        </table>
                       
                        
                    </div>
                    <div class="mr-5 py-5">
                        <tr>
                            <td colspan="5" class="text-right">
                                <div class="d-flex justify-content-end">
                                    <div class="card" style="max-width: 250px; width: 100%;">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-tag mr-2"></i>
                                                <strong>Total Price:</strong>
                                            </div>
                                            <span class="badge badge-info badge-pill">${{ $totalPrice }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    </div>
                </div>
                
            </div>



            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Mẫu quản trị Bootstrap 4 của
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
        </div>
    </div>

    <script>
        
  $(function(){
    $(document).on('click','#confirm',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Confirm This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Confirm it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Confirm!',
                        'Your file has been Confirm.',
                        'success'
                      )
                    }
                  }) 


    });

  });

    </script>
@endsection
